<div class="bg-white">
    <div class="max-w-5xl mx-auto mt-4 mb-6">
        <x-stepper current="2"></x-stepper>

        <form method="POST" action="{{ route('job.publish', ['job' => $id]) }}">
            @csrf

            <div class="py-8 flex justify-between">
                <a href="{{ route('job.description') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> {{ __('Modify Job') }}</a>
                <button type="submit" class="btn btn-primary bg-teal-500 border-teal-500">{{ __('Publish Job') }} <i class="fa-solid fa-check"></i></button>
            </div>
        </form>
    </div>
</div>