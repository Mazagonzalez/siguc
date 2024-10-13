<div class="gap-5 col">
    <div class="gap-3 row">
        <div class="w-[65%] gap-3 col">
            {{-- Total de solicitudes por estado --}}
            <x-utils.card-request-status
                :acepted="$request_acepted"
                :pending="$request_pending"
                :rejected="$request_rejected"
                :finished="$request_finished"
            />

            {{-- Total de solicitudes por tipo --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="relative gap-6 p-5 overflow-hidden text-white bg-blue-500 col rounded-2xl">
                    <div class="items-center justify-between row">
                        <span class="text-sm">Nacionales</span>

                        <div class="bg-blue-400 rounded-full size-7 center-content">
                            <x-icons.flag class="size-5 stroke-white" />
                        </div>
                    </div>

                    <p class="text-2xl font-semibold">{{ $request_nationales }}</p>

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

                    <p class="text-2xl font-semibold">{{ $request_exportation }}</p>

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

                    <p class="text-2xl font-semibold">{{ $request_thermoformed }}</p>

                    {{-- Figura --}}
                    <div class="absolute p-4 border-2 border-indigo-400 rounded-xl -right-16 -bottom-16">
                        <div class="p-4 border-2 border-indigo-400 rounded-lg">
                            <div class="border-2 border-indigo-400 rounded-lg size-14"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full p-8 card-theme">
                @livewire('user.history-dashboard-live', ['dashboard' => true], key('history-request-'.auth()->user()->id))
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
