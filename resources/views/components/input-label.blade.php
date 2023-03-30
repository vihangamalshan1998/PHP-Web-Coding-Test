@props(['value'])

<label
    {{ $attributes->merge(['class' => ' text-blue w-3/12 block font-medium text-right text-gray-700 ']) }}>
    {{ $value ?? $slot }}
</label>
