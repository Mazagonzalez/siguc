<div class="gap-5 screen-default col">
    <div class="gap-3 row">
        <div class="w-[65%] gap-3 col">
            {{-- Total de solicitudes por estado --}}
            <div class="grid grid-cols-4 px-3 py-5 divide-x-theme card-theme">
                <div class="gap-2 center-content">
                    <div class="bg-blue-100 rounded-full center-content size-10">
                        <x-icons.message-check class="stroke-blue-500 size-5" />
                    </div>

                    <div class="col">
                        <span class="text-xl leading-[25px] font-semibold">{{ $request_acepted }}</span>
                        <div class="font-light col">
                            <span class="text-[10px] leading-[10px]">Total</span>
                            <span class="text-[13px] leading-[13px]">Aceptadas</span>
                        </div>
                    </div>
                </div>

                <div class="gap-2 center-content">
                    <div class="bg-yellow-100 rounded-full center-content size-10">
                        <x-icons.clock class="stroke-yellow-500 size-5" />
                    </div>

                    <div class="col">
                        <span class="text-xl leading-[25px] font-semibold">{{ $request_pending }}</span>
                        <div class="font-light col">
                            <span class="text-[10px] leading-[10px]">Total</span>
                            <span class="text-[13px] leading-[13px]">Pendiendtes</span>
                        </div>
                    </div>
                </div>

                <div class="gap-2 center-content">
                    <div class="bg-red-100 rounded-full center-content size-10">
                        <x-icons.x-mark class="stroke-red-500 size-5" />
                    </div>

                    <div class="col">
                        <span class="text-xl leading-[25px] font-semibold">{{ $request_rejected }}</span>
                        <div class="font-light col">
                            <span class="text-[10px] leading-[10px]">Total</span>
                            <span class="text-[13px] leading-[13px]">Rechazadas</span>
                        </div>
                    </div>
                </div>

                <div class="gap-2 center-content">
                    <div class="rounded-full bg-emerald-100 center-content size-10">
                        <x-icons.check-circle class="stroke-emerald-500 size-5" />
                    </div>

                    <div class="col">
                        <span class="text-xl leading-[25px] font-semibold">{{ $request_finished }}</span>
                        <div class="font-light col">
                            <span class="text-[10px] leading-[10px]">Total</span>
                            <span class="text-[13px] leading-[13px]">Finalizadas</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total de solicitudes por tipo --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="relative gap-6 p-5 overflow-hidden text-white bg-blue-500 col rounded-2xl">
                    <div class="items-center justify-between row">
                        <span class="text-sm">Nacionales</span>

                        <div class="bg-blue-400 rounded-full size-7 center-content">
                            <x-icons.flag class="size-5 stroke-white" />
                        </div>
                    </div>

                    <p class="text-2xl font-semibold">0</p>

                    {{-- Figura --}}
                    <div class="absolute p-4 border-2 border-blue-400 rounded-full -right-16 -bottom-16">
                        <div class="p-4 border-2 border-blue-400 rounded-full">
                            <div class="border-2 border-blue-400 rounded-full size-14"></div>
                        </div>
                    </div>
                </div>

                <div class="relative gap-6 p-5 overflow-hidden text-white bg-emerald-500 col rounded-2xl">
                    <div class="items-center justify-between row">
                        <span class="text-sm">Exportación</span>

                        <div class="rounded-full bg-emerald-400 size-7 center-content">
                            <x-icons.world class="size-5 stroke-white" />
                        </div>
                    </div>

                    <p class="text-2xl font-semibold">0</p>

                    {{-- Figura --}}
                    <div class="absolute p-4 rotate-45 border-2 border-emerald-400 -right-20 -bottom-20">
                        <div class="p-4 border-2 border-emerald-400">
                            <div class="border-2 border-emerald-400 size-16"></div>
                        </div>
                    </div>
                </div>

                <div class="relative gap-6 p-5 overflow-hidden text-white bg-indigo-500 col rounded-2xl">
                    <div class="items-center justify-between row">
                        <span class="text-sm">Termoformado</span>

                        <div class="bg-indigo-400 rounded-full size-7 center-content">
                            <x-icons.unsplash class="size-5 stroke-white" />
                        </div>
                    </div>

                    <p class="text-2xl font-semibold">0</p>

                    {{-- Figura --}}
                    <div class="absolute p-4 border-2 border-indigo-400 rounded-xl -right-16 -bottom-16">
                        <div class="p-4 border-2 border-indigo-400 rounded-lg">
                            <div class="border-2 border-indigo-400 rounded-lg size-14"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full p-8 card-theme">
                @livewire('user.history-requests-live', ['dashboard' => true], key('history-request-'.auth()->user()->id))
            </div>
        </div>

        <div class="w-[35%] h-full">
            @livewire('user.ranking-live')
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
