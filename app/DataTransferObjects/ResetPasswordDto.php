<?php

namespace App\DataTransferObjects;

class ResetPasswordDto
{
    public function __construct(
        public readonly ?string $email= null,
        public readonly ?string $password = null,
        public readonly ?string $password_confirmation= null,
        public readonly ?string $token= null,
    )
    {}

    public static function fromRequest(array $request): self
    {
        return new self(
            email: $request['email'],
            password: $request['password'],
            password_confirmation: $request['password_confirmation'],
            token: $request['token'],
        );
    }

    public static function createToken(string $email, string $token): self
    {
        return new self(
            email: $email,
            token: $token,
        );
    }
}
