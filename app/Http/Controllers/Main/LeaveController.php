<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\DayOffRequest;
use App\Http\Requests\GetDayOffRequest;
use App\Models\DayOff;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function handleDayOff(DayOffRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $shifts = $request->input('shifts');
            $date = $request->input('date');
            $reason =  $request->input('reason');
            $user = User::find(Auth::user()->id);

            $res = $user->dayOffs()->create([
                'shifts' => $shifts,
                'date' => $date,
                'reason' => $reason,
            ]);
            return response()->json([
                "shifts" => $shifts,
                "date" => $date,
                "reason" => $reason,
                "response" => $res,
            ]);

        } catch (\Throwable $th) {
            return response()->json(["message" => "Đã xảy ra lỗi", 'details' => $th->getMessage()], 500);
        }
    }

    public function getDayOff(GetDayOffRequest $request) {
        try {
            $year = $request->query('year');
            $month = $request->query('month');
            $userId = Auth::user()->id;

            $res = DB::table('day_offs')
                    ->where('user_id', $userId)
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)->get();
            return response()->json([
                "response" => $res,
            ]);

        } catch (\Throwable $th) {
            return response()->json(["message" => "Đã xảy ra lỗi", 'details' => $th->getMessage()], 500);
        }
    }

}
