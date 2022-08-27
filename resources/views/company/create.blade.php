<x-app-layout>
    <div class="max-w-5xl mx-auto pb-28 pt-4 px-4" x-data="{}">
        <h1 class="text-2xl font-bold">{{ __('Company Profile') }}</h1>
        <p>{{ __('Use the form below to describe your company') }}</p>

        @if ( $action !== 'edit')
            <x-stepper current="0"></x-stepper>
        @endif

        <div class="bg-white rounded p-6 shadow mt-4">
            <x-form-errors />

            <form method="POST" action="{{ route('job.submit-company-profile') }}" enctype="multipart/form-data">
                @csrf
 
                <input type="hidden" name="_action" value="{{ $action }}">

                <div>
                    <x-label for="company_name" :value="__('Company Name ')" />
                    <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name', $company->company_name ?? '')" autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="company_logo" :value="__('Company Logo ')" />
                    @if ( $company && $company->logo_url)
                        <img class="w-16" src="{{ asset('storage/' . $company->logo_url) }}" />
                    @endif

                    <input id="company_logo" class="block mt-1 w-full" type="file" name="company_logo" autofocus />
                    <x-input-error name="company_logo"></x-input-error>
                </div>

                <div class="mt-4">
                    <x-label for="email" :value="__('Company Description')" />
                    <x-textarea name="description" class="h-52">{{ old('description', $company->description ?? '') }}</x-textarea>
                </div>

                <div class="mt-4 text-right">
                    <button type="submit" class="btn btn-primary">{{ $action === 'edit' ? 'Save' : 'Next' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>