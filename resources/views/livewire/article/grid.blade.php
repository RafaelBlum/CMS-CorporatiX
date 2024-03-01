<section class="bg-white py-8 dark:bg-gray-800">
    <div class="container mx-auto flex flex-wrap pt-4 pb-6">
        <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800 dark:text-white">
            {{$title}}
        </h2>

        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <p class="w-full text-lg font-normal leading-tight text-center text-gray-500 sm:text-xl dark:text-gray-400 mb-3">
            All types of businesses need access to development resources, so we give you the option to decide how much you need to use.
        </p>
        @foreach($articles as $article)
            <div class="mx-auto max-w-md overflow-hidden rounded-lg bg-white shadow mt-4">
                <img src="{{asset("storage/".$article->featured_image_url)}}" class="aspect-video w-full object-cover" alt=""/>

                <div class="p-4">

                    <div class="mb-1 flex items-center gap-x-4">
                        <img src="{{asset("storage/".$article->author->avatar)}}" class="w-10 h-10 rounded-full">
                        <div class="text-sm leading-6">
                            <p class="font-semibold text-gray-900">
                                <div>
                                    <span class="inset-0"></span>
                                    {{$article->author->name}} • <time> {{date_format($article->published_at,"Y/m/d")}} </time>
                                    <a href="{{route('category.show', $article->category)}}" class="bg-purple-100 text-purple-800 text-xs font-medium me-4 px-2 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">
                                        {{Str($article->category->name)->ucfirst()}}
                                    </a>
                                </div>
                            </p>
                        </div>
                    </div>

                    <h3 class="text-xl font-medium text-gray-900"><a href="{{route('article.show', $article)}}">{{$article->title}}</a></h3>
                    <p class="mt-1 text-gray-500">{{$article->subTitle}}.</p>

                    <div class="mt-4 flex gap-2">
                        @foreach($article->tags as $tag)
                            <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                            {{$tag->name}}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

    </div>

</section>
