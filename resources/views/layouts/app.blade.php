<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style>[x-cloak] { display: none; }</style>
    </head>
    <body style="font-family: 'Poppins', sans-serif;">
        <div class="h-screen overflow-hidden bg-body-light text-slate-900 dark:bg-body-dark dark:text-white">
            <div class="flex h-full">
                <x-sidebar />

                <div class="w-full h-full overflow-y-auto col scrollbar">
                    <x-nav />

                    <!-- Page Content -->
                    <div class="flex justify-center w-full h-full">
                        <main class="w-full h-full">
                            {{ $slot }}
                        </main>
                    </div>

                </div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            /* Formatear a numeros a monto */
            function formatNumber(input) {
                let value = input.value.replace(/\D/g, '');
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                input.value = value;
            }

            /* Validar solo numeros */
            function validateNumber(input) {
                input.value = input.value.replace(/[^0-9]/g, '');
            }

            /* Control theme */
            (function () {
                const darkStyles = document.querySelector('style[data-theme="dark"]')?.textContent
                const lightStyles = document.querySelector('style[data-theme="light"]')?.textContent

                const removeStyles = () => {
                    document.querySelector('style[data-theme="dark"]')?.remove()
                    document.querySelector('style[data-theme="light"]')?.remove()
                }

                removeStyles()

                setDarkClass = () => {
                    removeStyles()

                    const isDark = localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)

                    isDark ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')

                    if (isDark) {
                        document.head.insertAdjacentHTML('beforeend', `<style data-theme="dark">${darkStyles}</style>`)
                    } else {
                        document.head.insertAdjacentHTML('beforeend', `<style data-theme="light">${lightStyles}</style>`)
                    }
                }

                setDarkClass()

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', setDarkClass)
            })();
        </script>
    </body>
</html>
