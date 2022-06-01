<?php

namespace App\Traits;


trait ResponseAPI
{
    public function baseResponse(string $message, $data , int $status)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function successResponse(string $message = 'success', $data = null , $status = 200){
        return $this->baseResponse($message, $data, $status);
    }
    public function errorResponse(string $message = 'error', $data = null,  $status = 404){
        return $this->baseResponse($message, $data, $status);
    }
}
