<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Validations\UserValidator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        DB::table('texts')->insert(
            ['content' => $request->getContent()]
        );
        $validator = UserValidator::validate($request->all());

        if ($validator->fails()){
            return response()->json(
            [
                'success' => false,
                'errors'=>$validator->errors()->all()
            ], 422);
        }

        if(!$this->authService->checkClient($request))
        {
            return response()->json([
                'success' => false,
                'message' => 'Invalid client'
            ], 401);
        }

        $this->authService->registrateUser($request);

        return response()->json([
            'success' => true
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function signin(Request $request)
    {   
        if(!$this->authService->checkUser($request))
        {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        if(!$this->authService->checkClient($request))
        {
            return response()->json([
                'success' => false,
                'message' => 'Invalid client'
            ], 401);
        }

        $accessToken = $this->authService->loginUser($request);
        
        return response()->json([
            'success' => true,
            'access_token' => $accessToken,
            'token_type' => 'Bearer'
        ], 200);
    }
  
    /**
     * Logout user
     *
     * @return [string] message
     */
    public function signout(Request $request)
    {
        $this->authService->logoutUser($request);
        return response()->json([
            'success' => true,
        ], 201);
    }

    /**
     * Set Push token
     *
     * @return [string] message
     */
    public function setPushToken(Request $request)
    {
        if($this->authService->setPushToken($request))
        {
            return response()->json([
                'success' => true,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
            ], 400);
        }
    }
}