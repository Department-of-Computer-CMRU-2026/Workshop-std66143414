<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title." - ".config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

@php
    $manifestPath = public_path('build/manifest.json');
    $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
@endphp

@if($manifest)
    <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
    <script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>
@else
    <!-- Fallback if manifest fails - unblocking UI -->
    <link rel="stylesheet" href="/build/assets/app-Df3y7Nxw.css">
    <script type="module" src="/build/assets/app-l0sNRNKZ.js"></script>
@endif

@fluxAppearance

<style>
    :root {
        --color-background: #fdf6f4 !important;
        --color-surface: #ffffff !important;
        --color-accent: #d9a095 !important;
        --color-accent-content: #ffffff !important;
        --color-accent-foreground: #4a3f3b !important;
    }

    body {
        background-color: var(--color-background) !important;
        color: var(--color-accent-foreground) !important;
        font-weight: 500 !important;
    }

    [data-flux-sidebar] {
        background-color: var(--color-background) !important;
        border-right-color: rgba(217, 160, 149, 0.2) !important;
    }

    .bg-surface {
        background-color: var(--color-surface) !important;
    }

    flux-card, .flux-card {
        background-color: var(--color-surface) !important;
        border-color: transparent !important;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05) !important;
    }

    [data-flux-button][data-variant="primary"] {
        color: #ffffff !important;
        font-weight: 700 !important;
    }

    [data-flux-sidebar-item] {
        transition: all 0.2s ease !important;
        margin-left: 0.5rem !important;
        margin-right: 0.5rem !important;
        border-radius: 0.5rem !important;
    }

    [data-flux-sidebar-item][data-current] {
        background-color: rgba(217, 160, 149, 0.15) !important;
        color: var(--color-accent) !important;
        font-weight: 700 !important;
    }

    [data-flux-sidebar-item]:hover:not([data-current]) {
        background-color: rgba(217, 160, 149, 0.05) !important;
        color: var(--color-accent) !important;
    }

    [data-flux-brand-name] {
        font-weight: 800 !important;
    }

    [data-flux-heading] {
        font-weight: 800 !important;
        color: var(--color-accent-foreground) !important;
    }
</style>
