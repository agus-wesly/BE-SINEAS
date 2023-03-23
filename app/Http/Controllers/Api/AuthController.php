<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Services\Socialite\ISocialiteService;
use App\Services\User\IUserService;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseAPI;
    private IUserService $userService;
    private ISocialiteService $socialite;

    /**
     * @param IUserService $userService
     * @param ISocialiteService $socialite
     */
    public function __construct(IUserService $userService, ISocialiteService $socialite)
    {
        $this->userService = $userService;
        $this->socialite = $socialite;
    }


    public function Login(LoginRequest $request): JsonResponse
    {
        $user = $this->userService->getUserByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error('Account not registered', 401);
        }

        $token = $user->createToken('token', ['auth'])->plainTextToken;

        return $this->success('successfully to login', [
            '$data' => $user,
            'token' => $token
        ]);
    }

    public function Register(RegisterRequest $request): JsonResponse
    {
        try {
            $this->userService->addUser($request->all());
        } catch (\Exception $e) {
            report($e);
            return $this->error('email is available', 400);
        }
        return $this->success('successfully to register', null, 200);
    }

    public function logout(): JsonResponse
    {
        try {
            request()?->user()?->tokens()->delete();
        } catch (\Exception $e) {
            return $this->error('a server error occurred', 500);
        }
        return  $this->success('logged out successfully', null);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectToProvider(): JsonResponse
    {
        try {
            $url = $this->socialite->redirect('google');
        } catch (\Exception $e)
        {
            return $this->error('a server error occurred', 500);
        }
        return $this->success('page socialite', $url, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleProviderCallback()
    {
        try {
           $data = $this->socialite->redirectCallback('google');
        } catch (\Exception $e) {
            report($e);
            return $this->error("login failed", 500);
        }
        return $this->success('successfully to login', $data, 200);
    }

}
