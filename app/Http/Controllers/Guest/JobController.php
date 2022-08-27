<?php
namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\Request;
use Str;

class JobController extends Controller
{
    public function __construct(
        private JobService $jobService){

    }
    
    /**
     * Show the job details
     *
     * @param string $slug
     * @return View
     */
    public function show(Request $request, Job $job)
    {
        if ($job->isDraft()) 
            abort(404);

        $isOwner = $request->user() && $request->user()->hasJobOwnership($job);

        return view('jobs.show', [
            'job' => $job,
            'preview' => false,
            'isOwner' => $isOwner
        ]);
    }

    /**
     * Search jobs
     *
     * @param Request $request
     * @return array
     */
    public function search(Request $request) : array
    {
        if ( $searchQuery = $request->get('q')) {
            $results = $this->jobService->searchJobs($searchQuery);
        } else {
            $results = $this->jobService->getJobs();
        }
    
        $content = view('jobs.list-partial', [
            'jobs' => $results,
        ]);

        $count = $results->total();

        if ( $count > 0) {
            $context = Str::plural('job', $count);
            $searchText = "We found $count $context matching \"$searchQuery\"";
        } else {
            $searchText = "No jobs were found matching \"$searchQuery\"";
        }

        return [
            'content' => $content->render(),
            'next_page' => $results->currentPage() + 1,
            'has_more_pages' => $results->hasMorePages(),
            'search_text' => $searchText
        ];
    }

    /**
     * Load more jobs via ajax
     *
     * @return array
     */
    public function more() : array
    {
        $jobs = $this->jobService->getJobs();

        $content = view('jobs.list-partial', [
            'jobs' => $jobs,
        ]);

        return [
            'content' => $content->render(),
            'next_page' => $jobs->currentPage() + 1,
            'has_more_pages' => $jobs->hasMorePages()
        ];
    }
}