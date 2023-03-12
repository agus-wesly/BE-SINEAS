<?php

namespace App\Services\Socialite;

use App\Services\User\IUserService;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class SocialiteService implements ISocialiteService
{
  /**
   * @param IUserService $userService
   */
  public function __construct(IUserService $userService)
  {
    $this->userService = $userService;
  }


  public function redirect(string $provider)
    {
      return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    }

  public function redirectCallback(string $provider): array
  {
    try {
      $user = Socialite::driver($provider)->stateless()->user();
    } catch (\Exception $e)
    {
      throw ValidationException::withMessages([
        "error" => ["User not Found"]
      ]);
    }

    $existingUser = $this->userService->getUserByEmail($user->email);
    if (!$existingUser)
    {
      $this->userService->addUser($user);
    }

    $token = $existingUser->createToken('token', ['auth'])->plainTextToken;

    return [
        "token" => $token,
        "user" => $user
      ];
  }


}
