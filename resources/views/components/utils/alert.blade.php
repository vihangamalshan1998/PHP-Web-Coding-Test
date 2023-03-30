@props(['dismissable' => true, 'type' => 'success', 'ariaLabel' => __('Close')])

<div {{ $attributes->merge(['class' => 'alert rounded-lg py-5 px-6 mb-3 text-base inline-flex items-center w-full alert-dismissible fade show alert-'.$type]) }} role="alert">
    {{ $slot }}
    <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close"></button>

</div>