<div
    class="center-content"
    x-data="{
        theme: localStorage.theme || 'light',
        toggleTheme() {
            if (this.theme === 'dark') {
                this.lightMode();
            } else {
                this.darkMode();
            }
        },
        darkMode() {
            this.theme = 'dark';
            localStorage.setItem('theme', 'dark');
            document.documentElement.classList.add('dark');
        },
        lightMode() {
            this.theme = 'light';
            localStorage.setItem('theme', 'light');
            document.documentElement.classList.remove('dark');
        },
        setDarkClass() {
            if (this.theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        },
        init() {
            this.setDarkClass();
        }
    }"
    x-init="init()"
>
    <label class="swap swap-rotate">
        <input type="checkbox" class="hidden" @click="toggleTheme" :checked="theme === 'dark'" />

        <x-icons.sun class="size-8 fill-yellow-300 swap-on" />
        <x-icons.moon class="size-8 fill-slate-700 swap-off" />
    </label>
</div>
