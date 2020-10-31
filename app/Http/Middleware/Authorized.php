<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;

class Authorized
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $client = $this->userRepository->getClient($request->client_id);

        if(!$client || ($client && $client->getSecret() != $request->client_secret))
        {
            return response()->json([
                'success' => false,
                'message' => 'Invalid client'
            ], 401);
        }

        $user = $this->userRepository->getUserByPhone($request->phone);

        if (!$user)
        {
            return response()->json([
                'success' => false,
                'message' => 'Invalid phone'
            ], 401);
        }

        if($this->userRepository->checkAuth($request->bearerToken(), $client, $user)){
            return $next($request);
        }       
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid token'
        ], 401);
    }
}