<?php

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email)
    {
        return $this->model()->where('email', $email)->first();
    }

    public function checkUsername(string $username): bool
    {
        $username = $this->model()->where('username', $username)->first();

        return ! empty($username);
    }

    public function generateUsername(string $name): string
    {
        do {
            $username = Str::of($name)->lower()->slug('_') . '_' . mt_rand(100, 999);
        } while ($this->checkUsername($username));

        return $username;
    }
}
