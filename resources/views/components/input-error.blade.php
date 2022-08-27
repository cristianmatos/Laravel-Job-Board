@props(['name' => ''])
@error($name)
    <div class="text-red-900">{{ $message }}</div>
@enderror