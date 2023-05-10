@extends("layout.app")

@section("content")

    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>

        <div class="flex gap-2">
            <x-button click="displayForm('infForm')" content="Informatik"
                      id="displayFormInformatik"></x-button>
            <x-button click="displayForm('miscForm')" content="Sonstiges"
                      colorType="success" id="displayFormMisc"></x-button>
        </div>

        <form id="miscForm" method="POST" action="{{ route("assetsCreateMiscPost") }}" class="hidden w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%] assetsForm">
            @csrf
            <x-form.input
                label="Gegenstands ID"
                inputName="id"
                inputType="text"
                placeholder="Gegenstands ID"
                :value="old('id')"
                setRequired="1"
                patternValue="^[0-9]{4,8}$"
                subText="Die ID muss eine 4 - 8 Stellige Zahl sein"
                showSubText="1"
            ></x-form.input>
            <x-form.input
                label="Name"
                inputName="customname"
                inputType="text"
                placeholder="Gegenstandsname"
                :value="old('name')"
                setRequired="1"
            ></x-form.input>
            <x-form.input
                label="Bestellnummer"
                inputName="ordernumber"
                inputType="text"
                placeholder="Bestellnummer eingeben"
                :value="old('ordernumber')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Garantie"
                inputName="warranty"
                inputType="date"
                placeholder="Garantie eingeben"
                :value="old('warranty')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Kaufdatum"
                inputName="purchasedate"
                inputType="date"
                placeholder="Kaufdatum"
                :value="old('purchasedate')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Kaufpreis"
                inputName="purchasecost"
                inputType="text"
                placeholder="Kaufpreis eingeben"
                :value="old('purchasecost')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Link zum erneuten Kaufen"
                inputName="purchaselink"
                inputType="text"
                placeholder="Link zum erneuten Kauf"
                :value="old('purchaselink')"
                setRequired="0"
            ></x-form.input>
            <x-form.select
                label="Herseller"
                inputName="manufacturer_id"
                :compare="NULL"
                :array="$manufacturers"
                visibleValue="name"
            ></x-form.select>
            <x-form.select
                label="Kategorie"
                inputName="category_id"
                :compare="NULL"
                :array="$categories"
                visibleValue="name"
            ></x-form.select>
            <input type="hidden" name="model_id" id="model" value="1">
            <x-form.select
                label="Status"
                inputName="status_id"
                :compare="NULL"
                :array="$statuses"
                visibleValue="name"
            ></x-form.select>
            <x-form.select
                label="Ort"
                inputName="location_id"
                :compare="NULL"
                :array="$locations"
                visibleValue="room"
                visibleValue2="street"
            ></x-form.select>
            <x-form.select
                label="Abteilung"
                inputName="department_id"
                :compare="NULL"
                :array="$departments"
                visibleValue="name"
            ></x-form.select>
            <x-form.select
                label="zugestellt zu"
                inputName="user_id"
                :compare="Config::STORAGEUSER"
                :array="$users"
                visibleValue="username"
            ></x-form.select>
            <div class="formButtons">
                <x-button content="Erstellen" colorType="success"></x-button>
                <x-button type="1" :link="route('inventory.assets.dashboard')" content="Abbrechen" colorType="danger"></x-button>
            </div>
        </form>

        <form id="infForm" class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%] assetsForm" method="POST"
              action="{{ route('assetsCreatePost') }}">
            @csrf
            <x-form.input
                label="Gegenstands ID"
                inputName="id"
                inputType="text"
                placeholder="Gegenstands ID"
                :value="old('id')"
                setRequired="1"
                patternValue="^[0-9]{4,8}$"
                subText="Die ID muss eine 4 - 8 Stellige Zahl sein"
                showSubText="1"
            ></x-form.input>
            <x-form.input
                label="Mac-Adresse"
                inputName="macaddress"
                inputType="text"
                placeholder="Mac-Addresse eingeben"
                :value="old('mac')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Seriennummer"
                inputName="serialnumber"
                inputType="text"
                placeholder="Seriennummer eingeben"
                :value="old('serialnumber')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Bestellnummer"
                inputName="ordernumber"
                inputType="text"
                placeholder="Bestellnummer eingeben"
                :value="old('ordernumber')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Garantie"
                inputName="warranty"
                inputType="date"
                placeholder="Garantie eingeben"
                :value="old('warranty')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Kaufdatum"
                inputName="purchasedate"
                inputType="date"
                placeholder="Kaufdatum"
                :value="old('purchasedate')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Kaufpreis"
                inputName="purchasecost"
                inputType="text"
                placeholder="Kaufdatum"
                :value="old('purchasecost')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Monatspreis"
                inputName="monthprice"
                inputType="text"
                placeholder="Monatsraten eingeben"
                :value="old('monthprice')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Laufzeit in Monaten"
                inputName="duration"
                inputType="text"
                placeholder="Laufzeit eingeben"
                :value="old('duration')"
                setRequired="0"
            ></x-form.input>
            <x-form.input
                label="Link zum erneuten Kaufen"
                inputName="purchaselink"
                inputType="text"
                placeholder="Link zum erneuten Kauf"
                :value="old('purchaselink')"
                setRequired="0"
            ></x-form.input>
            <x-form.select
                label="Kategorie"
                inputName="category_id"
                :compare="NULL"
                :array="$categories"
                visibleValue="name"
            ></x-form.select>
            <x-form.select
                label="Hersteller"
                inputName="manufacturer_id"
                :compare="NULL"
                :array="$manufacturers"
                visibleValue="name"
            ></x-form.select>
            <x-form.select
                label="Modell"
                inputName="model_id"
                :compare="NULL"
                :array="$models"
                visibleValue="name"
                :skipValue="[Config::CUSTOMMODEL]"
            ></x-form.select>
            <x-form.select
                label="Status"
                inputName="status_id"
                :compare="NULL"
                :array="$statuses"
                visibleValue="name"
            ></x-form.select>
            <x-form.select
                label="Ort"
                inputName="location_id"
                :compare="NULL"
                :array="$locations"
                visibleValue="room"
                visibleValue2="street"
            ></x-form.select>
            <x-form.select
                label="Abteilung"
                inputName="department_id"
                :compare="NULL"
                :array="$departments"
                visibleValue="name"
            ></x-form.select>
            <x-form.select
                label="zugestellt zu"
                inputName="user_id"
                :compare="Config::STORAGEUSER"
                :array="$users"
                visibleValue="username"
            ></x-form.select>

            <div class="formButtons">
                <x-button content="Erstellen" colorType="success"></x-button>
                <x-button type="1" :link="route('inventory.assets.dashboard')" content="Abbrechen" colorType="danger"></x-button>
            </div>
        </form>

    </div>

@endsection
