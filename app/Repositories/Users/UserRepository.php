<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserRepository extends RepositoryInterface
{
    /**
     * Find the user by email.
     * @param string $email
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByEmail(string $email);

    /**
     * Check the username is existed in database.
     * @param string $username
     * @return bool
     */
    public function checkUsername(string $username): bool;

    /**
     * Generate the username.
     * @param string $name
     * @return string
     */
    public function generateUsername(string $name): string;

    public function register(array $data);

    public function login(array $data);
}
