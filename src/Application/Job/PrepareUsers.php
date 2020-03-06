<?php

namespace Application\Job;

class PrepareUsers {

    /**
     * Get only followers & repositories urls for each login
     */
    public function __invoke($items) {
        return array_map(function ($item) {
            return [
                'login' => $item['login'],
                'followers' => $item['followers_url'],
                'repositories' => $item['repos_url'],
            ];
        }, $items);
    }

}
