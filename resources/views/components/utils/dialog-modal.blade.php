@props(['id' => null, 'maxWidth' => null, 'close' => true, 'codeOpen' => '$set("open", false)'])

<x-utils.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    @isset($title)
        <div class="flex justify-start px-4 py-4 sm:px-6">
            @if ($close)
                <div class="size-10 rounded-full bg-[#3B4259] center-content">
                    <x-utils.button-modal-title :codeOpen="$codeOpen" />
                </div>
            @endif
        </div>
    @endisset

    <div class="p-4 text-white sm:px-6 lg:py-5">
        {{ $content }}
    </div>

    @isset($footer)
        <div class="w-full gap-2 px-4 pb-4 sm:px-6 row">
            {{ $footer }}
        </div>
    @endisset
</x-utils.modal>
