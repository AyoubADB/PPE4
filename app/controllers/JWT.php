<?php

namespace ppe4\controllers;

use ppe4\models\Role;

class JWT
{
    public function generer_payload(
        string $id,
        string $email,
        Role $role,
    ): array {
        return [
            "user_id" => $id,
            "user_email" => $email,
            "user_role" => $role->getLibelle(),
        ];
    }

    public function generer_jwt(array $payload, int $validite = 14400): string
    {
        if ($validite > 0) {
            $now = new \DateTime();
            $expiration = $now->getTimestamp() + $validite;
            $payload["iat"] = $now->getTimestamp();
            $payload["exp"] = $expiration;
        }

        $base_64_header = base64_encode(json_encode(JWT_HEADER));
        $base_64_payload = base64_encode(json_encode($payload));

        $base_64_header = str_replace(
            ["+", "/", "="],
            ["-", "_", ""],
            $base_64_header,
        );
        $base_64_payload = str_replace(
            ["+", "/", "="],
            ["-", "_", ""],
            $base_64_payload,
        );

        $secret = base64_encode(JWT_SECRET);
        $signature = hash_hmac(
            "sha256",
            $base_64_header . "." . $base_64_payload,
            $secret,
            true,
        );

        $base_64_signature = base64_encode($signature);
        $base_64_signature = str_replace(
            ["+", "/", "="],
            ["-", "_", ""],
            $base_64_signature,
        );

        $jwt =
            $base_64_header . "." . $base_64_payload . "." . $base_64_signature;

        return $jwt;
    }

    public function verifier_validite(string $token): bool
    {
        $payload = $this->get_payload($token);

        $token_verifie = $this->generer_jwt((array) $payload, 0);

        return $token === $token_verifie;
    }


    public function get_header(string $token): array
    {
        $array = explode(".", $token);
        $header = $array[0];

        return json_decode(base64_decode($header), true);
    }


    public function get_payload(string $token): array
    {
        $array = explode(".", $token);
        $payload = $array[1];

        return json_decode(base64_decode($payload), true);
    }


    public function est_expire(string $token): bool
    {
        $payload = $this->get_payload($token);

        $now = new \DateTime();

        return $payload["exp"] < $now->getTimestamp();
    }


    public function est_valide(string $token): bool
    {
        return preg_match(
            '/^[a-zA-Z0-9\-_=]+\.[a-zA-Z0-9\-_=]+\.[a-zA-Z0-9\-_=]+$/',
            $token,
        ) === 1;
    }

    public function get_role(string $token): string
    {
        $payload = $this->get_payload($token);
        return $payload["user_role"];
    }
}
