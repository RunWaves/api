<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Services\Helper;
use Socialite;
use Illuminate\Http\Request;
use App\Repositories\Users\UserRepository;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callBack($provider)
    {
        $result = $this->userRepo->callBackSocialLite($provider);
        $response = [
            'success' => true,
            'data' => $result,
        ];

        return $this->response($response);
    }

    public function register(Request $request)
    {
        // Validate
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // Sanitize input
        $data['password'] = bcrypt($request->password);

        // Call repository
        $user = $this->userRepo->register($data);

        // Return response
        $response = [
            'success' => true,
            'data' => $user,
        ];

        return $this->response($response);
    }

    public function login(Request $request)
    {
        // Validate
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // Sanitize input

        // Call repository
        $user = $this->userRepo->login($data);

        // Return response
        $response = [
            'success' => true,
            'data' => $user,
        ];

        return $this->response($response);
    }
}
