<?php

namespace App\Http\Controllers\api\Organization;

use App\Http\Requests\Auth\LoginAdminRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Organization;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrganizationAuthController extends Controller
{
    use ApiResponse;


    public function login(LoginAdminRequest $request)
    {
        $organization = Organization::where('email', $request->email)
            ->first();
      //  dd($organization);
        if ($organization && Hash::check($request->password, $organization->password)) {
            $data = [
                'type' => 'organization',
                'admin' => $organization,
                'token' => $organization->createToken($organization->email)->plainTextToken
            ];
            return $this->okApiResponse($data,__('Organization loaded'));
        } else {
            return $this->unauthorizedApiResponse([],__('Email or password is incorrect'));
        }


    }


    public function logout(Request $request)
    {
        $organization = Auth::guard('organization')->user();

        if ($organization) {
            $organization->tokens()->delete();
            return $this->okApiResponse([],__('Logged out successfully'));

        }
        return $this->unauthorizedApiResponse([],__('User not found'));

    }
}
