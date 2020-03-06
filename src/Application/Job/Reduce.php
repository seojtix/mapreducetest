<?php

namespace Application\Job;

class Reduce {

    public function __invoke($items) {
        $result = [];
        foreach ($items as $item) {
            $result[$item['login']][$item['type']] = $item['data'];
        }

        return $result;
    }

}
