@extends('pages.master')

@section('main')
    <div class="grid divide-x lg:grid-cols-2">
        <section class="mt-3 ml-2 mr-2 overflow-hidden bg-white shadow dark:bg-gray-800 dark:text-white sm:rounded-lg">
            <div class="p-4">
                <div class="flex items-center mb-5 ">
                    <div class="ml-4 text-xl font-semibold leading-7"><a class="text-gray-900 dark:text-white">Create a new
                            ticket</a></div>
                </div>

                <x-forms.post :action="route('save_ticket')" class="was-validated" id="myForm" enctype="multipart/form-data">
                    <div>
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            <div class="mt-2 ">
                                <div class="flex md:items-center gap-x-4">
                                    <x-input-label-2 for="name" value="Your name*" />
                                    <x-text-input id="name" class="w-9/12 mt-1" type="text" name="name"
                                        required="required" />
                                </div>
                            </div>

                            <div class="mt-2 ">
                                <div class="flex md:items-center gap-x-4">
                                    <x-input-label-2 for="number" value="Your number*" />
                                    <x-text-input id="name" class="w-9/12 mt-1" type="number" name="number"
                                        required="required" />
                                </div>
                            </div>

                            <div class="mt-2 ">
                                <div class="flex md:items-center gap-x-4">
                                    <x-input-label-2 for="email" value="Your email*" />
                                    <x-text-input-email id="email" class="block w-9/12 mt-1" type="email"
                                        name="email" required="required" />
                                </div>
                            </div>
                            <div class="mt-2 mb-5">
                                <div class="flex items-center gap-x-4">
                                    <x-input-label-2 for="content" value="Content*" />
                                    <x-textarea-input id="content" class="block w-9/12 mt-1" type="text" name="problem"
                                        required placeholder="Write your problem here..."
                                        pattern="[a-zA-Z][a-zA-Z0-9\s]*" />
                                </div>
                            </div>

                            <div class="px-6 pt-3 mb-5 text-right text-gray-600 border-t border-gray-200">
                                <x-success-button class="ml-3">Save</x-success-button>
                            </div>
                        </div>
                    </div>
                </x-forms.post>
            </div>
        </section>
        <section class="mt-3 ml-2 mr-2 overflow-hidden bg-white shadow dark:bg-gray-800 dark:text-white sm:rounded-lg">
            <div class="p-4">
                <div class="flex items-center mb-5 ">
                    <div class="ml-4 text-xl font-semibold leading-7"><a class="text-gray-900 dark:text-white">Check
                            the progress of your ticket</a></div>
                </div>
                <x-forms.get :action="route('search_ticket')" class="was-validated" id="myForm" enctype="multipart/form-data">
                    <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        <div class="mt-2 ">
                            <div class="flex md:items-center gap-x-4">
                                <x-input-label-2 for="ticket_id" value="Ticket ID*" />
                                <x-text-input id="ticket_id" class="block w-9/12 mt-1" type="text" name="ticket_id"
                                    required="required" />
                            </div>
                        </div>
                        <div class="px-6 pt-3 mb-5 text-right">
                            <x-success-button class="ml-3">Search</x-success-button>
                        </div>
                    </div>
                </x-forms.get>

            </div>
        </section>
    </div>
    @if (session('status') == 'Ticket Creation Successful')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Ticket Creation Successful',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                toast: true,
            })
        </script>
    @endif
    @if (session('status') == 'Ticket Creation Unuccessful')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Ticket Creation Unuccessful',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                toast: true,
            })
        </script>
    @endif
    @if (session('status') == 'Please Recheck The Ticket Code')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Please Recheck The Ticket Code',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                toast: true,
            })
        </script>
    @endif
@endsection
