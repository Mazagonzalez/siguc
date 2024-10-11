<div class="gap-3 col">
    {{-- Total de solicitudes por estado --}}
    <x-utils.card-request-status
        :acepted="$request_acepted"
        :pending="$request_pending"
        :rejected="$request_rejected"
        :finished="$request_finished"
    />

    <div
        x-data="{
            typeRequest: 1,
            activeClass: 'bg-[#ebecec] dark:bg-[#333333] font-semibold',
            inactiveClass: '',
            showFilter: false,
        }" class="relative p-8 col card-theme"
    >
        <div class="items-center justify-between row">
            <div class="items-center row">
                <a class="p-4 text-sm rounded-lg cursor-pointer" @click="typeRequest = 1" :class="typeRequest === 1 ? activeClass : inactiveClass">
                    {{ __('Solicitudes en Proceso')}}
                </a>
                <a class="p-4 text-sm rounded-lg cursor-pointer" @click="typeRequest = 2" :class="typeRequest === 2 ? activeClass : inactiveClass">
                    {{ __('Solicitudes por confirmar entrega')}}
                </a>
                <a class="p-4 text-sm rounded-lg cursor-pointer" @click="typeRequest = 3" :class="typeRequest === 3 ? activeClass : inactiveClass">
                    {{ __('Historial de Solicitudes')}}
                </a>
            </div>

            @livewire('user.created-requests-thermoformed-live')
        </div>

        <div class="w-full">
            <div x-show="typeRequest === 1" x-transition:enter.duration.500ms style="display: none">
                @livewire('user.thermoformed.pending-requests-live', key('pending-request-'.auth()->user()->id))
            </div>

            <div x-show="typeRequest === 2" x-transition:enter.duration.500ms style="display: none">
                @livewire('user.thermoformed.end-requests-live', key('history-request-'.auth()->user()->id))
            </div>

            <div x-show="typeRequest === 3" x-transition:enter.duration.500ms style="display: none">
                @livewire('user.thermoformed.history-requests-live', key('history-request-'.auth()->user()->id))
            </div>
        </div>

    </div>

    @if (session('message'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition:leave.duration.400ms
            wire:transition
            class="fixed z-40 items-center gap-3 px-4 py-2 text-sm font-light text-white rounded-lg bg-emerald-500 row bottom-4 right-4"
        >
            <x-icons.checked class="stroke-white size-5" />

            {{ session('message') }}
        </div>
    @endif
</div>

