@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'type' => 'text',
    'class' =>
        'form-control text-black border-black focus:border-indigo-500 bg-sky-100 text-xl focus:ring-indigo-500 rounded-md shadow-sm',
]) !!} />
