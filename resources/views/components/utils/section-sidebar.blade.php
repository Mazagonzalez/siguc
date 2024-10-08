@props(['ifRoute', 'route', 'icon', 'name', 'tooltip'])

<a
    @isset($route)
        href="{{ $route }}"
    @endisset
    class="gap-2 px-4 py-2.5 row items-center rounded-xl hover:bg-gray-200 hover:dark:bg-zinc-800 {{ request()->routeIs($ifRoute) ? 'bg-gray-200 dark:bg-zinc-800' : '' }}"
    @isset ($tooltip)
        data-tip="{{ $tooltip }}"
    @endisset
>
    <div class="h-5 min-w-5 center-content stroke-slate-900 dark:stroke-white">
        {{ $icon }}
    </div>

    <span class="text-sm {{ request()->routeIs($ifRoute) ? 'font-semibold' : 'font-light' }}">
        {{ $name }}
    </span>
</a>
