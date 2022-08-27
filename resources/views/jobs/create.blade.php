<x-app-layout>
    <div class="max-w-5xl mx-auto pb-28 pt-4 px-4" x-data="{}">
        <h1 class="text-2xl font-bold">{{ __('Job Description') }}</h1>
        <p>{{ __('Use the form below to create a new job') }}</p>

        <x-stepper current="1"></x-stepper>
        <form method="POST" action="{{ route('job.submit-description') }}" enctype="multipart/form-data">
            @csrf

            @if ( $job )
                <input type="hidden" name="id" value="{{ $job->id}}">
            @endif

            <div class="bg-white rounded p-8 pb-10 shadow mt-6">
                <x-form-errors />
    
                <div>
                    <x-label for="job_title" :value="__('Job Title ')" required/>
                    <x-input id="job_title" class="block mt-1 w-full" type="text" name="job_title" :value="old('job_title', $job->job_title)" autofocus />
                </div>

                <div class="flex justify-between mt-6 space-x-6">
                    <div class="flex-auto">
                        <x-label for="job_type_id" :value="__('Job Type ')"/>
                        <select name="job_type_id" id="job_type_id" class="w-full border rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach ( $jobTypes as $type)
                                <option value="{{ $type->id}}" {{old('job_type_id', $job->job_type_id) === $type->id ? 'selected' : ''}}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error name="job_type_id"></x-input-error>
                    </div>

                    <div class="flex-auto">
                        <x-label for="level" :value="__('Level ')" required/>
                        <select name="level" id="level" class="w-full border rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach ( $levels as $level)
                                <option value="{{$level->value}}" {{old('level', $job->level) === $level->value ? 'selected' : ''}}>{{$level->value}}</option>
                            @endforeach
                        </select>
                        <x-input-error name="level"></x-input-error>
                    </div>
                </div>
                
                <div class="mt-6">
                    <x-label for="description" :value="__('Job Description ')" required />
                    <x-textarea id="description" class="h-48" type="text" name="description" autofocus>{{ old('description', $job->description) }}</x-textarea>
                </div>

                <div class="mt-6">
                    <x-label for="how_apply" :value="__('How to apply ')" />
                    <x-textarea id="how_apply" class="h-48" type="text" name="how_apply" autofocus>{{ old('how_apply', $job->how_apply) }}</x-textarea>
                </div>

                <div class="mt-6">
                    <x-label for="application_link" :value="__('Application Link ')" required />
                    <x-input type="text" name="application_link" :value="old('application_link', $job->application_link)" placeholder="Enter URL or email address" />
                </div>

                <div class="mt-6 flex space-x-6 justify-around">
                    <div class="flex-auto">
                        <x-label for="compensation_min" :value="__('Compensation Min ')" />
                        <x-input type="number" name="compensation_min" :value="old('compensation_min', $job->compensation_min)" min="1"/>
                    </div>
                    <div class="flex-auto">
                        <x-label for="compensation_max" :value="__('Compensation Max ')" />
                        <x-input type="number" name="compensation_max" :value="old('compensation_max', $job->compensation_max)" min="1"/>
                    </div>
                </div>

                <div class="flex space-x-6">
                    <div class="mt-6 flex-auto">
                        <x-label for="location" :value="__('Location ')" />
                        <x-input type="text" name="location" :value="old('location', $job->location)"/>
                    </div>

                    <div class="mt-6 flex flex-auto items-center">
                        <input type="checkbox" name="allow_remote" id="allow_remote" value="1" {{old('allow_remote', $job->allow_remote) ? 'checked' : ''}}/>
                        <x-label for="allow_remote" :value="__('Allow Remote ')" class="ml-2" />
                    </div>
                </div>
            </div>

            <div class="py-8 flex justify-between">
                <a href="{{ route('job.company-profile') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> {{ __('Modify Company Proifle') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('Save and Preview Job') }} <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </form>

    </div>
</x-app-layout>