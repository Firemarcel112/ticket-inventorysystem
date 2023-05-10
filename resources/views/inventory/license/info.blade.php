@extends("layout.app")

@section("content")

    <h1 class="pb-4 text-2xl sm:text-3xl md:text-4xl 2xl:text-5xl">{{ $pageTitle }}</span></h1>

    <div class="bg-gray-50 dark:bg-slate-600 w-full flex  border-b-[1px] border-black">
        <div id="licenseInfoLink" class="hover:font-extrabold font-extrabold block w-24 h-12 flex items-center bg-gray-100 dark:bg-slate-500 border-solid border-t-4 border-t-blue-500 border-black hover:cursor-pointer" onclick="toggleLicense('licenseInfo', 'licenseUsage')">
            <span class="mx-auto text-black dark:text-white">Info</span>
        </div>
        <div id="licenseUsageLink"class="hover:font-extrabold font-bold block w-32 h-12 flex items-center bg-gray-100 dark:bg-slate-500 border-solid border-t-4 border-t-transparent border-transparent hover:cursor-pointer" onclick="toggleLicense('licenseUsage', 'licenseInfo')">
            <span class="mx-auto text-black dark:text-white">Asset</span>
        </div>
    </div>
    <div>
        <div class="p-4 bg-gray-50 shadow-lg dark:bg-slate-600 block" id="licenseInfo">
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">ID</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $license->id }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Lizenzname</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $license->name }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Produktschlüssel</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $license->licensekey }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Total</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $license->total }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Verfügbar</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $license->total - $license->rentals->count() }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Ablaufdatum</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ Time::formatDate($license->expirationdate, 'd.m.Y') }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Hersteller</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $license->manufacturer->name }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Kaufdatum</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ Time::formatDate($license['purchasedate'], 'd.m.Y') }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Link zum erneuten Kaufen</p>
                <a href="//{{$license['purchaselink']}}"class="inline-block w-6/12 sm:w-8/12 ticketDashboardHyperLinks">Link zum Kaufen</a>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Kaufpreis</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{$license['purchasecost']}}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Monatspreis</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{$license['monthprice']}}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Laufzeit in Monaten</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{$license['duration']}}</p>
            </div>
            <div class="flex pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Bestellnummer</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{$license['ordernumber']}}</p>
            </div>
        </div>

        <div class="p-4 bg-gray-50 dark:bg-slate-600 hidden shadow-lg" id="licenseUsage">
            <div>
                @empty(!$licenseRentalAssets)
                    <div class="bg-light dark:bg-slate-900 font-extrabold"><p class="pl-12">Geräte:</p></div>
                    <div class="overflow-x-auto">
                        <div class="customTableWrapper">
                            <table class="w-full" role="table">
                                <thead role="rowgroup">
                                <tr role="row">
                                    <th role="cell">ID</th>
                                    <th role="cell" style="text-align: left">Name</th>
                                    <th role="cell">Aktionen</th>
                                </tr>
                                </thead>
                                <tbody role="rowgroup">
                                @for($i = 0; $i < count($licenseRentalAssets); $i++)
                                    <tr role="row">
                                        <td role="cell" data-label="ID">{{ $licenseRentalAssets[$i]->id }}</td>
                                        <td role="cell" data-label="Name"><a href="{{ route("inventory.assets.info", $licenseRentalAssets[$i]->id) }}" class="adminDashboardHyperLinks">{{ $licenseRentalAssets[$i]->model->name }} {{ $licenseRentalAssets[$i]->manufacturer->name ?? 'Custom' }}</a></td>
                                        <td role="cell" data-label="Aktionen">
                                            <div class="actionsDiv">
                                                <form action="{{ route('licenseassign.destroy', $rentalids[$i]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Sind Sie sicher dass sie die Lizenz vom Gegenstand entfernen möchten')" title="Lizenz Entfernen">
                                                        @include("component.icon.unassignLicense")
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endempty

            </div>
        </div>


    </div>

@endsection
