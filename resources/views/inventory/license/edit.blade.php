@extends("layout.app")

@section("content")

    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                @include("component.message.success")
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>

        <div id="BearbeitenMain">
            <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="POST" action="{{ route('licensePost', $license->id)}}">
                @csrf
                <x-form.input
                    label="Lizenname"
                    inputName="name"
                    inputType="text"
                    placeholder="Lizenzname eingeben"
                    :value="$license->name"
                    setRequired="1"
                ></x-form.input>
                <x-form.input
                    label="Produktschlüssel"
                    inputName="licensekey"
                    inputType="text"
                    placeholder="Produktschlüssel eingeben"
                    :value="$license->licensekey"
                    setRequired="1"
                ></x-form.input>
                <x-form.input
                    label="Anzahl"
                    inputName="total"
                    inputType="text"
                    placeholder="Anzahl an Lizenzen"
                    :value="$license->total"
                    setRequired="0"
                    patternValue="^[0-9]{0,}$"
                ></x-form.input>
                <x-form.input
                    label="Ablaufdatum"
                    inputName="expirationdate"
                    inputType="date"
                    placeholder="Ablaufdatum eingeben"
                    :value="$license->expirationdate"
                    setRequired="1"
                ></x-form.input>
                <x-form.select
                    label="Hersteller"
                    inputName="manufacturer_id"
                    :compare="$license->manufacturer->id"
                    :array="$manufacturers"
                    visibleValue="name"
                ></x-form.select>

                <x-form.input
                    label="Bestellnummer"
                    inputName="ordernumber"
                    inputType="text"
                    placeholder="Bestellnummer eingeben"
                    :value="$license->ordernumber"
                    setRequired="0"
                ></x-form.input>

                <x-form.input
                    label="Kaufdatum"
                    inputName="purchasedate"
                    inputType="date"
                    placeholder="Kaufdatum eingeben"
                    :value="$license->purchasedate"
                    setRequired="0"
                ></x-form.input>
                <x-form.input
                    label="Kaufpreis"
                    inputName="purchasecost"
                    inputType="text"
                    placeholder="Kaufpreis eingeben"
                    :value="$license->purchasecost"
                    setRequired="0"
                ></x-form.input>
                <x-form.input
                    label="Monatspreis"
                    inputName="monthprice"
                    inputType="text"
                    placeholder="Monatskosten des Abos"
                    :value="$license->monthprice"
                    setRequired="0"
                ></x-form.input>
                <x-form.input
                    label="Laufzeit in Monaten"
                    inputName="duration"
                    inputType="text"
                    placeholder="Dauer des Abos"
                    :value="$license->duration"
                    setRequired="0"
                ></x-form.input>
                <x-form.input
                    label="Link zum erneuten Kaufen"
                    inputName="purchaselink"
                    inputType="text"
                    placeholder="Link zum erneuten Kaufen"
                    :value="$license->purchaselink"
                    setRequired="0"
                ></x-form.input>

                <div class="formButtons">
                    <x-button content="Speichern" colorType="success"></x-button>
                    <x-button type="1" :link="route('inventory.license.dashboard')" content="Abbrechen" colorType="danger"></x-button>
                </div>

            </form>
        </div>
    </div>

@endsection
