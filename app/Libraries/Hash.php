<?php

namespace App\Libraries;

use InvalidArgumentException;

class Hash
{
    public static function make(string $password): string
    {
        if (empty($password)) {
            throw new InvalidArgumentException('Password cannot be empty.');
        }

        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function check(string $password, string $hash): bool
    {
        if (empty($password) || empty($hash)) {
            throw new InvalidArgumentException('Password and hash cannot be empty.');
        }

        return password_verify($password, $hash);
    }
}