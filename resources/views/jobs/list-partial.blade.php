<div>
@foreach ( $jobs as $job)
    <a title="View job details" href="{{ $job->permalink() }}" class="shadow-xs rounded-md border bg-white flex p-4 shadow-sm mb-2 justify-between hover:bg-slate-200 hover:border-slate-300">
        <div class="w-1/10 text-center flex justify-center items-center">
            <i class="fa-brands fa-github text-gray-500 text-5xl"></i></div>
        <div class="w-5/12 px-2">
            <h2 class="text-xl font-bold">{{ $job->job_title }}
            </h2>
            <span class="block text-gray-400">{{ $job->user->company->company_name }}</span>

            <div class="flex space-x-2 items-center">
                <span class="block text-gray-400"><i class="fa-solid fa-location-dot"></i> {{ $job->location }}</span>
                @if ( $job->compensation_min && $job->compensation_max)
                    <span class="bg-green-200 text-sm text-green-700 border-2 border-green-400 px-2 py-0 font-semibold">{{$job->getSalary()}}</span>
                @endif
            </div>
        </div>
        <div class="w-5/12 flex items-center">
            @foreach ( $job->tags as $tag)
                <span class="border-2 border-gray-400 px-2 mx-2 rounded-md">{{ $tag->name }}</span>
            @endforeach
        </div>
        <div class="w-1/12 text-center flex items-center justify-center">
            {{ $job->created_at->shortAbsoluteDiffForHumans() }}
        </div>
    </a>
@endforeach
</div>