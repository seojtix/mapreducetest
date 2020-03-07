<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

final class WebServerTest extends TestCase {

    public function testCanBeValidResponse(): void {
        $client = new Client([
            'base_uri' => 'http://web/',
            'verify' => false
        ]);
        $response = $client->request('GET', '/users');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanBeInvalidResponse(): void {
        $client = new Client([
            'base_uri' => 'http://web/',
            'verify' => false,
            'http_errors' => false
        ]);
        $response = $client->request('GET', '/');

        $this->assertEquals(404, $response->getStatusCode());
    }

}
