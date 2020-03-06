<?php

namespace Application\Job;

use Amp\Promise;
use function Amp\ParallelFunctions\parallelMap;
use Application\Factory\GithubApiFactory;

class AsyncFetch {
    private $token;

    public function __construct($token) {
        $this->token = $token;
    }

    /**
     * Scrape github urls' data in separate parallel processes
     * You can use up to 32 process at same time
     * More details here: https://amphp.org/parallel-functions/
     */
    public function __invoke($items) {
        $token = $this->token;

        return Promise\wait(parallelMap($items, function ($item) use ($token) {
            return [
                'login' => $item['login'],
                'type' => $item['type'],
                'data' => GithubApiFactory::getData($item['url'], $token)
            ];
        }));
    }

}
