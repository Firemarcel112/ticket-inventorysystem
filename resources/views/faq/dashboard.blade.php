@extends("layout.app")


@section("content")
    <h1>{{ $pageTitle }}</h1>
    <div class="categoriesOverviewWrapper hidden lg:block">
        <div class="mt-20 md:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 w-10/12  xl:w-8/12 mx-auto gap-4 mb-6">
            @foreach($categories as $category)
                @foreach($contents as $content)
                    @if($category->id == $content->faq_category_id)
                        <div class="categorieOverview">
                            <a href="#categorie{{ str_replace(" ", "", $category->name) }}" class="block text-center 2xl:text-2xl xl:text-xl text-lg font-bold">
                                <span>{{ $category["name"] }}</span>
                                <img src="{{ $category["imagepath"] }}" class="mt-2 mx-auto h-[225px] w-[225px]" alt="KategorieBild">
                            </a>
                        </div>
                        @break;
                    @endif
                @endforeach
            @endforeach
        </div>

    </div>

    <hr class="border-[5px] w-10/12  xl:w-8/12 mx-auto my-5">

    <div class="w-10/12  xl:w-8/12 mx-auto mb-20">
        @foreach($categories as $category)
            @foreach($contents as $content)
                @if($content->faq_category_id == $category->id)
                    <div id="categorie{{ str_replace(" ", "", $category->name) }}" class="categorie">
                        <h2>{{ $category->name }}</h2>
                    </div>
                    @break
                @endif
            @endforeach
                @foreach($contents as $content)
                    @if($content->faq_category_id == $category->id)
                        <div id='c{{$content['id']}}Header' class="cursor-pointer" onclick="openMenuFAQ('{{ "c{$content["id"]}content" }}', '{{ "c{$content["id"]}Header" }}')">
                            <div id="{{ str_replace(" ", "", $content->title) }}title" class="categorieTitle">
                                <p>{{ $content->title }}</p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48" class="absolute right-2">
                                    <path class='plus stroke-black fill-black dark:stroke-white dark:fill-white' d="M450 776h60V606h170v-60H510V376h-60v170H280v60h170v170ZM180 936q-24 0-42-18t-18-42V276q0-24 18-42t42-18h600q24 0 42 18t18 42v600q0 24-18 42t-42 18H180Zm0-60h600V276H180v600Zm0-600v600-600Z"/>
                                </svg>
                            </div>
                        </div>

                        <div id="{{ "c{$content["id"]}content" }}" class="categorieContent hidden">
                            <p>{{ $content->shortcontent }}</p>

                            <div class="mt-2">
                                <x-button
                                    content="Inhalt anzeigen"
                                    type="1"
                                    colorType="success"
                                    :link="route('faq.article', $content['id'])"
                                ></x-button>
                            </div>


                        </div>
                    @endif
                @endforeach
        @endforeach
    </div>

@endsection


