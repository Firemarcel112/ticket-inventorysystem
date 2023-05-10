@extends("layout.app")

@section("content")
    @if($asset->model->id == 1) @php $asset->model->name = $asset->customname @endphp @endif
    <h1 class="pb-4 text-2xl sm:text-3xl md:text-4xl 2xl:text-5xl">{{ $pageTitle }}<br><span class="font-semibold">{{ $asset->manufacturer->name }} {{ $asset->model->name }}</span></h1>

    <div class="bg-gray-50 dark:bg-slate-600 w-full flex  border-b-[1px] border-black">
        <div id="licenseInfoLink" class="hover:font-extrabold font-extrabold block w-24 h-12 flex items-center bg-gray-100 dark:bg-slate-500 border-solid border-t-4 border-t-blue-500 border-black hover:cursor-pointer" onclick="toggleLicense('licenseInfo', 'licenseUsage')">
            <span class="mx-auto text-black dark:text-white">Info</span>
        </div>
        <div id="licenseUsageLink"class="hover:font-extrabold font-bold block w-32 h-12 flex items-center bg-gray-100 dark:bg-slate-500 border-solid border-t-4 border-t-transparent border-transparent hover:cursor-pointer" onclick="toggleLicense('licenseUsage', 'licenseInfo')">
            <span class="mx-auto text-black dark:text-white">Verwendet</span>
        </div>
    </div>
    <div>
        <div class="p-4 bg-gray-50 shadow-lg dark:bg-slate-600 block" id="licenseInfo">
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">ID</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->id }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Produktname</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->manufacturer->name }} {{ $asset->model->name }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Mac-Address</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->macaddress }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Seriennummer</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->serialnumber }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Kaufdatum</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ Time::formatDate($asset->purchasedate, 'd.m.Y') }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Kaufpreis</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->purchasecost }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Link zum erneuten Kaufen</p>
                <a href="//{{ $asset->purchaselink }}"class="inline-block w-6/12 sm:w-8/12 ticketDashboardHyperLinks">Link zum Kaufen</a>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Monatspreis</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->monthprice }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Laufzeit in Monaten</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->duration }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Bestellnummer</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->ordernumber }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Garantie bis</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ Time::formatDate($asset->warranty, 'd.m.Y') }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Modell</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->model->name }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Kategorie</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->category->name }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Abteilung</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->department->name }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Hersteller</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->manufacturer->name }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Status</p>
                <div class="flex align-items items-center gap-2"><div style="background-color: {{ $asset->status->color }};" class="w-4 h-4 rounded-lg"></div><p>{{ $asset->status->name }}</p></div>
            </div>
            <div class="flex pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Ort</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $asset->location->street }}@if($asset->location->room != ""){{ ", " }}@endif{{ $asset->location->room }}</p>
            </div>
        </div>

        <div class="p-4 bg-gray-50 dark:bg-slate-600 hidden shadow-lg" id="licenseUsage">
            <div>
                <div class="mb-8">
                    @isset($user[0])
                        <div class="bg-light dark:bg-slate-900 font-extrabold"><p>Benutzer:</p></div>
                        <div class="overflow-x-auto">
                            <div class="customTableWrapper">
                                <table class="w-full" role="table">
                                    <thead role="rowgroup">
                                    <tr role="row">
                                        <th role="cell" style="text-align: left">Name</th>
                                        <th role="cell">Aktionen</th>
                                    </tr>
                                    </thead>
                                    <tbody role="rowgroup">
                                        <tr role="row">
                                            <td role="cell" data-label="Name"><a href="{{ route("inventory.people.show", $user[0]->user_id) }}" class="adminDashboardHyperLinks">{{ $user[0]->username }}</a></td>
                                            <td role="cell" data-label="Aktionen">
                                                <div class="actionsDiv">
                                                    <form action="{{ route('assetpeople.destroy', $asset->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Sind Sie sicher dass sie den Gegenstand vom Benutzer entfernen möchten')" title="Entziehen">
                                                            @include("component.icon.unassign")
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endisset
                </div>

                <div>
                    @empty(!$licenses)
                        <div class="bg-light dark:bg-slate-900 font-extrabold"><p>Lizenzen:</p></div>
                        <div class="overflow-x-auto">
                            <div class="customTableWrapper">
                                <table class="w-full" role="table">
                                    <thead role="rowgroup">
                                    <tr role="row">
                                        <th role="cell" style="text-align: left">Name</th>
                                        <th role="cell">Gültig bis</th>
                                        <th role="cell">Aktionen</th>
                                    </tr>
                                    </thead>
                                    <tbody role="rowgroup">
                                    @foreach($licenses as $license)
                                        <tr>
                                            <td role="cell" data-label="Name"><a href="{{ route("inventory.license.show", $license->id) }}" class="adminDashboardHyperLinks">{{ $license->name }}</a></td>
                                            <td role="cell" data-label="Gültig bis">{{ Time::formatDate($license->expirationdate, 'd.m.Y') }}</td>
                                            <td role="cell" data-label="Aktionen">
                                                <div class="actionsDiv">

                                                    <form action="{{ route('licenseassign.destroy', $license->licenserentalid) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Sind Sie sicher dass sie die Lizenz vom Gegenstand entfernen möchten')" title="Entziehen">
                                                            @include("component.icon.unassignLicense")
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endempty
                </div>

            </div>
        </div>

    </div>

@endsection
