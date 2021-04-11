<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepository;
use App\Services\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function createUser(Request $request)
    {
        // Validate
        $data = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        // Sanitize input
        $data['slug'] = Helper::slug($data['name']);
        $data['start_date'] = Carbon::createFromFormat('d-m-Y', $data['start_date']);
        $data['end_date'] = Carbon::createFromFormat('d-m-Y', $data['end_date']);

        // Call repository
        $user = $this->userRepo->model()->create($data);

        // Return response
        $response = [
            'success' => true,
            'data' => $user
        ];
        return $this->response($response);
    }
}
