<?php

namespace Application\Factory;

class GithubApiFactory {

    /**
     * Detect right github api based on incoming $query
     */
    public static function getUrl($query) {
        return $query !== '' ? 'https://api.github.com/search/users?q=' . $query : 'https://api.github.com/users';
    }

    /**
     * Make request to github api via CURL
     * Use token as basic http data (for increasing rate limits)
     */
    public static function getData($url, $token) {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'SalaryBoard curl');
            curl_setopt($ch, CURLOPT_USERPWD, $token);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            $content = curl_exec($ch);
            curl_close($ch);

            return json_decode($content, true);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit();
        }
    }

}
