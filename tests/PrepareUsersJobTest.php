<?php

use PHPUnit\Framework\TestCase;
use Application\Job\PrepareUsers;

final class PrepareUsersJobTest extends TestCase {

    public function testCanBeValidReturn(): void {
        $input = [
            ['login' => 'login1', 'followers_url' => 'http://google.com/', 'repos_url' => 'http://google.com/'],
            ['login' => 'login2', 'followers_url' => 'http://google.com/', 'repos_url' => 'http://google.com/'],
            ['login' => 'login3', 'followers_url' => 'http://google.com/', 'repos_url' => 'http://google.com/'],
            ['login' => 'login4', 'followers_url' => 'http://google.com/', 'repos_url' => 'http://google.com/'],
        ];
        $output = [
            ['login' => 'login1', 'followers' => 'http://google.com/', 'repositories' => 'http://google.com/'],
            ['login' => 'login2', 'followers' => 'http://google.com/', 'repositories' => 'http://google.com/'],
            ['login' => 'login3', 'followers' => 'http://google.com/', 'repositories' => 'http://google.com/'],
            ['login' => 'login4', 'followers' => 'http://google.com/', 'repositories' => 'http://google.com/'],
        ];

        $this->assertSame($output, (new PrepareUsers)->__invoke($input));
    }

}
