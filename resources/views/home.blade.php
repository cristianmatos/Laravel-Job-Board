<x-app-layout>
    <div class="hero border-b text-white bg-gray-500 bg-cover bg-no-repeat bg-bottom bg-opacity-50">
        <div class="h-[400px] mx-auto text-center max-w-5xl flex items-center justify-center flex-col">
            <h2 class="text-white text-4xl font-bold">{{__('Hire an expert in Laravel, VueJS, PHP, and More.')}}</h2>
            <h4 class="text-2xl">{{__('Hire your best developer today!')}}</h4>
            <a href="{{ route('job.company-profile') }}" 
            class="bg-primary hover:bg-primary-darker border-0 text-xl shadow-lg text-white py-2 px-12 mt-6 rounded-md font-bold">{{__('Post a Job')}}</a>
        </div>
    </div>

    <div class="max-w-5xl mx-auto pb-28 pt-4" x-data="jobList({{$jobs->hasMorePages()}})">
        <div class="py-6">
            <form action="/search" method="GET" @submit.prevent="search">
                    <span class="font-bold">Filter jobs:</span>
                    <div class="flex justify-center items-center">  
                        <div class="relative w-full"> 
                            <x-input type="text" name="q"
                                x-model="searchQuery"
                                :value="request()->get('q') ?? ''"
                                class="h-10 w-full pr-8 pl-5 mt-0 rounded z-0 focus:shadow focus:outline-none" 
                                placeholder="Search by title, job type, or location..." />
                            <button type="submit"
                                :disabled="loading"
                                class="absolute d-block items-center top-0 my-0 right-0 w-auto pl-4 font-bold bg-primary hover:bg-primary-darker text-white h-10 disabled:opacity-30">
                                Search
                                <i class="fa fa-search z-20 ml-2  p-2"></i> 
                            </button>
                        </div>
                    </div>
            </form>

            <div class="pt-4 font-bold text-gray-400 text-xl text-center" x-show="searchText" x-text="searchText"></div>
        </div>

        <div id="joblist-container" :class="{'opacity-40': loading}">
            @include('jobs.list-partial', ['jobs' => $jobs])
        </div>

        <div class="text-center py-4" x-show="hasMore" x-transition>
            <button type="button"
            :disabled="loadingMore"
            class="border border-gray-400 rounded-md px-4 py-2 font-bold hover:bg-primary hover:text-white disabled:opacity-30" @click="loadMoreJobs">Load More...</button>
        </div>
    </div>
</x-app-layout>