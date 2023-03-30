@props(['value'])

<label
    {{ $attributes->merge(['class' => ' text-blue w-3/12 block font-bold text-l text-right text-gray-700 dark:text-gray-200']) }}>
    {{ $value ?? $slot }}
</label>
