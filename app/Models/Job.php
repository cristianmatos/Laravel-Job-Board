<?php

namespace App\Models;

use App\Enums\JobStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use phpDocumentor\Reflection\Types\Boolean;

class Job extends Model
{
    use HasFactory;
    use sluggable;

    protected $fillable = [
        'job_title',
        'job_type_id',
        'level', 
        'description',
        'how_apply',
        'application_link',
        'compensation_min',
        'compensation_max',
        'allow_remote',
        'location',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'job_title'
            ]
        ];
    }

    /**
     * Scope a query to only include published projects.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopePublished($query)
    {
        $query->where('status', JobStatus::PUBLISHED->value);
    }

    /**
     * Format the Salary 
     *
     * @return void
     */
    public function getSalary()
    {
        if ( $this->compensation_min && $this->compensation_max) {
            if ( $this->compensation_min >= 1000 && $this->compensation_max >= 1000) {
                $min = $this->compensation_min / 1000;
                $max = $this->compensation_max / 1000;
                return "\${$min}k-{$max}k";
            } else {
                return "\${$this->compensation_min}k-{$this->compensation_max}k";
            }
        }

        return '';
    }

    public function permalink() : string
    {
        return route('job.view', ['job' => $this->slug]);
    }

    public function previewLink() : string
    {
        return route('job.preview', ['job' => $this->slug]);
    }

    public function isPublished() : bool
    {
        return $this->status === JobStatus::PUBLISHED->value;
    }

    public function isDraft() : bool
    {
        return $this->status === JobStatus::DRAFT->value;
    }
}
