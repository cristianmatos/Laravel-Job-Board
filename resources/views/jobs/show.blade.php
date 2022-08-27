<x-app-layout>

    @if ($preview)
        @if ( $job->isDraft() )
            @include ('jobs.partial-publish-form', ['id' => $job->id])
        @else
            @php
                //TODO: Add options unpublish for owner
            @endphp
        @endif
    @endif

    <div>
        <div class="max-w-5xl mx-auto">
            <div class="flex py-8">
                <div class="w-2/10 text-center flex justify-center items-center px-2">
                    <i class="fa-brands fa-github text-gray-500 text-5xl"></i></div>

                <div class="w-6/12 px-2">
                    <h1 class="text-2xl font-bold">{{ $job->job_title }}</h1>
                    <span class=" text-gray-600">{{ $job->user->company->company_name }}</span> 
                    <!-- | <a href="#" class="text-primary">More jobs from this company <i class="fa-solid fa-arrow-up-right-from-square"></i></a> -->
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-6">
        <div class="flex max-w-5xl mx-auto space-x-8">
            <div><span class="font-bold block">{{ __('Location') }}</span> {{ $job->location }}</div>
            <div><span class="font-bold block">{{ __('Allow Remote') }}</span> {{ $job->allow_remote ? 'Yes' : 'No' }}</div>
            <div><span class="font-bold block">{{ __('Job Type') }}</span>  {{ $job->jobType->name }}</div>

            @if ( $job->compensation_min && $job->compensation_max)
            <div><span class="font-bold block">{{ __('Salary') }}</span>{{$job->getSalary()}}</div>
            @endif

            <div><span class="font-bold block">{{ __('Posted')}} </span> {{$job->created_at->diffForHumans() }}</div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto py-6 pb-28">
        <div class="flex space-x-6">
            <div class="basis-8/12">
                <div class="pb-6">
                    <h3 class="block font-bold text-2xl border-b py-2 mb-2">{{ __('Company Description') }}</h3>
                    {!! nl2br($job->user->company->description) !!}
                </div>

                <div class="pb-6">
                    <h3 class="block font-bold text-2xl border-b py-2 mb-2">{{ __('Job Description') }}</h3>
                    {!! nl2br($job->description) !!}
                </div>
                
                
                <div class="bg-primary-darker text-white p-6 rounded">
                    <h3 class="block font-bold text-2xl">{{ __('How to apply') }}</h3>
                    {!! nl2br($job->how_apply) !!}
                </div>
                
            </div>
            <div class="basis-4/12 text-center bg-white p-6">
                <h4 class="font-bold text-left text-l py-4">{{ __('Would you like to apply to this job?') }} </h4>
                <a href="{{ $job->application_link}}" 
                    target="_blank"
                    class="block btn-primary text-xl w-full font-bold px-6 py-2">{{ __('Apply now!') }}</a>
                
                <h3 class="block font-bold text-l border-b py-2 mb-2 mt-4 text-left">{{ __('Tags') }}</h3>
                <div class="flex">
                    @foreach ( $job->tags as $tag)
                        <span class="border-2 border-gray-400 px-2 mx-2 rounded-md">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>