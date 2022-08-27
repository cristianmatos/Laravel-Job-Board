<x-app-layout>
    <div class="max-w-5xl mx-auto pb-28 pt-4 px-4">
        <h1 class="text-2xl font-bold my-6">{{ __('Manage your jobs') }}</h1>

        <table class="min-w-full shadow-lg rounded mt-8">
            <thead class="bg-gray-100">
                <th class="p-4 text-left font-bold">Job Title</th>
                <th class="p-4 text-left font-bold">Published</th>
                <th class="p-4 text-center font-bold">Actions</th>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ( $jobs as $job)
                <tr>
                    <td class="p-4"><a class="hover:underline" href="{{$job->permalink()}}">{{ $job->job_title}}</a></td>
                    <td class="p-4">{{ $job->created_at->shortAbsoluteDiffForHumans() }} {{ __('ago')}}</td>
                    <td class="text-center">
                        <button><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</x-app-layout>