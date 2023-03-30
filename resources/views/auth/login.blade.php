<x-guest-layout>

    <form method="POST" action="{{ route('login') }}" class="bg-gray">
        @csrf
        <!-- Email Address -->
        <div class="flex items-center mt-4 gap-x-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input-email id="email" class="bg-sky-100 block w-9/12 mt-1" type="email" name="email"
                :value="old('email')" required autofocus />
        </div>

        <!-- Password -->
        <div class="flex items-center mt-4 gap-x-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="bg-sky-100 block w-9/12 mt-1" type="password" name="password" required
                autocomplete="current-password" />
            {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    @if (session('status') == 'Log In Unuccessful')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Log In Unuccessful',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                toast: true,
            })
        </script>
    @endif
</x-guest-layout>
