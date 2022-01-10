<?php


namespace App\Http\Traits;

use Illuminate\Http\Response;

trait RespondsWithHttpStatus
{

    protected int $pages = 50;

    protected function success($data = [],int $status = 200, string $message = "Request processed successfully!"): Response
    {
        return response(['success' => true, 'message' => $message, 'data' => $data], $status);
    }

    protected function failure($data = [], int $status = 422, string $message = "Unable to process request!"): Response
    {
        return response(['success' => false, 'message' => $message, 'errors' => $data], $status);
    }
}
