<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\JobService;

class  HomeController extends Controller
{
    public function __construct(
        private JobService $jobService){

    }

    public function index()
    {
        return view('home', [
            'jobs' => $this->jobService->getJobs(),
            'isSearch' => false
        ]);
    }    
}
