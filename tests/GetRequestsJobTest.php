<?php

use PHPUnit\Framework\TestCase;
use Application\Job\GetRequests;

final class GetRequestsJobTest extends TestCase {

    public function testCanBeValidReturn(): void {
        $input = [
            ['login' => 'login1', 'followers' => 'http://google.com/', 'repositories' => 'http://google.com/'],
            ['login' => 'login2', 'followers' => 'http://google.com/', 'repositories' => 'http://google.com/'],
            ['login' => 'login3', 'followers' => 'http://google.com/', 'repositories' => 'http://google.com/'],
            ['login' => 'login4', 'followers' => 'http://google.com/', 'repositories' => 'http://google.com/'],
        ];
        $output = [
            ['login' => 'login1', 'type' => 'followers', 'url' => 'http://google.com/'],
            ['login' => 'login2', 'type' => 'followers', 'url' => 'http://google.com/'],
            ['login' => 'login3', 'type' => 'followers', 'url' => 'http://google.com/'],
            ['login' => 'login4', 'type' => 'followers', 'url' => 'http://google.com/'],
            ['login' => 'login1', 'type' => 'repositories', 'url' => 'http://google.com/'],
            ['login' => 'login2', 'type' => 'repositories', 'url' => 'http://google.com/'],
            ['login' => 'login3', 'type' => 'repositories', 'url' => 'http://google.com/'],
            ['login' => 'login4', 'type' => 'repositories', 'url' => 'http://google.com/'],
        ];

        $this->assertSame($output, (new GetRequests)->__invoke($input));
    }

}
