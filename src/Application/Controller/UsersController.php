<?php

namespace Application\Controller;

use Application\Enum\ResponseStatus;
use Application\Factory\GithubApiFactory;
use Application\Job;
use League\Pipeline\Pipeline;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersController {

    private function getJobsPipeline(string $token): Pipeline {
        return (new Pipeline)
            ->pipe(new Job\PrepareUsers)
            ->pipe(new Job\GetRequests)
            ->pipe(new Job\AsyncFetch($token))
            ->pipe(new Job\Reduce);
    }

    public function index(Request $request): JsonResponse {
        try {
            $query = $request->query->get('q', '');
            $github_api_key = $request->server->get('GITHUB_API_KEY');
            $users = GithubApiFactory::getData(GithubApiFactory::getUrl($query), $github_api_key);

            return new JsonResponse(
                $this->getJobsPipeline($github_api_key)->process($query !== '' ? $users['items'] : $users),
                ResponseStatus::OK,
                ['Content-Type' => 'application/json']
            );
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit();
        }
    }

}
