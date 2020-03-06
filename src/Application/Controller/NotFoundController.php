<?php

namespace Application\Controller;

use Application\Enum\ResponseStatus;
use Symfony\Component\HttpFoundation\Response;

class NotFoundController {

    public function exception(): Response {
        return new Response(
            '404 Not Found',
            ResponseStatus::NOT_FOUND
        );
    }

}
