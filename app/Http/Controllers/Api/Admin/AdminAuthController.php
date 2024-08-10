<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Requests\Auth\LoginAdminRequest;
use App\Http\Resources\CompanyResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    use ApiResponse;


    public function login(LoginAdminRequest $request)
    {
        $admin = Admin::where('email', $request->email)
            ->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            $data = [
                'type' => 'admin',
                'admin' => $admin,
                'token' => $admin->createToken($admin->email)->plainTextToken
            ];
            return $this->okApiResponse($data,__('Admin loaded'));
        } else {
            return $this->unauthorizedApiResponse([],__('Email or password is incorrect'));
        }


    }


    public function logout(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $admin->tokens()->delete();
            return $this->okApiResponse([],__('Logged out successfully'));

        }
        return $this->unauthorizedApiResponse([],__('User not found'));

    }
}
