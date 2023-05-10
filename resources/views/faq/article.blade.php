@extends("layout.app")

@section('outerApp')
    <div id="imageBox" class="hidden" onclick="scaleImage(event)">
        <img src="">
    </div>
@endsection

@section("content")

    <h1>{{ $faq->title }}:</h1>
    <h2 class="mb-4 mt-6 text-center text-2xl xl:text-3xl text-main dark:text-main font-black underline">{{ $category->name }}</h2>
    <div>
        <p class="w-9/12 mx-auto dark:bg-slate-600 bg-gray-300 rounded p-5">{!! nl2br(htmlspecialchars($faq->longcontent)) !!}</p>
    </div>
    <div class="flex gap-4 w-9/12 block mx-auto mb-12">
        @empty(!$images)
            <div class="flex w-full gap-4 mx-auto mt-6 flex-wrap justify-content">
                @php $i=0 @endphp
                @foreach($images as $image)
                    <div class="flex flex-col">
                        @php $i++ @endphp
                        <div id="divImage{{$i}}" onclick="scaleImage(this)">
                            <img src="/{{ $image->imagepath }}" alt="bild" class="img w-36 h-36 sm:w-48 md:h-48">
                        </div>
                        <p class="rounded text-sm xl:text-base text-black dark:text-white w-36 sm:w-48 mt-4 p-2 text-ellipsis overflow-hidden dark:bg-slate-600">{{ $image->imagedescription }}</p>
                    </div>
                 @endforeach
            </div>
        @endempty
    </div>

    <div class="flex mx-auto mt-2 w-9/12">
        <x-button
            content="Zurück"
            type="1"
            colorType="danger"
            :link="route('faq.dashboard')"
        ></x-button>
    </div>

@endsection
