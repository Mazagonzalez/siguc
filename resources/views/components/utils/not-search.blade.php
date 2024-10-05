@if (isset($colspan))
    <td colspan="{{ $colspan }}">
        <div class="items-center text-center col gap-2.5 m-auto {{ isset($py) ? 'py-' . $py : '' }}">
            <p class="font-light">{{ $message }}</p>
            <x-icons.file-search class="stroke-gray-500 size-8" />
        </div>
    </td>
@else
    <div class="w-full h-full col">
        <div class="items-center text-center col gap-2.5 m-auto">
            <p class="font-light">{{ $message }}</p>
            <x-icons.file-search class="stroke-gray-500 size-8" />
        </div>
    </div>
@endif
