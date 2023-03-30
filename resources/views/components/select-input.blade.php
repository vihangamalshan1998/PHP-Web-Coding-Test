@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'form-control text-black border-gray-300 focus:border-indigo-500  text-xl focus:ring-indigo-500 rounded-md shadow-sm bg-sky-100',
]) !!}>
    {{ $options }}
</select>
