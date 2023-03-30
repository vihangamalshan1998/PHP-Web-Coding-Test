<x-app-layout>
    <x-slot name="header">
        <x-text.h2>Tickets</x-text.h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <x-forms.post :action="route('ticket.store')" class="was-validated" id="myForm" enctype="multipart/form-data">
                    <div class="flex justify-between px-6 py-3 text-gray-600 border-b border-gray-200">
                        <h5 class="mb-2 text-xl font-medium text-gray-900">Ticket Create</h5>
                        <aside> <a href="{{ route('ticket.index') }}"><i class="fa-solid fa-x"></i></a> </aside>
                    </div>
                    <div class="p-6 text-gray-900">
                        <div class="mt-4 ">
                            <div class="flex md:items-center gap-x-4">
                                <x-input-label for="name" value="Your name*" />
                                <x-text-input id="name" class="w-9/12 mt-1" type="text" name="name"
                                    required="required" />
                            </div>
                        </div>
                        <div class="mt-4 ">
                            <div class="flex md:items-center gap-x-4">
                                <x-input-label for="number" value="Your number*" />
                                <x-text-input id="name" class="w-9/12 mt-1" type="number" name="number"
                                    required="required" />
                            </div>
                        </div>
                        <div class="mt-2 ">
                            <div class="flex md:items-center gap-x-4">
                                <x-input-label for="email" value="Your email*" />
                                <x-text-input-email id="email" class="block w-9/12 mt-1" type="email"
                                    name="email" required="required" />
                            </div>
                        </div>
                        <div class="mt-4 ">
                            <div class="flex items-center gap-x-4">
                                <x-input-label for="content" value="Content*" />
                                <x-textarea-input id="content" class="block w-9/12 mt-1" type="text" name="problem"
                                    required placeholder="Write your problem here..."
                                    pattern="[a-zA-Z][a-zA-Z0-9\s]*" />
                            </div>
                        </div>
                    </div>
                    <div class="px-6 pt-3 text-right text-gray-600 border-t border-gray-200">
                        <x-success-button class="ml-3">Save</x-success-button>
                    </div>
                </x-forms.post>
            </div>

        </div>
    </div>
</x-app-layout>
