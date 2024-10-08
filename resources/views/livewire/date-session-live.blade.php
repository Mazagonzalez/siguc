<div class="gap-1 col">
    <h2 class="text-2xl font-semibold capitalize">{{ str_replace('-', ' ', Route::current()->uri()) }}</h2>
    <div class="items-center gap-1 row">
        <x-icons.calendar class="stroke-gray-400 dark:stroke-white/30 size-[18px]" />
        <span class="text-[13px] font-light text-gray-400 dark:text-white/30">{{ $date }}</span>
    </div>
</div>
