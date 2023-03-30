<x-ticketView-layout>
    @if (count($notes) == 0)
        <div class="h-screen">
    @endif
    <section class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div x-data="{ is_view_mode: true }" class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex justify-between px-6 py-3 text-gray-600 border-b border-gray-200">
                    <h5 class="mb-2 text-xl font-medium text-gray-900">
                        <x-badge-info>{{ $ticket->code }}</x-badge-info>
                    </h5>
                    <aside>
                        <a href="{{ url('/') }}"><i class="fa-solid fa-x"></i></a>
                    </aside>
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
                    <div class="mt-4 ">
                        <div class="flex items-center gap-x-4">
                            <x-input-label for="status" value="Current Status" />
                            <x-text-input id="status" class="block w-full mt-1" type="text" name="status"
                                required="required" value="{{ $ticket->status }}" x-bind:disabled="is_view_mode" />
                        </div>
                    </div>
                    <div class="mt-4 ">
                        <div class="flex items-center gap-x-4">
                            <x-input-label for="content" value="Content*" />
                            <textarea id="content" rows="4" name="problem"
                                class="block w-full bg-sky-100 mt-1 form-control text-black border-gray-300 focus:border-indigo-500  text-xl focus:ring-indigo-500 rounded-md shadow-sm"
                                required x-bind:disabled="is_view_mode">{{ $ticket->body }}</textarea>
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
                    @foreach ($notes as $one)
                        <x-timeline2 class="ml-10" :status="$one->current_status">
                            @php
                                $author = 'Added By User';
                                if (isset($one->user->name)) {
                                    $author = $one->user->name;
                                }
                            @endphp
                            <div x-data="{ note_id: {{ $one->id }}, is_show: {{ $one->is_show_to_customer }} }">
                                <x-timeline3-item :id="$one->id" :status="$one->current_status" :date="$one->created_at->diffForHumans()"
                                    :title="$author">
                                    {{ $one->body }}
                                </x-timeline3-item>
                            </div>
                        </x-timeline2>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (count($notes) == 0)
        </div>
    @endif
</x-ticketView-layout>
