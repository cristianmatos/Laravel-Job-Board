<?php
namespace App\Http\Controllers\Admin;

use App\Enums\JobLevels;
use App\Enums\JobStatus;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobType;
use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Enum;

class JobAdminController extends Controller
{
    public function __construct(
        private JobService $jobService){

    }

    /**
     * Show page to manage jobs
     *
     * @return void
     */ 
    public function index(Request $request)
    {
        return view('jobs.admin.index', [
            'jobs' => $request->user()->jobs
        ]);
    }

    /**
     * Show the form to create a job
     *
     * @return view
     */
    public function create()
    {
        return view('jobs.create', [
            'job' => $this->jobService->getJobOnDraft() ?? new Job(),
            'jobTypes' => JobType::all(),
            'levels' => JobLevels::cases()
        ]);
    }

    /**
     * Save the job details
     *
     * @param Request $request
     * @return RedirectResponse|null
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|max:255',
            'description' => 'required|max:1000',
            'how_apply' => 'max:500',
            'job_type_id' => 'required|numeric|exists:job_types,id',
            'application_link' => 'required|max:255',
            'compensation_min' => 'sometimes|nullable|numeric|min:1',
            'compensation_max' => 'sometimes|nullable|numeric|min:1',
            'allow_remote' => 'sometimes|nullable|boolean',
            'location' => 'max:255',
            'level' => [new Enum(JobLevels::class)]
        ]);

        $data = $request->only([
            'job_title', 
            'description', 
            'how_apply',
            'job_type_id',
            'level',
            'application_link', 
            'compensation_min', 
            'compensation_max', 
            'allow_remote',
            'location'
        ]);

        if ($request->id) {
            $job = Job::findOrFail($request->id);
            if ( $request->user()->can('update', $job)){
                $this->jobService->update($request->id, $data);
            } else {
                abort(403);
            }
        } else {
            $job = $this->jobService->create($data);
        }

        if ( !$job ) {
            Log::error("Unexpected error updating job: " . print_r($job, true));
            abort(500, 'Unexpected error.');
        }
        
        return redirect( $job->previewLink() );
    }

    /**
     * Allow previwing the job before publishing
     *
     * @param string $slug
     * @return View
     */
    public function preview(Request $request, Job $job)
    {
        if ($request->user()->cannot('viewDraft', $job))
            abort(403);

        return view('jobs.show', [
            'job' => $job,
            'preview' => true
        ]);
    }

    /**
     * Publish the job
     *
     * @param Request $request
     * @return Redirect
     */
    public function publish(Request $request, Job $job)
    {
        if ($request->user()->cannot('publish', $job))
            abort(403);

        $job = $this->jobService->changeStatus($job->id, JobStatus::PUBLISHED);
        
        return redirect($job->permalink())
                    ->with('success', __('The job has been published') );
    }
}
