<?php

namespace App\Exceptions;

use Exception;

class InvalidBookDataException extends Exception
{
    // custom implementation for invalid book data


    public function render()
    {
        return response()->json([
            'message' => 'Invalid book data from API'
        ], 400);
    }
}
