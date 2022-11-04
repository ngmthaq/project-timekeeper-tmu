<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authTokenName = "auth-token-name";

    public function login(LoginRequest $request)
    {
        try {
            $username = $request->input("username");
            $password = $request->input("password");
            $isLogin = Auth::attempt(["username" => $username, "password" => $password]);

            if ($isLogin) {
                $token = $this->generateToken(Auth::user());

                return response()->json([
                    "access_token" => $token,
                    "token_type" => "Bearer",
                ]);
            }

            return response()->json(["message" => "Sai tài khoản hoặc mật khẩu"], 401);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Đã xảy ra lỗi"], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            Auth::logout();

            return response()->json(["message" => "Đăng xuất thành công"]);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Đăng xuất thành công"]);
        }
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    private function generateToken(User $user)
    {
        $token = $user->createToken($this->authTokenName);

        return $token->plainTextToken;
    }
}
