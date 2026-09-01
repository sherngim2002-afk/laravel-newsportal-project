<x-frontend-layout title="Search For {{ $query }}">
    <section class="py-8">
        <div class="container grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2 space-y-6">
                <h1 class="border-b-4 border-(--primary) text-xl">
                    <strong class="bg-(--primary) text-white px-4 py-1">
                        Result For {{ $query }}
                    </strong>
                </h1>

                @if (count($articles) > 0)
                    @foreach ($articles as $article)
                        <a href="{{ route('article', $article->slug) }}"
                            class="card grid grid-cols-3 gap-2 items-center overflow-hidden">
                            <img class="h-[210px] w-full object-cover" src="{{ asset(Storage::url($article->image)) }}"
                                alt="{{ $article->title }}">

                            <div class="col-span-2 p-3">
                                <h3 class="text-xl font-semibold line-clamp-2">
                                    {{ $article->title }}
                                </h3>
                                <div class="line-clamp-4">
                                    {!! $article->description !!}
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <h2 class="text-3xl border-l-4 border-(--primary) pl-3 font-semibold">
                        No Result Found
                    </h2>
                @endif
            </div>

            <div class="mt-8 flex flex-col gap-6">
                @foreach ($advertises as $advertise)
                    <a href="{{ $advertise->redirect_link }}" target="_blank">
                        <img class="w-full" src="{{ asset(Storage::url($advertise->banner)) }}"
                            alt="{{ $advertise->company_name }}">
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-frontend-layout>
