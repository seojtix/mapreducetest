<?php

namespace Application\Job;

class GetRequests {

    /**
     * Split each url in separate array's row to make correct parallelization
     */
    public function __invoke($items) {
        $job1 = new GetFollowers();
        $job2 = new GetRepositories();

        return array_merge($job1->__invoke($items), $job2->__invoke($items));
    }

}
