<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\EmailService;
use App\Validations\UserValidator;

class AuthController extends Controller
{

    /**
     * @var AuthService
     */
    private $authService;

    /**
     * @var EmailService
     */
    private $emailService;

    public function __construct(AuthService $authService, EmailService $emailService)
    {
        $this->authService = $authService;
        $this->emailService = $emailService;
    }

    public function signup(Request $request)
    {
        $this->emailService->sendEmail();
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
        ], 200);
    }
  
    public function signin(Request $request)
    {   
        
        if(!$this->authService->checkClient($request))
        {
            return response()->json([
                'success' => false,
                'message' => 'Invalid client'
            ], 401);
        }

        if(!$this->authService->checkUser($request))
        {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
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
        ], 200);
    }

    public function sendEmail(Request $request)
    {
        $this->emailService->sendEmail();
    }
}