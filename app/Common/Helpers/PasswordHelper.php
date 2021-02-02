<?php

namespace Common\Helpers;

use Illuminate\Support\Facades\Hash;

class PasswordHelper
{
    public static function isCorrect(string $password, string $passwordHash): bool
    {
        return Hash::check($password, $passwordHash);
    }

    public static function getHash(string $password): string
    {
        return Hash::make($password);
    }

    public static function encrypt(string $password): string
    {
        $cryptKey = config('app.crypt_key');

        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($password, $cipher, $cryptKey, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $cryptKey, $as_binary = true);

        return base64_encode($iv . $hmac . $ciphertext_raw);
    }

    public static function decrypt(string $encrypted): string
    {
        $cryptKey = config('app.crypt_key');

        $c = base64_decode($encrypted);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $ciphertext_raw = substr($c, $ivlen + 32);

        return openssl_decrypt($ciphertext_raw, $cipher, $cryptKey, $options = OPENSSL_RAW_DATA, $iv);
    }
}
