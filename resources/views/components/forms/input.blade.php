@props([
    'name',
    'type' => 'text',
    'placeholder' => ''
])

<div class="mb-4 w-full">
    <input
        class="@error($name) border-red-500 @enderror active:shadow-lg focus:shadow-lg w-full bg-gray-200 appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="{{ $name }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        name="{{ $name }}"
    >
    @error($name)
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>
