@extends("layout.app")

@section("content")
    <div class="ml-4 sm:ml-0">
        <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" name="newFAQ" method="POST" action="{{ route("faqnew") }}" enctype="multipart/form-data">
            @csrf
            <x-form.input
                    label="Titel"
                    inputName="title"
                    inputType="text"
                    placeholder="Titel eingeben"
                    :value="old('title')"
                    setRequired="1"
            ></x-form.input>

            <x-form.select
                label="Kategorie"
                inputName="faq_category_id"
                :compare="NULL"
                :array="$categories"
                visibleValue="name"
            ></x-form.select>

            <x-form.checkbox
                    label="Sichtbar auf der Startseite"
                    inputName="visiblefrontpage"
                    :value="old('visibleFrontPage')"
                    setRequired="0"
            ></x-form.checkbox>

            <x-form.textarea
                    label="Kurzer Inhalt"
                    inputName="shortcontent"
                    placeholder="Inhalt eingeben"
                    :value="old('shortContent')"
                    setRequired="1"
                    customClasses="inputTextareaCustom"
            ></x-form.textarea>

            <x-form.textarea
                    label="Langer Inhalt"
                    inputName="longcontent"
                    placeholder="Inhalt eingeben"
                    :value="old('longContent')"
                    setRequired="1"
                    customClasses="inputTextareaCustom"
            ></x-form.textarea>


            <hr class="w-full my-2">
            <div id="images">

            </div>
            <div class="flex gap-2 sm:gap-4 md:gap-8 sm:w-full w-fit mt-6">
                <x-button type="1" content="Bild hinzufügen" colorType="success" id="addImage" btnClasses="cursor-pointer"></x-button>
                <x-button type="1" content="Bild löschen" colorType="danger" id="removeImage" btnClasses="!hidden cursor-pointer"></x-button>
            </div>
            <small class="text-black dark:text-white">Die Bilder dürfen nur vom Datentyp: png, jpg oder jpeg sein. Maximale Größe: {{ Config::IMAGESIZEFAQ }}mb!</small>

            <script>addImage(1)</script>
            <script>removeImage()</script>
            <div class="formButtons pb-8">
                <x-button content="Erstellen" colorType="success"></x-button>
                <x-button type="1" :link="route('admin.faqmanagement')" content="Abbrechen" colorType="danger"></x-button>
            </div>
        </form>
    </div>

@endsection
