<x-app-layout>
    <div class="max-w-6xl px-4 pt-4 pb-6 mx-auto lg:px-0">
        @role('Admin')
            @livewire('admin.dashboard-live')
        @endrole

        @role('User')
            @livewire('user.dashboard-live')
        @endrole

        @role('Provider')
            @livewire('provider.dashboard-live')
        @endrole
    </div>
</x-app-layout>
