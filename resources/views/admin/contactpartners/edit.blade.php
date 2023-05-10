@extends("layout.app")

@section("content")
    <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%] ml-3" method="POST" action="{{ route("contacteditPost", $contactpartner->id) }}" enctype="multipart/form-data">
        @csrf
        <x-form.input
            label="Vorname"
            inputName="firstname"
            inputType="text"
            placeholder="Vorname eingeben"
            :value="$contactpartner->firstname"
            setRequired="1"
        ></x-form.input>

        <x-form.input
            label="Nachname"
            inputName="lastname"
            inputType="text"
            placeholder="Nachname eingeben"
            :value="$contactpartner->lastname"
            setRequired="1"
        ></x-form.input>

        <x-form.checkbox
            label="Sichtbar auf der Startseite"
            inputName="visiblefrontpage"
            :value="$contactpartner->visiblefrontpage"
            setRequired="0"
        ></x-form.checkbox>

        <x-form.input
            label="Bild Upload"
            inputName="image"
            inputType="file"
            placeholder=""
            value="0"
            subText="Das Bild muss vom Datentyp: png, jpg oder jpeg sein. Maximale Größe: {{ Config::IMAGESIZEPARTNERS }}mb!"
            showSubText="1"
            setRequired="0"
        ></x-form.input>

        <div class="formButtons">
            <x-button content="Speichern" colorType="success"></x-button>
            <x-button type="1" :link="route('admin.contactmanagement')" content="Abbrechen" colorType="danger"></x-button>
        </div>


    </form>
@endsection
