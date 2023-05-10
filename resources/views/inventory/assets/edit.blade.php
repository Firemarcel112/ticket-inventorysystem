@php use App\Http\Controllers\ConfigController; @endphp
@extends("layout.app")

@section("content")
    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>
        @php  @endphp
        @if($asset->model_id === ConfigController::CUSTOMMODEL)
            <form id="miscForm" method="POST" action="{{ route("assetsMiscPost", $asset->id) }}"
                  class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]">
                @csrf
                <x-form.input
                        label="Gegenstands ID"
                        inputName="id"
                        inputType="text"
                        placeholder="Gegenstands ID"
                        :value="$asset->id"
                        setRequired="1"
                        patternValue="^[0-9]{4,8}$"
                        subText="4 - 8  Stellige ID"
                ></x-form.input>
                <x-form.input
                        label="Name"
                        inputName="customname"
                        inputType="text"
                        placeholder="Gegenstandsname"
                        :value="$asset->customname"
                        setRequired="1"
                ></x-form.input>
                <x-form.input
                    label="Bestellnummer"
                    inputName="ordernumber"
                    inputType="text"
                    placeholder="Bestellnummer eingeben"
                    :value="$asset->ordernumber"
                    setRequired="0"
                ></x-form.input>
                <x-form.input
                        label="Garantie"
                        inputName="warranty"
                        inputType="date"
                        placeholder="Garantie eingeben"
                        :value="$asset->warranty"
                        setRequired="0"
                ></x-form.input>
                <x-form.input
                        label="Kaufdatum"
                        inputName="purchasedate"
                        inputType="date"
                        placeholder="Kaufdatum"
                        :value="$asset->purchasedate"
                        setRequired="0"
                ></x-form.input>
                <x-form.input
                        label="Kaufpreis"
                        inputName="purchasecost"
                        inputType="text"
                        placeholder="Kaufpreis eingeben"
                        :value="$asset->purchasecost"
                        setRequired="0"
                ></x-form.input>
                <x-form.input
                        label="Link zum erneuten Kaufen"
                        inputName="purchaselink"
                        inputType="text"
                        placeholder="Link zum erneuten Kauf"
                        :value="$asset->purchaselink"
                        setRequired="0"
                ></x-form.input>
                <input type="hidden" name="model_id" id="model" value="1">
                <x-form.select
                    label="Kategorie"
                    inputName="category_id"
                    :compare="$asset->category_id"
                    :array="$categories"
                    visibleValue="name"
                ></x-form.select>
                <x-form.select
                    label="Hersteller"
                    inputName="manufacturer_id"
                    :compare="$asset->manufacturer_id"
                    :array="$manufacturers"
                    visibleValue="name"
                ></x-form.select>
                <x-form.select
                    label="Status"
                    inputName="status_id"
                    :compare="$asset->status_id"
                    :array="$statuses"
                    visibleValue="name"
                ></x-form.select>
                <x-form.select
                    label="Ort"
                    inputName="location_id"
                    :compare="$asset->location_id"
                    :array="$locations"
                    visibleValue="room"
                    visibleValue2="street"
                ></x-form.select>
                <x-form.select
                    label="Abteilung"
                    inputName="department_id"
                    :compare="$asset->department_id"
                    :array="$departments"
                    visibleValue="name"
                ></x-form.select>
                <x-form.select
                    label="zugestellt zu"
                    inputName="user_id"
                    :compare="$asset->user_id"
                    :array="$users"
                    visibleValue="username"
                ></x-form.select>
                <div class="formButtons">
                    <x-button content="Speichern" colorType="success"></x-button>
                    <x-button type="1" :link="route('inventory.assets.dashboard')" content="Abbrechen"
                              colorType="danger"></x-button>
                </div>
            </form>
        @else
            <div id="BearbeitenMain">
                <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="POST"
                      action="{{ route('assetsPost', $asset['id']) }}">
                    @csrf
                    <x-form.input
                            label="Gegenstands ID"
                            inputName="id"
                            inputType="text"
                            placeholder="Gegenstands ID"
                            :value="$asset->id"
                            setRequired="1"
                            patternValue="^[0-9]{4,8}$"
                            subText="4 - 8  Stellige ID"
                    ></x-form.input>
                    <x-form.input
                            label="Mac-Adresse"
                            inputName="macaddress"
                            inputType="text"
                            placeholder="Mac-Addresse eingeben"
                            :value="$asset->macaddress"
                            setRequired="0"
                    ></x-form.input>
                    <x-form.input
                            label="Seriennummer"
                            inputName="serialnumber"
                            inputType="text"
                            placeholder="Seriennummer eingeben"
                            :value="$asset->serialnumber"
                            setRequired="0"
                    ></x-form.input>
                    <x-form.input
                            label="Bestellnummer"
                            inputName="ordernumber"
                            inputType="text"
                            placeholder="Bestellnummer eingeben"
                            :value="$asset->ordernumber"
                            setRequired="0"
                    ></x-form.input>
                    <x-form.input
                            label="Garantie"
                            inputName="warranty"
                            inputType="date"
                            placeholder="Garantie eingeben"
                            :value="$asset->warranty"
                            setRequired="0"
                    ></x-form.input>
                    <x-form.input
                            label="Kaufdatum"
                            inputName="purchasedate"
                            inputType="date"
                            placeholder="Kaufdatum"
                            :value="$asset->purchasedate"
                            setRequired="0"
                    ></x-form.input>
                    <x-form.input
                            label="Kaufpreis"
                            inputName="purchasecost"
                            inputType="text"
                            placeholder="Kaufdatum"
                            :value="$asset->purchasecost"
                            setRequired="0"
                    ></x-form.input>
                    <x-form.input
                            label="Monatspreis"
                            inputName="monthprice"
                            inputType="text"
                            placeholder="Monatsraten eingeben"
                            :value="$asset->monthprice"
                            setRequired="0"
                    ></x-form.input>
                    <x-form.input
                            label="Laufzeit in Monaten"
                            inputName="duration"
                            inputType="text"
                            placeholder="Laufzeit eingeben"
                            :value="$asset->duration"
                            setRequired="0"
                    ></x-form.input>
                    <x-form.input
                            label="Link zum erneuten Kaufen"
                            inputName="purchaselink"
                            inputType="text"
                            placeholder="Link zum erneuten Kauf"
                            :value="$asset->purchaselink"
                            setRequired="0"
                    ></x-form.input>
                    <x-form.select
                        label="Modell"
                        inputName="model_id"
                        :compare="$asset->model_id"
                        :array="$models"
                        visibleValue="name"
                        :skipValue="[Config::CUSTOMMODEL]"
                    ></x-form.select>
                    <x-form.select
                        label="Kategorie"
                        inputName="category_id"
                        :compare="$asset->category_id"
                        :array="$categories"
                        visibleValue="name"
                    ></x-form.select>
                    <x-form.select
                        label="Hersteller"
                        inputName="manufacturer_id"
                        :compare="$asset->manufacturer_id"
                        :array="$manufacturers"
                        visibleValue="name"
                    ></x-form.select>
                    <x-form.select
                        label="Status"
                        inputName="status_id"
                        :compare="$asset->status_id"
                        :array="$statuses"
                        visibleValue="name"
                    ></x-form.select>
                    <x-form.select
                        label="Ort"
                        inputName="location_id"
                        :compare="$asset->location_id"
                        :array="$locations"
                        visibleValue="room"
                        visibleValue2="street"
                    ></x-form.select>
                    <x-form.select
                        label="Abteilung"
                        inputName="department_id"
                        :compare="$asset->department_id"
                        :array="$departments"
                        visibleValue="name"
                    ></x-form.select>
                    <x-form.select
                        label="zugestellt zu"
                        inputName="user_id"
                        :compare="$asset->user_id"
                        :array="$users"
                        visibleValue="username"
                    ></x-form.select>
                    <div class="formButtons">
                        <x-button content="Speichern" colorType="success"></x-button>
                        <x-button type="1" :link="route('inventory.assets.dashboard')" content="Abbrechen"
                          colorType="danger"></x-button>
                    </div>

                </form>
            </div>
        @endif
    </div>
@endsection
