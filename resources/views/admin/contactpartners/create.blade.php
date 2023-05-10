@extends("layout.app")

@section("content")
    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>

        <div id="BearbeitenMain">
            <form class="userCreate w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="POST" action="{{ route('contactcreatePost') }}" enctype="multipart/form-data">
                @csrf
                <x-form.input
                    label="Vorname"
                    inputName="firstname"
                    inputType="text"
                    placeholder="Vorname eingeben"
                    :value="old('firstname')"
                    setRequired="1"
                ></x-form.input>

                <x-form.input
                    label="Nachname"
                    inputName="lastname"
                    inputType="text"
                    placeholder="Nachname eingeben"
                    :value="old('lastname')"
                    setRequired="1"
                ></x-form.input>

                <x-form.checkbox
                    label="Sichtbar auf der Startseite"
                    inputName="visiblefrontpage"
                    value="old('visiblefrontpage')"
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
                    setRequired="1"
                ></x-form.input>

                <div class="formButtons">
                    <x-button content="Erstellen" colorType="success"></x-button>
                    <x-button type="1" :link="route('admin.contactmanagement')" content="Abbrechen" colorType="danger"></x-button>
                </div>
            </form>
        </div>
    </div>
@endsection
