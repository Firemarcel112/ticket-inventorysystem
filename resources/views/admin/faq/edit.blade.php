@extends("layout.app")


@section("content")
    <div class="ml-4 sm:ml-0">
        <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" name="newFAQ" method="POST" action="{{ route("faqedit", $content["id"]) }}" enctype="multipart/form-data">
            @csrf
            <x-form.input
                    label="Titel"
                    inputName="title"
                    inputType="text"
                    placeholder="Titel eingeben"
                    :value="$content['title']"
                    setRequired="1"
            ></x-form.input>

            <x-form.select
                    label="Kategorie"
                    inputName="faq_category_id"
                    :compare="$content['faq_category_id']"
                    :array="$categories"
                    visibleValue="name"
            ></x-form.select>

            <x-form.checkbox
                    label="Sichtbar auf der Startseite"
                    inputName="visiblefrontpage"
                    :value="$content['visiblefrontpage']"
                    setRequired="0"
            ></x-form.checkbox>

            <x-form.textarea
                    label="Kurzer Inhalt"
                    inputName="shortcontent"
                    placeholder="Inhalt eingeben"
                    :value="$content['shortcontent']"
                    setRequired="1"
                    customClasses="inputTextareaCustom"
            ></x-form.textarea>

            <x-form.textarea
                    label="Langer Inhalt:"
                    inputName="longcontent"
                    placeholder="Inhalt eingeben"
                    :value="$content['longcontent']"
                    setRequired="1"
                    customClasses="inputTextareaCustom"
            ></x-form.textarea>
            <hr class="w-full my-4 border border-[2px] bg-red dark:bg-red">

            @if(!$images)
                <div id="images">

                </div>
                <script>addImage(1); removeImage()</script>
                <div class="flex gap-2 sm:gap-4 md:gap-8 sm:w-full w-fit mt-6">
                    <x-button type="1" content="Bild hinzufügen" colorType="success" id="addImage" btnClasses="cursor-pointer"></x-button>
                    <x-button type="1" content="Bild löschen" colorType="danger" id="removeImage" btnClasses="!hidden cursor-pointer"></x-button>
                </div>
            @else
                <div id="images">
                    @php $i = 1; @endphp
                    @foreach($images as $image)
                        <div>
                            <div class="sm:flex w-full sm:gap-4 relative">
                                <img src="/{{ $image['imagepath'] }}" alt="image{{$i}}" class="w-full sm:w-6/12 mb-2 sm:mb-0 h-32">
                                <div class="flex w-full flex-col">
                                    <textarea class="w-full h-24 m-[0px]" required placeholder="Bildbeschreibung eingeben" name="imageDescription[]">{{ ltrim($image["imagedescription"], '\n\v') }}</textarea>
                                    <div class="flex w-full gap-2 mt-1">
                                        <label for="deleteImage" class="text-sm sm:text-lg">Bild löschen</label>
                                        <input type="checkbox" value="{{ $image['imagepath'] }}" name="deleteImage[]" class="relative top-[8px]">
                                    </div>
                                </div>
                            </div>

                            <hr class="w-full mt-2">

                            <div class="">
                                <label>Aktuelles Bild ersetzen</label>
                                <input class="w-full block text-sm text-black cursor-pointer dark:text-white focus:outline-none dark:bg-gray-800"
                                       name="images[]" type="file">
                            </div>

                        </div>
                        @php $i++; @endphp
                        <hr class="w-full mb-6 mt-2 border border-[2px] bg-light dark:bg-white">

                    @endforeach
                </div>

                <div class="flex gap-2 sm:gap-4 md:gap-8 sm:w-full w-fit mt-6">
                    <x-button type="1" content="Bild hinzufügen" colorType="success" id="addImage" btnClasses="cursor-pointer"></x-button>
                    <x-button type="1" content="Bild löschen" colorType="danger" id="removeImage" btnClasses="!hidden cursor-pointer"></x-button>
                </div>
                <script>addImage({{ $i }}); removeImage()</script>
            @endif


            <small class="text-black dark:text-white">Die Bilder dürfen nur vom Datentyp: png, jpg oder jpeg sein. Maximale Größe: {{ Config::IMAGESIZEFAQ }}mb!</small>

            <div class="formButtons pb-8">
                <x-button content="Speichern" colorType="success"></x-button>
                <x-button type="1" :link="route('admin.faqmanagement')" content="Abbrechen" colorType="danger"></x-button>
            </div>

        </form>

    </div>


@endsection
