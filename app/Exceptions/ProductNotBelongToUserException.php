<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ProductNotBelongToUserException extends Exception
{
    public function render()
    {
        return response()->json([

            "error"=>"Not Authorized"
        ],Response::HTTP_UNAUTHORIZED);


    }
}
