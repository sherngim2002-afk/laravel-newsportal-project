<!DOCTYPE html>
<html lang="en">
@props(['title', 'meta_description', 'meta_keywords', 'image'])

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Mero Newsportal | Home' }}</title>
    <meta name="description" content="{{ $meta_description ?? '' }}">
    <meta name="keywords" content="{{ $meta_keywords ?? '' }}">

    <meta property="og:title" content="{{ $title ?? '' }}" />
    <meta property="og:description" content="{{ $meta_description ?? '' }}" />
    <meta property="og:image" content="{{ $image ?? '' }}" />
    <meta property="og:url" content="{{ url()->current() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css"
        integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/main.css') }}">
    <script src="https://cdn.jsdelivr.net/gh/sudam-shrestha/nepali-calender@main/src/nepali-calendar.js"></script>
</head>

<body>

    <x-frontend-header />

    <main class="min-h-[60vh]">
        {{ $slot }}
    </main>

    <x-frontend-footer />

    <script>
        const date = document.getElementById('date');
        const nep = NepaliCalendar.adToBs(new Date());
        const nep_date = NepaliCalendar.formatBs(nep, 'ne');
        date.innerHTML = nep_date;
    </script>

    @stack('scripts')
</body>

</html>
