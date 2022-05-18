<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseModel extends Model
{
    use HasFactory;

    public static function sendJSON($statusCode, $message = null, $data = null)
    {
        return response()->json(['data' => $data, 'code' => $statusCode, 'message' => $message],$statusCode);
    }
}
