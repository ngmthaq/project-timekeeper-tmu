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

        $records = $records->map(function ($record) {
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

            return $record;
        });

        return response()->json($records);
    }
}
