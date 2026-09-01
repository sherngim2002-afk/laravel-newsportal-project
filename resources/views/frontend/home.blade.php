<x-frontend-layout>
    @if ($latest_article)
        <section class="py-8">
            <div class="container">
                <article class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 bg-white">
                    <a href="{{ route('article', $latest_article->slug) }}" class="block group relative">
                        <img class="w-full max-h-[480px] object-cover transition duration-500 group-hover:scale-[1.02]"
                            src="{{ asset(Storage::url($latest_article->image)) }}"
                            alt="{{ $latest_article->title }}" loading="eager" fetchpriority="high">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                            <span class="inline-block bg-(--primary) text-white text-xs font-semibold px-3 py-1 rounded-full mb-3">
                                ताजा खबर
                            </span>
                            <h1 class="text-2xl md:text-4xl font-bold text-white leading-snug">
                                {{ $latest_article->title }}
                            </h1>
                            <time class="text-gray-200 text-sm mt-2 inline-block card-date"
                                data-datetime="{{ $latest_article->created_at->toIso8601String() }}"></time>
                        </div>
                    </a>
                </article>
            </div>
        </section>
    @endif

    <section class="py-8">
        <div class="container space-y-12">
            @foreach ($categories as $category)
                @if (count($category->articles) > 0)
                    <div>
                        <div class="flex items-center justify-between border-l-4 border-(--primary) pl-3 mb-5">
                            <h2 class="text-2xl md:text-3xl font-bold">{{ $category->title }}</h2>
                            <a href="{{ route('category', $category->slug) }}"
                                class="text-(--primary) text-sm font-medium hover:underline shrink-0 ml-4">
                                थप हेर्नुहोस् <i class="fa-solid fa-arrow-left rotate-180 ml-1"></i>
                            </a>
                        </div>

                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach ($category->articles()->latest()->limit(6)->get() as $article)
                                <article
                                    class="rounded-xl overflow-hidden bg-white border border-gray-100 shadow-sm hover:shadow-lg transition duration-300 group">
                                    <a href="{{ route('article', $article->slug) }}" class="grid grid-cols-3 gap-3 items-stretch">
                                        <div class="col-span-1 overflow-hidden">
                                            <img class="h-[130px] w-full object-cover transition duration-300 group-hover:scale-105"
                                                src="{{ asset(Storage::url($article->image)) }}"
                                                alt="{{ $article->title }}" loading="lazy">
                                        </div>

                                        <div class="col-span-2 py-2 pr-3">
                                            <h3 class="text-lg font-semibold line-clamp-2 group-hover:text-(--primary) transition">
                                                {{ $article->title }}
                                            </h3>
                                            <div class="line-clamp-2 text-sm text-gray-500 mt-1">
                                                {!! strip_tags($article->description) !!}
                                            </div>
                                            <time class="text-xs text-gray-400 mt-2 inline-block card-date"
                                                data-datetime="{{ $article->created_at->toIso8601String() }}"></time>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    @push('scripts')
        <script>
            document.querySelectorAll('.card-date').forEach((el) => {
                const d = new Date(el.dataset.datetime);
                const bs = NepaliCalendar.adToBs(d);
                el.textContent = NepaliCalendar.formatBs(bs, 'ne');
            });
        </script>
    @endpush
</x-frontend-layout>
