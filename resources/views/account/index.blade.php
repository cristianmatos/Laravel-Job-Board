<x-app-layout>
    <div class="max-w-5xl mx-auto pb-28 pt-6 px-4"> 
        <h1 class="text-2xl font-bold mt-4 mb-8">{{ __('Edit account information') }}</h1>

        <div class="bg-white p-6 mt-4 rounded shadow-md">
            <form action="{{ route('account.update') }}" method="POST">
                @csrf

                <x-form-errors />

                <div>
                    <x-label for="name" :value="__('Name ')" required />
                    <x-input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" autofocus></x-input>
                </div>

                <div class="mt-6">
                    <x-label for="email" :value="__('Email ')" required />
                    <x-input type="text" id="email" name="email" value="{{ old('name', $user->email) }}" autofocus></x-input>
                </div>

                <div class="mt-6">
                    <x-label for="password" :value="__('Password ')" required />
                    <x-input type="password" id="password" name="password" value="" autofocus autocomplete="off"></x-input>
                    <x-hint>Leave blank to keep the same</x-hint>
                </div>

                <div class="mt-6">
                    <x-label for="password_confirmation" :value="__('Confirm Confirmation ')" required />
                    <x-input type="password" id="password_confirmation" name="password_confirmation" value="" autofocus autocomplete="off"></x-input>
                </div>

                <div class="py-8">
                    <button type="submit" class="btn btn-primary">{{ __('Update Account') }} <i class="fa-solid fa-arrow-store"></i></button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>