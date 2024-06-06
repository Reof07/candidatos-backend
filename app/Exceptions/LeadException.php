<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LeadException extends Exception
{
    protected $statusCode;
    protected $errors;

    public function __construct($message = "", $statusCode = Response::HTTP_BAD_REQUEST, $errors = [])
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->errors = $errors;
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'data' => [],
            'meta' => [
                'success' => false,
                'status' => $this->statusCode,
                'errors' => [$this->getMessage()],
            ],
        ], $this->statusCode);
    }
}
