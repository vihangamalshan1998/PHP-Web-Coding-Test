@if(isset($errors) && $errors->any())
    <x-utils.alert type="danger" class="header-message bg-red-100 text-red-700">
        @foreach($errors->all() as $error)
            {{ $error }}<br/>
        @endforeach
    </x-utils.alert>
@endif

@if(session()->get('flash_success'))
    <x-utils.alert type="success" class="header-message bg-green-100 text-green-700">
        {{ session()->get('flash_success') }}
    </x-utils.alert>
@endif

@if(session()->get('flash_warning'))
    <x-utils.alert type="warning" class="header-message bg-yellow-100 text-yellow-700">
        {{ session()->get('flash_warning') }}
    </x-utils.alert>
@endif

@if(session()->get('flash_info') || session()->get('flash_message'))
    <x-utils.alert type="info" class="header-message bg-blue-100 text-blue-700">
        {{ session()->get('flash_info') }}
    </x-utils.alert>
@endif

@if(session()->get('flash_danger'))
    <x-utils.alert type="danger" class="header-message bg-red-100 text-red-700">
        {{ session()->get('flash_danger') }}
    </x-utils.alert>
@endif

@if(session()->get('status'))
    <x-utils.alert type="success" class="header-message bg-blue-100 text-blue-700">
        {{ session()->get('status') }}
    </x-utils.alert>
@endif

@if(session()->get('resent'))
    <x-utils.alert type="success" class="header-message">
        @lang('A fresh verification link has been sent to your email address.')
    </x-utils.alert>
@endif

@if(session()->get('verified'))
    <x-utils.alert type="success" class="header-message">
        @lang('Thank you for verifying your e-mail address.')
    </x-utils.alert>
@endif
