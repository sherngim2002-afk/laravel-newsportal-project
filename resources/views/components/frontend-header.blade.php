<header class="sticky top-0 bg-white z-20 shadow-md">
    <div class="container flex justify-between items-center py-2">
        <img class="h-[50px] md:h-[80px]" src="{{ asset('frontend/images/logo.png') }}" alt="Logo">

        <div>
            <span id="date" class="text-[18px] md:text-[22px]"></span>
            <img class="h-[10px] md:h-[14px]" src="{{ asset('frontend/images/line.png') }}" alt="line">
        </div>
    </div>

    <nav class="bg-(--primary) text-white">
        <div class="container hidden md:flex justify-between items-center py-4 text-xl">
            <div class="flex gap-6">
                <a href="{{ route('home') }}">गृहपृष्ठ</a>
                @foreach ($categories as $category)
                    <a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                @endforeach
            </div>
            <div>
                <form action="{{route('search')}}" method="get">
                    <div class="text-(--primary) relative">
                        <input type="text" name="q" id="q" class="bg-white px-2 py-1 rounded-md">
                        <button type="submit" class="absolute right-2 top-1">
                            <i class="fa-solid fa-magnifying-glass text-(--primary)"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="container md:hidden">
            <button class="text-xl" type="button" data-drawer-target="nav-drawer" data-drawer-show="nav-drawer"
                aria-controls="nav-drawer">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </nav>
</header>

<!-- drawer component -->
<div id="nav-drawer"
    class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-neutral-primary-soft w-96 border-e border-default"
    tabindex="-1" aria-labelledby="drawer-label">
    <div class="border-b border-default pb-4 mb-5 flex items-center">
        <h5 id="drawer-label" class="inline-flex items-center text-lg font-medium text-body">
            <svg class="w-5 h-5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Menu
        </h5>
        <button type="button" data-drawer-hide="nav-drawer" aria-controls="nav-drawer"
            class="text-body bg-transparent hover:text-heading hover:bg-neutral-tertiary rounded-base w-9 h-9 absolute top-2.5 end-2.5 flex items-center justify-center">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>


    <div class="flex flex-col gap-6 text-xl">
        <a href="#">गृहपृष्ठ</a>
        <a href="#">समाचार</a>
        <a href="#">मनोरञ्जन</a>
        <a href="#">खेलकुद</a>
        <a href="#">विचार</a>
    </div>

</div>
