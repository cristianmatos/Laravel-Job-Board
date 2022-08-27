@if ($message = Session::get('success'))
<div class="w-auto mx-auto px-4 py-4 absolute right-0 bottom-0">
    <div class="p-4 rounded bg-teal-200 text-teal-700"> 
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif
<!-- <div class="w-60 mx-auto px-4 py-4 absolute right-0 bottom-0">
    <div class="p-4 rounded bg-teal-200 text-teal-700"> 
        <strong>Test</strong>
    </div>
</div> -->