<?php

namespace App\Services\Socialite;

use App\Services\User\IUserService;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Google_Client;
use Google_Service_Oauth2;

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
        $data['email'] = $user->email;
        $data['name'] = $user->name;
        $data['telp'] = "11111111";
        $data['password'] = \Hash::make('12345678');
        $existingUser = $this->userService->addUser($data);
    }


    $token = $existingUser->createToken('token', ['auth'])->plainTextToken;

    return [
        "token" => $token,
        "user" => $existingUser
      ];
  }

    public function handleVerifyGoogle(string $idToken): array
    {
        $client = new Google_Client([
            'client_id' => env('GOOGLE_CLIENT_ID'),
        ]);

        $payload = $client->verifyIdToken($idToken);

        if (!$payload) {
           throw ValidationException::withMessages([
                "error" => ["Invalid token"],
            ]);
        }

        $existingUser = $this->userService->getUserByEmail($payload['email']);
        if (!$existingUser)
        {
            $data['email'] = $payload['email'];
            $data['name'] = $payload['name'];
            $data['telp'] = "11111111";
            $data['password'] = \Hash::make(Str::uuid());
            $existingUser = $this->userService->addUser($data);
        }

        return [
            "token" => $existingUser->createToken('token', ['auth'])->plainTextToken,
            "user" => $existingUser
        ];
    }


}
