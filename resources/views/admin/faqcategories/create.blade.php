@extends("layout.app")

@section("content")

    <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%] ml-3" method="POST" action="{{ route("faqcategoriesnew") }}" enctype="multipart/form-data">
        @csrf
        <x-form.input
                label="Kategorie"
                inputName="name"
                inputType="text"
                placeholder="Kategorie eingeben"
                :value="old('category')"
                setRequired="1"
        ></x-form.input>

        <x-form.input
                label="Bild Upload"
                inputName="imagepath"
                inputType="file"
                placeholder=""
                setRequired="1"
                value="0"
                subText="Das Bild muss vom Datentyp: {{ str_replace(array('image', 'application', '/'), ' ', implode(' ',Config::ALLOWEDEXTENSIONS)) }} sein. Maximale Größe: {{ Config::IMAGESIZEFAQ }}mb!"
                showSubText="1"
        ></x-form.input>

        <div class="formButtons">
            <x-button content="Erstellen" colorType="success"></x-button>
            <x-button type="1" :link="route('admin.faqcategories')" content="Abbrechen" colorType="danger"></x-button>
        </div>

    </form>

@endsection
