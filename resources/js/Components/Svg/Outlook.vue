<template>
    <svg fill="none" class="w-4" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <linearGradient id="a">
            <stop offset="0" stop-color="#064484" />
            <stop offset="1" stop-color="#0f65b5" />
        </linearGradient>
        <linearGradient id="b" gradientUnits="userSpaceOnUse" x1="10" x2="30" xlink:href="#a" y1="16"
            y2="16" />
        <linearGradient id="c" gradientUnits="userSpaceOnUse" x1="8" x2="32" y1="26.7692" y2="26.7692">
            <stop offset="0" stop-color="#1b366f" />
            <stop offset="1" stop-color="#2657b0" />
        </linearGradient>
        <linearGradient id="d" gradientUnits="userSpaceOnUse" x1="32" x2="8" y1="23" y2="23">
            <stop offset="0" stop-color="#44dcfd" />
            <stop offset=".453125" stop-color="#259ed0" />
        </linearGradient>
        <linearGradient id="e" gradientUnits="userSpaceOnUse" x1="8" x2="32" y1="23" y2="23">
            <stop offset="0" stop-color="#259ed0" />
            <stop offset="1" stop-color="#44dcfd" />
        </linearGradient>
        <linearGradient id="f" gradientUnits="userSpaceOnUse" x1="0" x2="18" xlink:href="#a" y1="16"
            y2="16" />
        <mask id="g" height="16" maskUnits="userSpaceOnUse" width="24" x="8" y="14">
            <path d="m8 14h22c1.1046 0 2 .8954 2 2v12c0 1.1046-.8954 2-2 2h-20c-1.10457 0-2-.8954-2-2z"
                fill="url(#c)" />
        </mask>
        <rect fill="#1066b5" height="28" rx="2" width="20" x="10" y="2" />
        <rect fill="url(#b)" height="28" rx="2" width="20" x="10" y="2" />
        <path d="m10 5h10v10h-10z" fill="#32a9e7" />
        <path d="m10 15h10v10h-10z" fill="#167eb4" />
        <path d="m20 15h10v10h-10z" fill="#32a9e7" />
        <path d="m20 5h10v10h-10z" fill="#58d9fd" />
        <g mask="url(#g)">
            <path d="m32 14v4h-2v-4z" fill="#135298" />
            <path d="m32 30v-14l-25 14z" fill="url(#d)" />
            <path d="m8 30v-14l25 14z" fill="url(#e)" />
        </g>
        <path d="m8 12c0-1.6569 1.34315-3 3-3h6c1.6569 0 3 1.3431 3 3v12c0 1.6569-1.3431 3-3 3h-9z"
            fill="#000" fill-opacity=".3" />
        <rect fill="url(#f)" height="18" rx="2" width="18" y="7" />
        <path
            d="m14 16.0693v-.1663c0-2.8808-2.0728-4.903-4.98418-4.903-2.92721 0-5.01582 2.036-5.01582 4.9307v.1663c0 2.8808 2.07278 4.903 5 4.903 2.9114 0 5-2.036 5-4.9307zm-2.3576.0277c0 1.9113-1.0759 3.0609-2.62658 3.0609-1.55063 0-2.6424-1.1773-2.6424-3.0886v-.1663c0-1.9113 1.07595-3.0609 2.62658-3.0609 1.5348 0 2.6424 1.1773 2.6424 3.0886z"
            fill="#fff" />
    </svg>
</template>