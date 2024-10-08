<div>
    <div>
        @livewire('user.created-requests-thermoformed-live')
    </div>
    <div
        x-data="{
            typeRequest: 1,
            activeClass: 'bg-[#ebecec] dark:bg-[#333333] font-semibold',
            inactiveClass: '',
            showFilter: false,
        }" class="relative gap-5 p-8 col card-theme"
    >
        <div class="items-center mb-5 row">
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
</div>

