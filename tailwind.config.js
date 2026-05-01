// tailwind.config.js
import defaultTheme from 'tailwindcss/defaultTheme'

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                cream:      '#F5F0E8',
                parchment:  '#E8DFC8',
                sepia:      '#8B6914',
                gold:       '#C9A84C',
                'gold-light':'#F0C84A',
                ink:        '#1A1208',
                'ink-light':'#3D2B1F',
                rust:       '#8B3A1A',
                'rust-light':'#B54A2A',
                burgundy:   '#5C1A2E',
                sage:       '#4A5E3A',
                paper:      '#FAF6EE',
            },
            fontFamily: {
                display:        ['"Bebas Neue"', 'sans-serif'],
                'serif-display':['"Playfair Display"', 'serif'],
                typewriter:     ['"Special Elite"', 'cursive'],
                mono:           ['"Courier Prime"', 'monospace'],
                sans:           ['"Courier Prime"', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'float':       'float 6s ease-in-out infinite',
                'float-slow':  'float 9s ease-in-out 1s infinite',
                'flicker':     'flicker 4s ease-in-out infinite',
                'marquee':     'marquee 30s linear infinite',
                'marquee2':    'marquee2 30s linear infinite',
                'fadeInUp':    'fadeInUp 0.8s ease forwards',
                'stamp':       'stamp 0.6s cubic-bezier(0.175,0.885,0.32,1.275) forwards',
                'spin-slow':   'spin 25s linear infinite',
                'pulse-gold':  'pulseGold 2.5s ease-in-out infinite',
                'scanline':    'scanline 8s linear infinite',
                'typewriter':  'typewriter 3s steps(40) forwards',
            },
            keyframes: {
                float: {
                    '0%,100%': { transform: 'translateY(0) rotate(-1deg)' },
                    '50%':     { transform: 'translateY(-14px) rotate(1deg)' },
                },
                flicker: {
                    '0%,100%': { opacity: '1' },
                    '50%':     { opacity: '0.85' },
                    '75%':     { opacity: '0.95' },
                },
                marquee: {
                    '0%':   { transform: 'translateX(0%)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
                marquee2: {
                    '0%':   { transform: 'translateX(50%)' },
                    '100%': { transform: 'translateX(0%)' },
                },
                fadeInUp: {
                    '0%':   { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                stamp: {
                    '0%':   { transform: 'scale(3)', opacity: '0' },
                    '60%':  { transform: 'scale(0.95)', opacity: '1' },
                    '100%': { transform: 'scale(1)', opacity: '1' },
                },
                pulseGold: {
                    '0%,100%': { boxShadow: '0 0 0 0 rgba(201,168,76,0.4)' },
                    '50%':     { boxShadow: '0 0 0 12px rgba(201,168,76,0)' },
                },
                scanline: {
                    '0%':   { transform: 'translateY(-100%)' },
                    '100%': { transform: 'translateY(100vh)' },
                },
                typewriter: {
                    '0%':   { width: '0' },
                    '100%': { width: '100%' },
                },
            },
            backgroundImage: {
                'noise': "url(\"data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.08'/%3E%3C/svg%3E\")",
                'paper-texture': "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='p'%3E%3CfeTurbulence type='turbulence' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23p)' opacity='0.06'/%3E%3C/svg%3E\")",
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}