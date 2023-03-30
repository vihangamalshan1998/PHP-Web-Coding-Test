@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'type' => 'text',
    'class' =>
        'form-control text-black border-gray-300 focus:border-indigo-500 bg-sky-100  text-xl focus:ring-indigo-500 rounded-md shadow-sm',
]) !!} pattern="([^\s][A-z0-9À-ž,-;=!.<>:{}()|/@*%'$+?_&#\s]+)" />
{{-- pattern="[a-zA-Z0-9.,@'$?_&#\\s]+"  --}}
