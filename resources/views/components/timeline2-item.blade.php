@props(['id' => $id, 'status' => $status, 'date' => $date, 'title' => $title])
<li>
    <div class="md:flex flex-start">
        @switch($status)
            @case('Open')
                <div class="flex items-center justify-center w-10 h-10 -ml-5 bg-green-200 rounded-full">
                    <i id="{!! $id !!}" x-show="is_show" class="text-white hover:text-black fa-regular fa-eye"></i>
                </div>
                <div class="block w-full p-6 mb-10 ml-10 bg-green-200 rounded-lg shadow-lg">
                @break

                @case('Closed')
                    <div class="flex items-center justify-center w-10 h-10 -ml-5 bg-red-200 rounded-full">
                        <i id="{!! $id !!}" x-show="is_show" class="text-white hover:text-black fa-regular fa-eye"></i>
                    </div>
                    <div class="block w-full p-6 mb-10 ml-10 bg-red-200 rounded-lg shadow-lg">
                    @break

                    @case('In Progress')
                        <div class="flex items-center justify-center w-10 h-10 -ml-5 bg-purple-200 rounded-full">
                            <i id="{!! $id !!}" x-show="is_show"
                                class="text-white hover:text-black fa-regular fa-eye"></i>
                        </div>
                        <div class="block w-full p-6 mb-10 ml-10 bg-purple-200 rounded-lg shadow-lg">
                        @break

                        @case('On Hold')
                            <div class="flex items-center justify-center w-10 h-10 -ml-5 bg-[#db9563] rounded-full">
                                <i id="{!! $id !!}" x-show="is_show"
                                    class="text-white hover:text-black fa-regular fa-eye"></i>
                            </div>
                            <div class="block w-full p-6 mb-10 ml-10 rounded-lg shadow-lg bg-[#db9563]">
                            @break

                            @case('Cancelled')
                                <div class="flex items-center justify-center w-10 h-10 -ml-5 bg-[#a3a2a0] rounded-full">
                                    <i id="{!! $id !!}" x-show="is_show"
                                        class="text-white hover:text-black fa-regular fa-eye"></i>
                                </div>
                                <div class="block w-full p-6 mb-10 ml-10 bg-[#a3a2a0] rounded-lg shadow-lg">
                                @break
                            @endswitch
                            <div class="flex justify-between mb-4">
                                <h2 class="text-xl font-semibold text-black transition duration-300 ease-in-out"
                                    style="max-width:70%">
                                    {{ $title }}</h2>
                                <h6 class="font-semibold text-black transition duration-300 ease-in-out text-m">
                                    {{ $status }}</h6>
                                <a href="#"
                                    class="text-sm font-medium text-black transition duration-300 ease-in-out">{{ $date }}</a>
                            </div>
                            <p class="mb-6 text-gray-700">
                                @if (strlen(strip_tags($slot)) > 250)
                                    {{ \Illuminate\Support\Str::limit(strip_tags($slot), 250) }}
                                    <span id="dots_{{ $id }}"></span><span id="more_{{ $id }}"
                                        style="display:none">{{ substr($slot, 250) }}
                                    </span>
                                    <br>
                                    <button onclick="myFunction({{ $id }})" id="myBtn_{{ $id }}"
                                        class="float-right mt-2">Read
                                        more</button>
                            </p>
                        @else
                            {{ $slot }}
                            @endif
                            <br>
                        </div>
</li>
