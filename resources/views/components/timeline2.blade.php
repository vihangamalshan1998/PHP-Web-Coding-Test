@props(['status' => $status])
@switch($status)
    @case('Open')
        <ol {{ $attributes->merge(['class' => 'm-5 border-l-2 border-green-200']) }}>
            {{ $slot }}
        </ol>
    @break

    @case('Closed')
        <ol {{ $attributes->merge(['class' => 'm-5 border-l-2 border-red-200']) }}>
            {{ $slot }}
        </ol>
    @break

    @case('In Progress')
        <ol {{ $attributes->merge(['class' => 'm-5 border-l-2 border-purple-200']) }}>
            {{ $slot }}
        </ol>
    @break

    @case('On Hold')
        <ol {{ $attributes->merge(['class' => 'm-5 border-l-2 border-[#db9563]']) }}>
            {{ $slot }}
        </ol>
    @break

    @case('Cancelled')
        <ol {{ $attributes->merge(['class' => 'm-5 border-l-2 border-[#a3a2a0]']) }}>
            {{ $slot }}
        </ol>
    @break
@endswitch



{{-- <script>
    function toggle_eye(status, id) {
        alert('from toggle_eye. status=' + status+' id='+id);
    }
</script> --}}
