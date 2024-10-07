<div>
    @if ($type == 1)
        <div class="p-6 card-theme">
            <div class="items-center gap-2 row">
                <p class="text-lg font-semibold">Top 5</p>

                <div class="px-2 text-xs text-indigo-500 bg-indigo-100 rounded-full">
                    Solicitudes Finalizadas
                </div>
            </div>

            <div x-data="colors: [#84cc16, #06b6d4, #8b5cf6, #ec4899, #ef4444], date: [0, 1, 2, 3, 4]" class="w-full p-[2px] my-8 bg-gray-200 rounded row">
                @forelse ($providers as $index => $provider)
                    <div
                        class="h-2"
                        style="width: {{ number_format($provider->total / $totalStates * 100) }}%">
                    </div>
                @endforeach
            </div>

            <div class="col divide-y-theme">
                @forelse ($providers as $index => $provider)
                    @if ($index <= 4)
                        <div class="items-center justify-between py-2 pr-4 row">
                            <div class="items-center gap-2 row">
                                <div class="text-blue-500 bg-blue-100 rounded size-7 center-content">{{ $index + 1 }}</div>
                                <p class="font-medium tooltip tooltip-top" data-tip="{{ $provider->provider->company_name }}">
                                    {{ auth()->user()->short($provider->provider->company_name, 25) }}
                                </p>
                            </div>

                            <p class="font-light">{{ $provider->total }}</p>
                        </div>
                    @endif
                @empty
                    <div>
                        <x-utils.not-search message="No hay solicitudes finalizadas" />
                    </div>
                @endforelse
            </div>
        </div>
    @endif

    {{-- @if ($totalStates > 0)
        {{ number_format(($provider->total / $totalStates) * 100, 2) }}%
    @endif

    <div class="center-content">
        @if ($index == 0)
            <x-icons.medal position="1" class="stroke-yellow-400 size-7" />
        @elseif ($index == 1)
            <x-icons.medal position="2" class="stroke-gray-400 size-7" />
        @elseif ($index == 2)
            <x-icons.medal position="3" class="stroke-orange-500 size-7" />
        @elseif ($index == 3 || $index == 4)
            <x-icons.medal class="stroke-[#a0642c] size-7" />
        @else
            # {{ $index }}
        @endif
    </div> --}}
</div>
