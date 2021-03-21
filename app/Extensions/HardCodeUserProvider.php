<?php

namespace App\Extensions;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class HardCodeUserProvider implements UserProvider
{
    protected $users;

    public function __construct(array $users)
    {
        $this->users = collect($users);
    }

    public function retrieveById($identifier)
    {
        $user = $this->users->where('username', $identifier)->first();
        
        return $this->getGenericUser($user);
    }

    public function retrieveByToken($identifier, $token)
    {
        // Not implemented
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Not implemented
    }

    public function retrieveByCredentials(array $credentials)
    {
        $user = $this->users
            ->where('username', $credentials['username'])
            ->where('password', $credentials['password'])
            ->first();
        
        return $this->getGenericUser($user);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
    }

    /**
     * Get the generic user.
     *
     * @param  mixed  $user
     */
    protected function getGenericUser($user)
    {
        if (! is_null($user)) {
            return new GenericUser((array) $user);
        }
    }
}
