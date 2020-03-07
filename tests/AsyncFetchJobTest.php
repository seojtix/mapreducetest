<?php

use PHPUnit\Framework\TestCase;
use Application\Job\AsyncFetch;
use Symfony\Component\Dotenv\Dotenv;
use Application\Factory\GithubApiFactory;

final class AsyncFetchJobTest extends TestCase {

    public function testCanBeValidReturn(): void {
        $dotenv = new Dotenv();
        $dotenv->loadEnv(__DIR__ . '/../.env');

        $input = [
            ['login' => 'seojtix', 'type' => 'followers', 'url' => 'https://api.github.com/users/seojtix/followers'],
            ['login' => 'seojtix', 'type' => 'repositories', 'url' => 'https://api.github.com/users/seojtix/repos'],
        ];
        $output = [
            ['login' => 'seojtix', 'type' => 'followers', 'data' => GithubApiFactory::getData('https://api.github.com/users/seojtix/followers', $_ENV['GITHUB_API_KEY'])],
            ['login' => 'seojtix', 'type' => 'repositories', 'data' => GithubApiFactory::getData('https://api.github.com/users/seojtix/repos', $_ENV['GITHUB_API_KEY'])],
        ];

        $this->assertSame($output, (new AsyncFetch($_ENV['GITHUB_API_KEY']))->__invoke($input));
    }

}
