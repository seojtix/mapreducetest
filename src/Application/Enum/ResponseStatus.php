<?php

namespace Application\Enum;

use Symfony\Component\HttpFoundation\Response;

class ResponseStatus {
    const OK = Response::HTTP_OK; // HTTP 200
    const NOT_FOUND = Response::HTTP_NOT_FOUND; // HTTP 404
}
