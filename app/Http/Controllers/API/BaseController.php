<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
    	$response = [
            'status'=> 'success',
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'status'=> 'success',
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

}
