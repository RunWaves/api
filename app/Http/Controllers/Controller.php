<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $result = [
        'success' => false,
        'message' => 'Unknown Error.',
    ];

    protected function response($response, $meta = null, $statusCode = 200)
    {
        if (! empty($response['success'])) {
            return $this->responseSuccess($response['data'], $meta);
        } else {
            return $this->responseFail($response['message'], $statusCode);
        }
    }

    private function responseSuccess($data, $meta = null)
    {
        $this->result = [
            'success' => true,
            'message' => 'Action completed.',
            'data' => $data,
            'meta' => $meta,
        ];

        return response($this->result, 200);
    }

    private function responseFail($message, $statusCode = 200)
    {
        $this->result['message'] = $message;

        return response($this->result, $statusCode);
    }

    protected function responseDataNotFound()
    {
        return $this->responseFail('Data is not found.', 404);
    }
}
