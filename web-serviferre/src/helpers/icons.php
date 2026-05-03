<?php
if (!function_exists('serviferre_icon')) {
    function serviferre_icon(string $name): string
    {
        $icons = [
            'bolt' => '<svg viewBox="0 0 24 24"><path d="M13 2 4 14h7l-1 8 10-13h-7l1-7Z"/></svg>',
            'home' => '<svg viewBox="0 0 24 24"><path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/></svg>',
            'bulb' => '<svg viewBox="0 0 24 24"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M8 14a6 6 0 1 1 8 0c-1 1-1 2-1 4H9c0-2 0-3-1-4Z"/></svg>',
            'panel' => '<svg viewBox="0 0 24 24"><path d="M4 5h16v14H4Z"/><path d="M8 9h8"/><path d="M8 13h3"/><path d="M15 13h1"/><path d="M8 17h8"/></svg>',
            'plug' => '<svg viewBox="0 0 24 24"><path d="M9 7V3"/><path d="M15 7V3"/><path d="M7 7h10v5a5 5 0 0 1-10 0Z"/><path d="M12 17v4"/></svg>',
            'network' => '<svg viewBox="0 0 24 24"><path d="M12 4v6"/><path d="M6 20v-4h12v4"/><path d="M4 20h4"/><path d="M10 10h4"/><path d="M16 20h4"/></svg>',
            'camera' => '<svg viewBox="0 0 24 24"><path d="M4 7h13a3 3 0 0 1 3 3v7H7a3 3 0 0 1-3-3Z"/><path d="m20 11 3-2v7l-3-2"/><path d="M10 11h4"/></svg>',
            'shield' => '<svg viewBox="0 0 24 24"><path d="M12 3 5 6v6c0 5 3 8 7 9 4-1 7-4 7-9V6Z"/><path d="m9 12 2 2 4-5"/></svg>',
            'antenna' => '<svg viewBox="0 0 24 24"><path d="M12 13v8"/><path d="M8 21h8"/><path d="M7 10a5 5 0 0 1 10 0"/><path d="M4 7a9 9 0 0 1 16 0"/><path d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg>',
            'sun' => '<svg viewBox="0 0 24 24"><path d="M12 4V2"/><path d="M12 22v-2"/><path d="m4.9 4.9 1.4 1.4"/><path d="m17.7 17.7 1.4 1.4"/><path d="M4 12H2"/><path d="M22 12h-2"/><path d="m4.9 19.1 1.4-1.4"/><path d="m17.7 6.3 1.4-1.4"/><path d="M12 17a5 5 0 1 0 0-10 5 5 0 0 0 0 10Z"/></svg>',
            'snow' => '<svg viewBox="0 0 24 24"><path d="M12 2v20"/><path d="m5 5 14 14"/><path d="M19 5 5 19"/><path d="M4 12h16"/></svg>',
            'wifi' => '<svg viewBox="0 0 24 24"><path d="M4 9a12 12 0 0 1 16 0"/><path d="M7 12a8 8 0 0 1 10 0"/><path d="M10 15a4 4 0 0 1 4 0"/><path d="M12 19h.01"/></svg>',
            'key' => '<svg viewBox="0 0 24 24"><path d="M14 14a5 5 0 1 1 2-4"/><path d="m14 14 7 7"/><path d="m18 18 2-2"/><path d="m20 20 2-2"/></svg>',
        ];

        $icon = $icons[$name] ?? $icons['bolt'];

        return '<span class="card-icon" aria-hidden="true">' . $icon . '</span>';
    }
}

if (!function_exists('serviferre_chip')) {
    function serviferre_chip(string $name, string $label): string
    {
        $icon = serviferre_icon($name);
        $safeLabel = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');

        return '<span class="card-chip">' . $icon . '<span>' . $safeLabel . '</span></span>';
    }
}
