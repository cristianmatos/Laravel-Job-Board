<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use App\Models\Job;
use App\Models\JobType;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createJobTypes();
        $this->createTags();
        $this->createCompany();

        Job::factory()
            ->count(20)
            ->create();

        foreach (Job::all() as $job) {
            $job->tags()->attach((
                Tag::all()->random(rand(1,3))->pluck('id')->toArray()
            ));
        }
    }

    public function createJobTypes()
    {
        $jobTypes = ['Full-Time', 'Part-Time', 'Freelance', 'Temporary', 'Intership'];
        foreach ( $jobTypes as $type) {
            JobType::create([
                'name' => $type
            ]);
        }
    }

    public function createTags()
    {
        $tags = ['Laravel', 'PHP', 'VueJS', 'NodeJS', 'Mean'];
        foreach ( $tags as $tag) {
            Tag::create([
                'name' => $tag
            ]);
        }
    }

    public function createCompany()
    {
        CompanyProfile::create([
            'company_name' => 'Sample Company',
            'logo_url' => '/img/companies/sample.png',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'user_id' => User::first()->id
        ]);
    }
}
