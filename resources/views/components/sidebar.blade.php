<aside class="p-4">
    <div class="h-full px-5 py-6 card-theme w-[220px] col">
        <a wire:navigate href="{{ route('dashboard') }}" class="mb-6">
            <p class="text-3xl font-semibold text-blue-500" style="font-family: 'Roboto', sans-serif;">SIGUC</p>
        </a>

        <div class="divide-y-theme">
            <div class="gap-2 py-4 col">
                <span class="mb-2 text-sm font-medium text-gray-400 dark:text-white/30">Menu</span>

                <x-utils.section-sidebar
                    ifRoute="dashboard"
                    route="{{ route('dashboard') }}"
                    name="Dashboard"
                >
                    <x-slot name="icon">
                        <x-icons.dashboard />
                    </x-slot>
                </x-utils.section-sidebar>

                @role('User')
                    <x-utils.section-sidebar
                        ifRoute="request.national"
                        route="{{ route('request.national') }}"
                        name="Nacional"
                    >
                        <x-slot name="icon">
                            <x-icons.flag />
                        </x-slot>
                    </x-utils.section-sidebar>

                    <x-utils.section-sidebar
                        ifRoute="request.export"
                        route="{{ route('request.export') }}"
                        name="Exportación"
                    >
                        <x-slot name="icon">
                            <x-icons.world />
                        </x-slot>
                    </x-utils.section-sidebar>

                    <x-utils.section-sidebar
                        ifRoute="request.thermoformed"
                        route="{{ route('request.thermoformed') }}"
                        name="Termoformado"
                    >
                        <x-slot name="icon">
                            <x-icons.unsplash />
                        </x-slot>
                    </x-utils.section-sidebar>
                @endrole
            </div>

            <div class="py-4 col">
                <span class="mb-2 text-sm font-medium text-gray-400 dark:text-white/30">General</span>

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <a
                        href="{{ route('logout') }}"
                        @click.prevent="$root.submit();"
                        class="gap-2 px-4 py-2.5 items-center row rounded-xl hover:bg-red-100 hover:text-red-500 [&>svg]:hover:stroke-red-500"
                    >
                        <x-icons.logout class="h-5 min-w-5 center-content stroke-slate-900 dark:stroke-white" />

                        <span class="font-light">Cerrar Sesión</span>
                    </a>
                </form>
            </div>
        </div>
    </div>
</aside>
