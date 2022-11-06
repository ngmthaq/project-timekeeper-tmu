<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckinController extends Controller
{
    protected $successColor = "rgb(40, 167, 69)";
    protected $errorColor = "rgb(220, 53, 69)";
    protected $checkinTime = "09:00:00";
    protected $checkoutTime = "18:00:00";

    public function checkin(Request $request)
    {
        $time = new Time();
        $date = date("Y-m-d");
        $checkin = date("H:i:s");
        $record = $time->where("date", $date)->first();

        if ($record) {
            return response()->json(["message" => "Bạn đã checkin ngày hôm "], 422);
        } else {
            $user = $request->user();
            $data = $user->times()->create(compact('date', 'checkin'));
            if ($data) {
                return response()->json(compact('data'));
            } else {
                return response()->json(['message' => 'Đã xảy ra lỗi'], 500);
            }
        }
    }

    public function checkout(Request $request)
    {
        $time = new Time();
        $date = date("Y-m-d");
        $checkout = date("H:i:s");
        $record = $time->where("date", $date)->first();
        if ($record) {
            if ($record->checkout) {
                return response()->json(["message" => "Bạn đã checkout ngày hôm nay"], 422);
            } else {
                $data = $record->update(compact('checkout'));
                if ($data) {
                    return response()->json(compact('data'));
                } else {
                    return response()->json(['message' => 'Đã xảy ra lỗi'], 500);
                }
            }
        } else {
            return response()->json(["message" => "Bạn chưa checkin ngày hôm nay"], 422);
        }
    }

    public function getData(Request $request)
    {
        $date = $request->query('date') ?? date("Y-m-d");
        $month = date("m", strtotime($date));
        $year = date("Y", strtotime($date));

        $records = DB::table('times')
            ->where('user_id', $request->user()->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        $dayOffs = DB::table('day_offs')
            ->where('user_id', $request->user()->id)
            ->where('status', "1")
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        $records = $records->map(function ($record) use ($dayOffs) {
            if (strtotime($record->checkin) > strtotime($this->checkinTime)) {
                $record->checkinColor = $this->errorColor;
            } else {
                $record->checkinColor = $this->successColor;
            }

            if ($record->checkout) {
                if (strtotime($record->checkout) < strtotime($this->checkoutTime)) {
                    $record->checkoutColor = $this->errorColor;
                } else {
                    $record->checkoutColor = $this->successColor;
                }
            } else {
                $record->checkoutColor = "";
                $record->checkout = "";
            }

            $record->dayOffs = $dayOffs->filter(function ($day) use ($record) {
                return $record->date === $day->date;
            });

            return $record;
        });

        $response = collect([
            "data" => $records,
            "workingDays" => $this->getWorkingDays($year, $month, [0, 6]),
            "actualWorkdays" =>  $this->getActualWorkdays($records, $dayOffs)
        ]);

        return response()->json($response);
    }

    public function getWorkingDays($year, $month, $ignore)
    {
        $count = 0;
        $counter = mktime(0, 0, 0, $month, 1, $year);
        while (date("n", $counter) == $month) {
            if (in_array(date("w", $counter), $ignore) == false) {
                $count++;
            }
            $counter = strtotime("+1 day", $counter);
        }

        return $count;
    }

    public function getActualWorkdays($workDayData)
    {
        $response = $workDayData->map(function ($day) {
            $point = 1;

            if (strtotime($day->checkin) > strtotime($this->checkinTime)) {
                $point = $point - 0.5;
            }

            if ($day->checkout && strtotime($day->checkout) < strtotime($this->checkoutTime)) {
                $point = $point - 0.5;
            }

            return $point;
        })->toArray();

        return array_sum($response);
    }
}
