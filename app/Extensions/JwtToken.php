<?php
namespace App\Extensions;

class JwtToken {

    protected $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function __get($key)
    {
        return $this->{$key};
    }
}