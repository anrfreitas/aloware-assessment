<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class CustomExceptionHandler
{
    /**
     * @param Exception $e
     * @return void
    */
    public static function handleException(\Exception $e): void {
        if (env('APP_DEBUG', false)) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, $e->getMessage());
        }

        abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'Unprocessable entity');
    }
}