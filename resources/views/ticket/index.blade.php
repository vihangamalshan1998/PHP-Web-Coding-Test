<x-app-layout>
    <x-slot name="header">
        <section class="flex justify-between">
            <x-text.h2>Ticket list</x-text.h2>
            <a href="{{ route('ticket.create') }}">
                <x-primary-button type="button" class="ml-3">Add</x-danger-button>
            </a>
        </section>
    </x-slot>

    <x-forms.get :action="route('dashboard')" autocomplete="off">
        <div class="py-3">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            <div class="flex items-center gap-x-4">
                                <div class="flex md:items-center">
                                    <x-text-input id="customer_name" class="block mt-1" type="text"
                                        placeholder="Customer Name" name="customer_name" value="{{ $customer_name }}" />
                                </div>
                                <div class="flex md:items-center">
                                    <x-text-input id="Code" class="block mt-1" type="text"
                                        name="code" placeholder="Code" value="{{ $code }}"  />
                                </div>
                                <x-select-input id="level" class="block mt-1" name="status">
                                    <x-slot name="options">
                                        <option value="">Select status</option>
                                        @foreach (app\Models\Tickets::getEnum('status') as $status)
                                            <option @selected($status == $current_status) value="{{ $status }}">
                                                {{ $status }}</option>
                                        @endforeach
                                    </x-slot>
                                </x-select-input>
                                <div x-data="{ from: false, to: false }" class="flex md:items-center">
                                    <input x-on:change="to=true" onchange="fromFunction()" id="date_from"
                                        class="form-control bg-sky-100 text-black border-gray-300 focus:border-indigo-500  text-l focus:ring-indigo-500 rounded-md shadow-sm"
                                        type="date" name="from" id="" value="<?php echo $from; ?>">
                                    <p class="mt-1 ml-5 mr-5">To</p>
                                    <input x-on:change="from=true" id="date_to" onchange="toFunction()"
                                        class="form-control bg-sky-100 text-black border-gray-300 focus:border-indigo-500  text-l focus:ring-indigo-500 rounded-md shadow-sm"
                                        type="date" name="to" id="" value="<?php echo $to; ?>">
                                </div>
                                <x-button-warning>Search</x-button-warning>
                                <div x-data="{ reset: false }">
                                    <input type="hidden" name="reset" x-model="reset">
                                    <x-button-danger x-on:click="reset=true">Reset</x-button-danger>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-forms.get>

    <div class="py-3">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <table class="w-full ">
                            <thead class="bg-gray-200 border-b">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-bold text-left text-gray-900">
                                        Customer Name
                                    </th>
                                    <th scope="col" class="px-6 py-4 font-bold text-left text-gray-900">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-4 font-bold text-left text-gray-900">
                                        Code
                                    </th>
                                    <th scope="col" class="px-6 py-4 font-bold text-left text-gray-900">
                                        Problem
                                    </th>
                                    <th scope="col" class="px-6 py-4 font-bold text-left text-gray-900">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-4 font-bold text-right text-gray-900">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="px-6 py-4 text-sm font-light text-left text-gray-900">
                                            {{ $ticket->customer_name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-light text-left text-gray-900">
                                            <span
                                                @if ($ticket->status == 'Open') class="font-bold text-green-600"
                                            @elseif ($ticket->status == 'Closed') class="font-bold text-red-600"
                                            @elseif ($ticket->status == 'In Progress')class="font-bold text-purple-600"
                                            @elseif ($ticket->status == 'On Hold')class="font-bold text-[#b87240]"
                                            @elseif ($ticket->status == 'Cancelled') class="font-bold text-[#403e3d]" @endif>
                                                {{ $ticket->status }} </span> <br />
                                            ({{ $ticket->created_at->diffForHumans() }})
                                        </td>
                                        <td class="px-6 py-4 text-sm font-light text-left text-gray-900">
                                            {{ $ticket->code }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-light text-left text-gray-900">
                                            {{ $ticket->body }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-light text-left text-gray-900">
                                            {{ $ticket->created_at }}
                                        </td>

                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('ticket.show', $ticket->id) }}">
                                                <x-secondary-button class="ml-3">View</x-secondary-button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-6 py-3">
                    @if (!$tickets->hasPages())
                        {{ $tickets->count() }} results
                    @else
                        {{ $tickets->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        function fromFunction() {
            var x = document.getElementById("date_from").value;
            document.getElementById('date_to').setAttribute('min', x);
        }

        function toFunction() {
            var x = document.getElementById("date_to").value;
            document.getElementById('date_from').setAttribute('max', x);
        }
    </script>
</x-app-layout>
