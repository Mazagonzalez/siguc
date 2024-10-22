@php
    switch ($type) {
        case '1':
            $bg = 'bg-blue-100';
            break;
        case '2':
            $bg = 'bg-emerald-100';
            break;
        case '3':
            $bg = 'bg-indigo-100';
            break;
    }
@endphp

<div class="items-center gap-2 ml-4 row">
    <div class="rounded-lg size-8 center-content {{ $bg }}">
        @if ($type === '1')
            <x-icons.flag class="size-[22px] stroke-blue-500" />
        @elseif ($type === '2')
            <x-icons.world class="size-[22px] stroke-emerald-500" />
        @elseif ($type === '3')
            <x-icons.unsplash class="size-[22px] stroke-indigo-500" />
        @endif
    </div>

    <span class="font-medium">
        @if ($type === '1')
            Nacional
        @elseif ($type === '2')
            Exportación
        @elseif ($type === '3')
            Termoformado
        @endif
    </span>
</div>
