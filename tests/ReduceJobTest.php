<?php

use PHPUnit\Framework\TestCase;
use Application\Job\Reduce;

final class ReduceJobTest extends TestCase {

    public function testCanBeValidReturn(): void {
        $input = [
            ['login' => 'login1', 'type' => 'type1', 'data' => 1],
            ['login' => 'login1', 'type' => 'type2', 'data' => 2],
            ['login' => 'login2', 'type' => 'type1', 'data' => 3],
            ['login' => 'login2', 'type' => 'type2', 'data' => 4],
        ];
        $output = [
            'login1' => [
                'type1' => 1,
                'type2' => 2
            ],
            'login2' => [
                'type1' => 3,
                'type2' => 4
            ]
        ];

        $this->assertSame($output, (new Reduce)->__invoke($input));
    }

}
