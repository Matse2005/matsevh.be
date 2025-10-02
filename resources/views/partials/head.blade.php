<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title && $title != '' ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

{{-- <link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png"> --}}

<script defer src="https://cloud.umami.is/script.js" data-website-id="d8f4fc88-bb0a-47d7-b46b-50b8f78fd60e"></script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
{{-- @fluxAppearance --}}
