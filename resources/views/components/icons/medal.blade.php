<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" {{ $attributes->merge(['class' => '']) }}>
    @if (isset($position) && $position == 1)
        <circle cx="12" cy="15.5" r="6.5" stroke="" stroke-width="1.5" />
        <path d="M9 9.5L5.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15 9.5L18.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15 2L14 4.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M12.5 9L9.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M11 18H12M12 18H13M12 18V13L11 13.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    @elseif (isset($position) && $position == 2)
        <path d="M10.5 14L11.0305 13.4285C11.653 12.799 12.6825 12.873 13.2107 13.5852C13.6233 14.1417 13.5915 14.915 13.1346 15.4349L10.5 18H13.4315" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <circle cx="12" cy="15.5" r="6.5" stroke="" stroke-width="1.5" />
        <path d="M9 9.5L5.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15 9.5L18.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15 2L14 4.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M12.5 9L9.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    @elseif (isset($position) && $position == 3)
        <path d="M10.5 14C10.8265 13.347 11.2786 13 12 13C12.7296 13 13.5 13.4558 13.5 14.25C13.5 14.9404 12.9404 15.5 12.25 15.5C12.9404 15.5 13.5 16.0596 13.5 16.75C13.5 17.5442 12.7296 18 12 18C11.2786 18 10.8265 17.653 10.5 17" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <circle cx="12" cy="15.5" r="6.5" stroke="" stroke-width="1.5" />
        <path d="M9 9.5L5.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15 9.5L18.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15 2L14 4.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M12.5 9L9.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    @else
        <path d="M10.5 15.5C10.5 14.6716 11.1476 14 11.9464 14H12.0536C12.8524 14 13.5 14.6716 13.5 15.5C13.5 16.3284 12.8524 17 12.0536 17H11.9464C11.1476 17 10.5 16.3284 10.5 15.5Z" stroke="" stroke-width="1.5" />
        <circle cx="12" cy="15.5" r="6.5" stroke="" stroke-width="1.5" />
        <path d="M9 9.5L5.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15 9.5L18.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15 2L14 4.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M12.5 9L9.5 2" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    @endif
</svg>
