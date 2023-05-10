@extends("layout.app")

@section("content")

    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>

        <div id="BearbeitenMain">
            <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="POST" action="{{ route("inventorystatusPost", $assetstatus->id) }}">
                @csrf
                <x-form.input
                    label="Statusname"
                    inputName="name"
                    inputType="text"
                    placeholder="Statusname eingeben"
                    :value="$assetstatus->name"
                    setRequired="1"
                ></x-form.input>

                <x-form.input
                    label="Farbe"
                    inputName="color"
                    inputType="color"
                    placeholder="Farbe auswählen"
                    :value="$assetstatus->color"
                    setRequired="1"
                ></x-form.input>

                <div class="formButtons">
                    <x-button content="Speichern" colorType="success"></x-button>
                    <x-button type="1" :link="route('inventory.status.dashboard')" content="Abbrechen" colorType="danger"></x-button>
                </div>

            </form>

        </div>
    </div>

@endsection
