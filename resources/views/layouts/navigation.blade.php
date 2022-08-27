<header class="mx-auto px-8 bg-none shadow-md" id="site-header">
    <div class="h-20 items-center flex justify-between">
        <a href="{{ url('/') }}" class="site-logo font-bold text-2xl flex items-center"> <span class="px-2"> Job Board</span></a>
    
        <nav class="text-right flex items-center">
            <a @class([
                'btn-primary mr-4',
                'bg-transparent border-white border-2 py-1 hover:bg-white hover:text-gray-600' => request()->is('/')
            ]) href="{{ route('job.company-profile') }}">{{ __('Post a Job')}}</a>
            
            @if (Auth::check())
                <x-dropdown>
                    <x-slot name="trigger">
                        <a href="#" @click.prevent="">{{ Auth::user()->name }}
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('account')}}" class="text-left"><i class="fa-solid fa-user"></i> {{__('Account')}} </x-dropdown-link>
                        <x-dropdown-link href="{{ route('manage_jobs')}}" class="text-left"><i class="fa-solid fa-list"></i> {{__('My Jobs')}} </x-dropdown-link>
                        <x-dropdown-link href="{{ route('job.company-profile', ['action'=>'edit']) }}" class="text-left"><i class="fa-solid fa-building"></i> {{__('Company Profile')}} </x-dropdown-link>
                        <hr />
                        <form action="{{ route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> {{__('Logout')}} </button>
                        </form>
                        
                    </x-slot>
                </x-dropdown>
            @else
                <a href="/login" class="px-4">Login</a>
                <a href="/register" class="px-4">Register</a>
            @endif

            <!-- <a href="#" class="text-2xl"><i class="fa-brands fa-github text-gray-500"></i></a> -->
        </nav>
        
    </div>
</header>