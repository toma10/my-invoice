<?php

namespace App;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class InvalidStatusTransitionException extends Exception implements Responsable
{
    public function toResponse($request)
    {
        throw new HttpException(Response::HTTP_FORBIDDEN);
    }
}
