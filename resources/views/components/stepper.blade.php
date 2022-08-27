@props(['current' => 0])

@php
    $steps = [
        [
            'icon' => 'fa-solid fa-check',
            'text' => 'Company Details'
        ],
        [
            'icon' => 'fa-solid fa-edit',
            'text' => 'Job Details'
        ],
        [
            'icon' => 'fa-solid fa-eye',
            'text' => 'Preview' 
        ]
    ];
@endphp

<div class="p-5">
    <div class="mx-4 p-4">
        <div class="flex items-center">
            @foreach ($steps as $step)
                @php
                    $active = $loop->index <= $current;
                @endphp

            <div class="flex items-center relative">
                <div @class([
                        'text-center font-bold rounded-full h-12 w-12 py-3 border-2',
                        'border-gray-400 text-gray-400' => !$active,
                        'border-primary bg-primary text-white' => $active
                    ])>
                    <i class="{{$step['icon']}}"></i>
                </div>
                <div @class([
                        'absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase',
                        'border-gray-300' => !$active,
                        'border-primary text-primary' => $active
                    ])>{{ $step['text'] }}</div>
            </div>

                @if ( !$loop->last )
                    <div @class([
                            'flex-auto border-t-2',
                            'border-primary' => ($loop->index+1) <= $current,
                            'border-gray-300' => ($loop->index+1) > $current
                        ])></div>
                @endif
            @endforeach
        </div>
    </div>
</div>