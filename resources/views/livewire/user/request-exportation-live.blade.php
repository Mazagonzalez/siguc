<div class="gap-3 col">
    {{-- Total de solicitudes por estado --}}
    <x-utils.card-request-status
        :acepted="$request_acepted"
        :pending="$request_pending"
        :rejected="$request_rejected"
        :finished="$request_finished"
    />

    <div class="gap-3 row">
        <div class="w-[28%] gap-3 p-4 card-theme col h-fit">
            <div class="gap-2 row">
                <input
                    type="text"
                    wire:model.live="proformaId"
                    placeholder="Orden de exportación"
                    class="w-full
                    @if ($orders)
                        input-simple-success
                    @else
                        @if ($pending === 1 || $pending === 2)
                            input-simple-err
                        @else
                            input-simple
                        @endif
                    @endif"
                >

                <button
                    wire:click='clear'
                    class="px-5 py-2 bg-slate-900 rounded-xl tooltip tooltip-top"
                    data-tip="Limpiar buscador"
                >
                    <x-icons.clear class="stroke-white size-5" />
                </button>
            </div>

            <div class="p-4 bg-gray-100 col rounded-xl dark:bg-zinc-800 h-[117px]">
                @if ($orders)
                    <div wire:key='orden-{{ $orders['id'] }}' class="w-full text-sm">
                        <div class="py-2 font-semibold border-b border-gray-300 row dark:border-white/20">
                            <p>Cliente</p>
                        </div>
                        <div class="items-center justify-between py-2 font-light row">
                            <p class="tooltip tooltip-top text-start" data-tip="{{ $orders['target_customer'] }}">
                                {{ auth()->user()->short($orders['target_customer'], 25) }}
                            </p>
                            <div class="w">
                                @livewire('user.exportation.search-created-requests-exportation-live', ['order' => $orders], key($orders['id'] . 'search-request-exportation'))
                            </div>
                        </div>
                    </div>
                @else
                    @if ($pending === 0)
                        <x-utils.not-search text="text-sm" message="Aun no se ha buscado ninguna orden" />
                    @elseif ($pending === 1)
                        <x-utils.not-search text="text-sm" message="Esta orden no existe" />
                    @elseif ($pending === 2)
                        <x-utils.not-search text="text-sm" message="Esta orden ya existe" />
                    @endif
                @endif
            </div>
        </div>

        <div class="w-[72%]">
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
                </div>

                <div class="w-full">
                    <div x-show="typeRequest === 1" x-transition:enter.duration.500ms>
                        @livewire('user.exportation.pending-requests-live', key('pending-request-'.auth()->user()->id))
                    </div>

                    <div x-show="typeRequest === 2" x-transition:enter.duration.500ms style="display: none">
                        @livewire('user.exportation.end-requests-live', key('history-request-'.auth()->user()->id))
                    </div>

                    <div x-show="typeRequest === 3" x-transition:enter.duration.500ms style="display: none">
                        @livewire('user.exportation.history-requests-live', key('history-request-'.auth()->user()->id))
                    </div>
                </div>
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
