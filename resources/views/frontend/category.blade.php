<x-frontend-layout title="{{ $category->meta_title }}" meta_description="{{ $category->meta_description }}"
    meta_keywords="{{ $category->meta_keywords }}">
    <section class="py-6 md:py-8">
        <div class="container">
            <nav aria-label="Breadcrumb" class="text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-(--primary)">गृहपृष्ठ</a>
                <span class="mx-1">/</span>
                <span class="text-gray-700">{{ $category->title }}</span>
            </nav>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <h1 class="text-2xl md:text-3xl font-bold border-l-4 border-(--primary) pl-3 mb-6">
                        {{ $category->title }}
                    </h1>

                    <div class="space-y-5">
                        @forelse ($category->articles()->latest()->get() as $article)
                            <article
                                class="rounded-xl overflow-hidden bg-white border border-gray-100 shadow-sm hover:shadow-lg transition duration-300 group">
                                <a href="{{ route('article', $article->slug) }}" class="grid grid-cols-3 gap-4 items-stretch">
                                    <div class="col-span-1 overflow-hidden">
                                        <img class="h-full min-h-[150px] w-full object-cover transition duration-300 group-hover:scale-105"
                                            src="{{ asset(Storage::url($article->image)) }}"
                                            alt="{{ $article->title }}" loading="lazy">
                                    </div>

                                    <div class="col-span-2 p-3 pl-0">
                                        <h2 class="text-xl font-semibold line-clamp-2 group-hover:text-(--primary) transition">
                                            {{ $article->title }}
                                        </h2>
                                        <div class="line-clamp-3 text-gray-500 text-sm mt-1">
                                            {!! strip_tags($article->description) !!}
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @empty
                            <p class="text-gray-500">यस श्रेणीमा हाल कुनै समाचार छैन।</p>
                        @endforelse
                    </div>
                </div>

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
</x-frontend-layout>
