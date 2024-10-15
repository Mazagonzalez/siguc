@php
    switch ($status) {
        case 0:
            $pill = 'bg-yellow-100 text-yellow-500';
            break;
        case 1:
            $pill = 'bg-blue-100 text-blue-500';
            break;
        case 2:
            $pill = 'bg-red-100 text-red-500';
            break;
        case 3:
            $pill = 'bg-indigo-100 text-indigo-500';
            break;
        case 4:
            $pill = 'bg-white-100 text-emerald-500';
            break;
        case 5:
            $pill = 'bg-emerald-100 text-emerald-500';
            break;
    }
@endphp

<div class="px-2 w-fit mx-auto font-medium rounded-full {{ $pill }}">
    @if ($status == 0)
        <span>Pendiende</span>
    @elseif ($status == 1)
        <span>Aceptado</span>
    @elseif ($status == 2)
        <span>Rechazado</span>
    @elseif ($status == 3)
        <span>Facturado</span>
    @elseif ($status == 4)
        <span>Confirmado</span>
    @elseif ($status == 5)
        <span>Finalizado</span>
    @endif
</div>
