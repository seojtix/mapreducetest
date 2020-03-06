<?php

namespace Application\Job;

class GetFollowers {

    /**
     * Get only followers urls
     */
    public function __invoke($items) {
        return array_map(function ($item) {
            return [
                'login' => $item['login'],
                'type' => 'followers',
                'url' => $item['followers']
            ];
        }, $items);
    }

}
