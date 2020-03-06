<?php

namespace Application\Job;

class GetRepositories {

    /**
     * Get only repositories urls
     */
    public function __invoke($items) {
        return array_map(function ($item) {
            return [
                'login' => $item['login'],
                'type' => 'repositories',
                'url' => $item['repositories']
            ];
        }, $items);
    }

}
