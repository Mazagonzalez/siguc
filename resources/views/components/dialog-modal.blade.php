@props(['id' => null, 'maxWidth' => null, 'title' => ''])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    @isset($title)
        <p class="px-6 pt-6 text-xl font-semibold text-center">{{ $title }}</p>
    @endisset

    <div class="px-6 py-4 text-sm text-start">
        {{ $content }}
    </div>

    <div class="items-center justify-end gap-2 px-6 pb-4 row">
        {{ $footer }}
    </div>
</x-modal>
