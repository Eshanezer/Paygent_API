<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseModel extends Model
{
    use HasFactory;

    public static function sendJSON($statusCode, $message = null, $data = null)
    {
        $dataResponse=['code' => $statusCode];
        if($data)
            $dataResponse['data']=$data;
        if($message)
            $dataResponse['message']=$message;
        return response()->json($dataResponse,$statusCode);
    }
}
