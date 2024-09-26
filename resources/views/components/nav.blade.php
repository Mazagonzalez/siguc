<nav x-data="{ open: false }" class="max-w-6xl px-4 pt-4 mx-auto lg:px-0">
    <div class="w-full px-10 py-6 bg-white dark:bg-[#1f1f1f] rounded-3xl">
        <div class="items-center justify-between row">
            {{-- Logo --}}
            <a wire:navigate href="{{ route('dashboard') }}">
                <p class="text-3xl font-semibold text-blue-500" style="font-family: 'Roboto', sans-serif;">SIGUC</p>
            </a>

            {{-- Rutas request()->routeIs('dashboard') --}}
            <div class="row gap-3.5 items-center">
                <x-btn-theme />

                {{-- Cerrar sesión --}}
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();" class="text-white btn-logout">
                        <span>Cerrar Sesión</span>

                        <x-icons.logout class="stroke-white dark:stroke-black size-5" />
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
