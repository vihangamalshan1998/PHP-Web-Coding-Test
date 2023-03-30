<script src="https://unpkg.com/flowbite@1.6.0/dist/datepicker.js"></script>
<x-app-layout>
    <x-slot name="header">
        <section class="flex justify-between">
            <x-text.h2>Tickets</x-text.h2>
            <a href="{{ route('ticket.create') }}">
                <x-primary-button type="button" class="ml-3">Add</x-danger-button>
            </a>
        </section>
    </x-slot>

    <section class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div x-data="{ is_view_mode: true }" class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex justify-between px-6 py-3 text-gray-600 border-b border-gray-200">
                        <h5 class="mb-2 text-xl font-medium text-gray-900">
                            Ticket <span x-show="is_view_mode">view</span>
                            <span x-show="!is_view_mode">update</span>
                        </h5>
                        <div>
                            <x-badge-info>{{ $ticket->code }}</x-badge-info>
                            @if ($ticket->current_department_id == '3')
                                <x-badge-warning>{{ $ticket->level->title }}</x-badge-warning>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-x"></i></a>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">
                        @if ($ticket->customer_name)
                            <div class="mt-4 ">
                                <div class="flex md:items-center gap-x-4">
                                    <x-input-label for="name" value="Customer Name" />
                                    <x-text-input id="name" class="block w-full mt-1" type="text" name="name"
                                        value="{{ $ticket->customer_name }}" disabled />
                                </div>
                            </div>
                        @endif
                        @if ($ticket->mobile)
                            <div class="mt-4 ">
                                <div class="flex md:items-center gap-x-4">
                                    <x-input-label for="mobile" value="Customer mobile" />
                                    <x-text-input id="mobile" class="block w-full mt-1" type="number" name="mobile"
                                        value="{{ $ticket->mobile }}" disabled />
                                </div>
                            </div>
                        @endif
                        @if ($ticket->email)
                            <div class="mt-4 ">
                                <div class="flex md:items-center gap-x-4">
                                    <x-input-label for="email" value="Customer Email" />
                                    <x-text-input id="email" class="block w-full mt-1" type="text" name="email"
                                        value="{{ $ticket->email }}" disabled />
                                </div>
                            </div>
                        @endif

                        <div x-show="is_view_mode" class="mt-4 ">
                            <div class="flex items-center gap-x-4">
                                <x-input-label for="status" value="Current Status" />
                                <x-select-input id="status" class="block w-full mt-1" type="text" name="status"
                                    x-bind:disabled="is_view_mode">
                                    <x-slot name="options">
                                        @foreach (app\Models\Tickets::getEnum('status') as $status)
                                            <option @selected($ticket->status == $status) value="{{ $status }}">
                                                {{ $status }}</option>
                                        @endforeach
                                    </x-slot>
                                </x-select-input>
                            </div>
                        </div>
                        <div class="mt-4 ">
                            <div class="flex items-center gap-x-4">
                                <x-input-label for="content" value="Content*" />
                                <textarea id="content" rows="4" name="problem" class="block w-full bg-sky-100 rounded-lg form-control" required
                                    x-bind:disabled="is_view_mode">{{ $ticket->body }}</textarea>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    @if (count($notes) > 0)
        <section class="py-3">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex justify-between px-6 py-3 text-gray-600 border-b border-gray-200">
                        <h5 class="mb-2 text-xl font-medium text-gray-900"> Notes </h5>
                    </div>

                    @foreach ($notes as $key => $one)
                        <x-timeline2 class="ml-10" :status="$one->current_status">
                            @php
                                $author = 'Added By User';
                                if (isset($one->user->name)) {
                                    $author = $one->user->name;
                                }
                            @endphp
                            <div x-data="{ note_id: {{ $one->id }}, is_show: {{ $one->is_show_to_customer }} }">
                                <x-timeline2-item :id="$one->id" :status="$one->current_status" :date="$one->created_at->diffForHumans()"
                                    :title="$author">
                                    {{ $one->body }}
                                </x-timeline2-item>
                            </div>
                        </x-timeline2>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($ticket->status != 'Closed' && $ticket->status != 'Cancelled')
        <section class="py-3">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex justify-between px-6 py-3 text-gray-600 border-b border-gray-200">
                        <h5 class="mb-2 text-xl font-medium text-gray-900">Your Reply</h5>
                    </div>
                    <x-forms.post :action="route('note.store')" class="was-validated" id="myForm" enctype="multipart/form-data">
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />
                        <div class="p-6 text-gray-900">
                            <div class="mt-4 ">
                                <div class="flex gap-x-4">
                                    <x-input-label for="note" value="Note*" />
                                    <x-textarea-input id="note" class="block w-full mt-1" name="note" required
                                        placeholder="Your note for the ticket in English">
                                    </x-textarea-input>
                                </div>
                            </div>
                            <input type="hidden" name="ticketid" value="{{ $ticket->id }}">
                            <div class="mt-4 ">
                                <div class="flex items-center gap-x-4">
                                    <x-input-label for="status" value="Status*" />
                                    <x-select-input id="status" class="block w-full mt-1" type="text"
                                        name="status" x-bind:disabled="is_view_mode">
                                        <x-slot name="options">
                                            @foreach ($statuses as $status)
                                                <option @selected($ticket->status == $status) value="{{ $status }}">
                                                    {{ $status }}</option>
                                            @endforeach
                                        </x-slot>
                                    </x-select-input>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 pt-3 text-right text-gray-600 border-t border-gray-200 ">
                            <x-success-button>Save note</x-success-button>
                        </div>
                    </x-forms.post>
                </div>
            </div>
        </section>
    @endif

</x-app-layout>
