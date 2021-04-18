<?php

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    public function register(array $data)
    {
        $result = ["message"=> "email is existed" ];
        $user = $this->model()->where('email', $data['email'])->first();
        if (empty($user)) {
            $newUser = $this->model()->create($data);
            $accessToken = $newUser->createToken('authToken')->accessToken;
            $result['access_token'] = $accessToken;
            $result['user'] = $newUser;
            unset($result["message"]);
        }
        return $result;
    }

    public function login(array $data) {
        $result = ['message' => 'Login failed'];
        if (!auth()->attempt($data)) {
            return $result;
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        unset($result["message"]);
        $result['user'] = auth()->user();
        $result['access_token'] = $accessToken;
        return $result;
    }
}
