<div class="items-center justify-center gap-2 row">
    @if ($status == 0)
        <div class="bg-yellow-500 rounded-full size-2"></div>
        <span>Pendiende</span>
    @elseif ($status == 1)
        <div class="bg-blue-500 rounded-full size-2"></div>
        <span>Aceptado</span>
    @elseif ($status == 2)
        <div class="bg-red-500 rounded-full size-2"></div>
        <span>Rechazado</span>
    @elseif ($status == 3)
        <div class="bg-purple-500 rounded-full size-2"></div>
        <span>Confirmado</span>
    @elseif ($status == 4)
        <div class="rounded-full bg-emerald-500 size-2"></div>
        <span>Finalizado</span>
    @endif
</div>
