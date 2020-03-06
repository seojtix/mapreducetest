<?php

namespace Core;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\DebugClassLoader;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\EventListener\DisallowRobotsIndexingListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Bootstrap {

    public static function init() {
        $dotenv = new Dotenv();
        $dotenv->loadEnv(ROOT_DIR . '/../.env');

        $requestStack = new RequestStack();
        $request = Request::createFromGlobals();

        if ($request->server->getBoolean('APP_DEBUG') === true) {
            ErrorHandler::register();
            Debug::enable();
            DebugClassLoader::enable();
        }

        $server = new Server(
            $requestStack,
            static::getEventDispatcher($requestStack),
            $request
        );
        $server->start();
    }

    private function getEventDispatcher(RequestStack $requestStack): EventDispatcher {
        $eventDispatcher = new EventDispatcher();
        $matcher = new UrlMatcher(static::getRoutes(), new RequestContext());
        $eventDispatcher->addSubscriber(
            new RouterListener($matcher, $requestStack)
        );
        $eventDispatcher->addSubscriber(
            new DisallowRobotsIndexingListener()
        );

        return $eventDispatcher;
    }

    private function getRoutes(): RouteCollection {
        $fileLocator = new FileLocator([ROOT_DIR . '/../config']);
        $loader = new YamlFileLoader($fileLocator);

        return $loader->load('routes.yaml');
    }

}
