<?php

namespace App;

/*
|--------------------------------------------------------------------------
| ResponseFormat Class
|--------------------------------------------------------------------------
|
| A class to hold all the application's responses.
|
 */


class ResponseFormat
{
    public function success($data = [], $message = 'Operation Successful.', $code = '200')
    {
       return $this->response($data, $message, $code );
    }

    public function error($data = [], $message = 'Operation failed.', $code = '50')
    {
        return $this->response( $data, $message, $code);
    }

    public function notFound($data = [], $message = 'Resource Was not found.', $code = '404')
    {
        return $this->response($data, $message, $code);
    }

    // All helper response methods using this.
    public function response($data =[], $message, $code )
    {
        return response()->json([
            'responseMessage' => $message,
            'responseCode' => $code,
            'data' => $data ?? []
        ]);
    }
}
