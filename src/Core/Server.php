<?php

namespace Core;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpKernel;

class Server {
    private RequestStack $requestStack;
    private EventDispatcher $eventDispatcher;
    private ControllerResolver $controllerResolver;
    private ArgumentResolver $argumentResolver;
    private Request $request;

    public function __construct(RequestStack $requestStack, EventDispatcher $eventDispatcher, Request $request) {
        $this->requestStack = $requestStack;
        $this->eventDispatcher = $eventDispatcher;
        $this->controllerResolver = new ControllerResolver();
        $this->argumentResolver = new ArgumentResolver();
        $this->request = $request;
    }

    public function start() {
        $kernel = new HttpKernel($this->eventDispatcher, $this->controllerResolver, $this->requestStack, $this->argumentResolver);

        $response = $kernel->handle($this->request);
        $response->send();

        $kernel->terminate($request, $response);
    }

}
