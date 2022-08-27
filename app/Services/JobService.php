<?php
namespace App\Services;

use App\Models\Job;
use App\Enums\JobStatus;

class JobService
{
    private int $perPage = 10;

    /**
     * Get the active jobs
     *
     * @return object
     */
    public function getJobs()
    {
        return Job::published()->paginate($this->perPage);
    }

    /**
     * Search jobs
     *
     * @param string $searchQuery
     * @return Collection
     */
    public function searchJobs(string $searchQuery)
    {
        return Job::whereRelation('jobType', 'name', 'like', '%'.$searchQuery.'%')
            ->orWhereRelation('tags', 'name', 'like', '%'.$searchQuery.'%')
            ->orWhere('job_title', 'like', '%'.$searchQuery.'%')
            ->orWhere('location', 'like', '%'.$searchQuery.'%')
            ->paginate($this->perPage);
    }

    /**
     * Get the job in draft status to continue editing
     *
     * @return Job
     */
    public function getJobOnDraft()
    {
        $job = Auth()->user()
            ->jobs()
            ->where('status', JobStatus::DRAFT->value)
            ->first();

        return $job ?? new Job();
    }

    /**
     * Get job by slug, the default status is publish
     *
     * @param string $slug
     * @param JobStatus $status
     * @return void
     */
    public function getJobBySlug($slug, JobStatus $status = JobStatus::PUBLISHED)
    {
        return Job::where('slug', $slug)
            ->where('status', $status->value)
            ->firstOrFail();
    }

    public function create($data) 
    {
        return Auth()->user()->jobs()->create($data);
    }

    /**
     * Update a job
     *
     * @param integer $id
     * @param array $data
     * @return Job
     */
    public function update(int $id, array $data)
    {
        $job = Job::findOrFail($id);
        $job->fill($data);
        $job->save();
        return $job;
    }

    /**
     * Change the status for a job
     *
     * @param int $id
     * @param JobStatus $status
     * @return Job
     */
    public function changeStatus($id, JobStatus $status)
    {
        $job = Job::findOrFail($id);
        $job->status = $status->value;
        $job->save();

        return $job;
    }
}