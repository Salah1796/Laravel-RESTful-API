<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
//use Zend\Diactoros\Response;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait  ApiExceptionTrait
{
    public function apiException($request, $e)
    {

        if ($e instanceof ModelNotFoundException) {
            return response()->json([

                "errors" => "Model Not Found"
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {

            return response()->json([

                "errors" => "Incorrect  Route"
            ], Response::HTTP_NOT_FOUND);
        }
        return parent::render($request, $e);


    }


}