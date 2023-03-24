<?php

namespace App\Services\Socialite;

interface ISocialiteService
{
  public function redirect(string $provider);
  public function redirectCallback(string $provider): array;
  public function handleVerifyGoogle(string $idToken): array;
}
