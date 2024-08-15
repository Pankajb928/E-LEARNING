<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTService
{
    protected $key;

    public function __construct()
    {
        // Set your secret key here
        $this->key = env('JWT_SECRET');
    }

    /**
     * Encode user data into a JWT token.
     *
     * @param  array $userData
     * @return string
     */
    public function tokenEncode(array $userData): string
    {
        $payload = [
            'sub' => $userData['id'], // Subject
            'email' => $userData['email'], // User email
            'iat' => time(), // Issued at
            'exp' => time() + 3600, // Expiration time (1 hour)
        ];

        return JWT::encode($payload, $this->key, 'HS256');
    }

    /**
     * Decode a JWT token and return the payload.
     *
     * @param  string $token
     * @return object
     * @throws Exception
     */
    public function tokenDecode(string $token)
    {
        // Remove the 'Bearer ' prefix if it's present in the token string
        if (strpos($token, 'Bearer ') === 0) {
            $token = substr($token, 7);
        }
    
        try {
            return JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (Exception $e) {
            throw new Exception('Invalid token: ' . $e->getMessage());
        }
    }
    
}
