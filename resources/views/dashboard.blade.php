<x-app-layout>
    @role('Admin')
        @livewire('admin.dashboard-live')
    @endrole

    @role('User')
        @livewire('user.dashboard-live')
    @endrole

    @role('Provider')
        @livewire('provider.dashboard-live')
    @endrole
</x-app-layout>
