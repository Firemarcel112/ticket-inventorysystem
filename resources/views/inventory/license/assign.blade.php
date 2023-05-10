@extends("layout.app")

@section("content")
    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>

        <div id="BearbeitenMain">
            <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="POST"  action="{{ route('licenseAssign', $license->id) }}">
                @csrf

                <label for="asset_id">Zu einem Gegenstand zuweisen</label>
                <select name="asset_id" id="asset_id" type="text" required class="w-full mb-0.5 mt-1">
                    <option value="none" hidden selected>Wählen sie einen Gegenstand aus</option>
                        @foreach($assets as $asset)
                            <option value="{{ $asset->id }}">{{ $asset->id }} | {{ $asset->manufacturer->name }} {{ $asset->model->name }}</option>
                        @endforeach
                </select>

                <div class="formButtons">
                    <x-button content="Zuweisen" colorType="success"></x-button>
                    <x-button type="1" :link="route('inventory.license.dashboard')" content="Abbrechen" colorType="danger"></x-button>
                </div>
            </form>
        </div>
    </div>
@endsection
