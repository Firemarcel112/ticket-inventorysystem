@extends("layout.app")

@section("content")
    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <div class="mt-4 sm:mt-12 md:mt-16 mb-4">
                <div class="w-full">
                    <h1 class="text-center lg:text-left inline-block text-3xl sm:text-4xl mb-2 ">{{ $pageTitle }}</h1>
                </div>
            </div>

            <div class="w-full lg:flex items-center">

                <div class="md:mt-0">
                    <form method="POST" action="{{ route('assetAssign', $asset->id) }}">
                        @csrf

                        <x-form.select
                            label="Zuweisen zu einem Benutzer"
                            inputName="user_id"
                            compare="NULL"
                            :array="$users"
                            visibleValue="username"
                            :skipValue="[Config::STORAGEUSER]"
                        ></x-form.select>

                        <div class="flex gap-4 md:gap-12 mt-4 w-full">
                            <x-button content="Zuweisen" colorType="success"></x-button>
                            <x-button type="1" :link="route('inventory.assets.dashboard')" content="Abbrechen" colorType="danger"></x-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
