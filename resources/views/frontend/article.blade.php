<x-frontend-layout title="{{ $article->meta_title }}" meta_description="{{ $article->meta_description }}"
    meta_keywords="{{ $article->meta_keywords }}" image="{{ asset(Storage::url($article->image)) }}" type="article">

    @php $primaryCategory = $article->categories->first(); @endphp

    @push('head')
        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'NewsArticle',
                'headline' => $article->title,
                'image' => [asset(Storage::url($article->image))],
                'datePublished' => $article->created_at->toIso8601String(),
                'dateModified' => $article->updated_at->toIso8601String(),
                'mainEntityOfPage' => url()->current(),
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'Mero Newsportal',
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('frontend/images/logo.png'),
                    ],
                ],
            ]) !!}
        </script>
    @endpush

    <section class="py-6 md:py-8">
        <div class="container">
            {{-- Breadcrumb --}}
            <nav aria-label="Breadcrumb" class="text-sm text-gray-500 mb-4 flex flex-wrap items-center gap-1">
                <a href="{{ route('home') }}" class="hover:text-(--primary)">गृहपृष्ठ</a>
                @if ($primaryCategory)
                    <span>/</span>
                    <a href="{{ route('category', $primaryCategory->slug) }}"
                        class="hover:text-(--primary)">{{ $primaryCategory->title }}</a>
                @endif
                <span>/</span>
                <span class="text-gray-700 line-clamp-1">{{ $article->title }}</span>
            </nav>

            <div class="grid md:grid-cols-3 gap-8">
                <article class="md:col-span-2">
                    @if ($primaryCategory)
                        <a href="{{ route('category', $primaryCategory->slug) }}"
                            class="inline-block bg-(--primary) text-white text-xs font-semibold px-3 py-1 rounded-full mb-3">
                            {{ $primaryCategory->title }}
                        </a>
                    @endif

                    <h1 class="text-2xl md:text-4xl font-bold leading-snug text-gray-900">
                        {{ $article->title }}
                    </h1>

                    <div class="flex items-center gap-2 text-sm text-gray-500 mt-3 pb-4 border-b border-gray-100">
                        <i class="fa-regular fa-clock"></i>
                        <span>प्रकाशित मितिः</span>
                        <time id="c_date" datetime="{{ $article->created_at->toIso8601String() }}"></time>
                    </div>

                    <img class="w-full rounded-xl my-6" src="{{ asset(Storage::url($article->image)) }}"
                        alt="{{ $article->title }}">

                    <div class="text-lg leading-loose text-gray-800 space-y-4">
                        {!! $article->description !!}
                    </div>

                    {{-- Share --}}
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-gray-100">
                        <span class="text-sm font-medium text-gray-600">सेयर गर्नुहोस्:</span>
                        <a target="_blank" rel="noopener" aria-label="Facebook मा सेयर गर्नुहोस्"
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            class="h-9 w-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-(--primary) hover:text-white transition">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a target="_blank" rel="noopener" aria-label="X मा सेयर गर्नुहोस्"
                            href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
                            class="h-9 w-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-(--primary) hover:text-white transition">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a target="_blank" rel="noopener" aria-label="WhatsApp मा सेयर गर्नुहोस्"
                            href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}"
                            class="h-9 w-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-(--primary) hover:text-white transition">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </article>

                <aside class="flex flex-col gap-6">
                    @foreach ($advertises as $advertise)
                        <a href="{{ $advertise->redirect_link }}" target="_blank" rel="noopener sponsored"
                            class="block rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                            <img class="w-full" src="{{ asset(Storage::url($advertise->banner)) }}"
                                alt="{{ $advertise->company_name }}" loading="lazy">
                        </a>
                    @endforeach
                </aside>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            const c_date = document.getElementById('c_date');

            const adDate = new Date("{{ $article->created_at->toIso8601String() }}");
            const c_nep = NepaliCalendar.adToBs(adDate);
            const c_nep_date = NepaliCalendar.formatBs(c_nep, 'ne');

            c_date.innerHTML = c_nep_date;
        </script>
    @endpush
</x-frontend-layout>
