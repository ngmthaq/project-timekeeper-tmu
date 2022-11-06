<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\DayOffManager;
use App\Http\Requests\UpdateDayOff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ManagerDayOffControler extends Controller
{
    public function getManagerDayOff(DayOffManager $request): \Illuminate\Http\JsonResponse
    {
        try {

            $userId = Auth::user()->id;
            $year = $request->query('year');
            $month = $request->query('month');

            $res = DB::table('day_offs')
                ->where('user_id', '!=', $userId)
                ->join('users', 'users.id', '=', 'day_offs.user_id')
                ->select('users.name', 'day_offs.*')
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->get();

            return response()->json([
                "response" => $res,
            ]);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Đã xảy ra lỗi", 'details' => $th->getMessage()], 500);
        }
    }

    public function updateManagerDayOff(UpdateDayOff $request)
    {
        try {

            $id = $request->input('id');
            $status = $request->input('status');

            $res = DB::table('day_offs')
                ->where('id', $id)
                ->update(['status' => $status + 1]);

            return response()->json([
                "response" => $res,
            ]);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Đã xảy ra lỗi", 'details' => $th->getMessage()], 500);
        }
    }
}
