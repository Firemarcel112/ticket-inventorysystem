@extends("layout.app")

@section("content")

    <h1 class="pb-4 text-2xl sm:text-3xl md:text-4xl 2xl:text-5xl">{{ $pageTitle }}</span></h1>

    <div class="bg-gray-50 dark:bg-slate-600 w-full flex  border-b-[1px] border-black">
        <div id="licenseInfoLink" class="hover:font-extrabold font-extrabold block w-24 h-12 flex items-center bg-gray-100 dark:bg-slate-500 border-solid border-t-4 border-t-blue-500 border-black hover:cursor-pointer" onclick="toggleLicense('licenseInfo', 'licenseUsage')">
            <span class="mx-auto text-black dark:text-white">Info</span>
        </div>
        <div id="licenseUsageLink"class="hover:font-extrabold font-bold block w-32 h-12 flex items-center bg-gray-100 dark:bg-slate-500 border-solid border-t-4 border-t-transparent border-transparent hover:cursor-pointer" onclick="toggleLicense('licenseUsage', 'licenseInfo')">
            <span class="mx-auto text-black dark:text-white">Gegenstände</span>
        </div>
    </div>
    <div>
        <div class="p-4 bg-gray-50 shadow-lg dark:bg-slate-600 block" id="licenseInfo">
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">ID</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $user->id }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Benutzername</p>
                <p class="inline-block w-6/12 sm:w-8/12">{{ $user->username }}</p>
            </div>
            <div class="flex border border-0 border-b-2 border-gray-400 pb-2">
                <p class="font-bold inline-block w-6/12 sm:w-4/12">Email</p>
                <a href="mailto:{{ $user->email }}" class="inline-block w-6/12 sm:w-8/12 ticketDashboardHyperLinks">{{ $user->email }}</a>
            </div>
            @php $i = 0; @endphp
            @foreach($groups as $group)
                @if($i == 0)
                    <div class="flex pb-2">
                        <p class="font-bold inline-block w-6/12 sm:w-4/12">Gruppen</p>
                        <p class="inline-block w-6/12 sm:w-8/12">{{ $group->gruppe }}</p>
                    </div>
                    @php $i++; @endphp
                @else
                    <div class="flex pb-2">
                        <p class="font-bold inline-block w-6/12 sm:w-4/12"></p>
                        <p class="inline-block w-6/12 sm:w-8/12 ml-6/12 sm:ml-8/12">{{ $group->gruppe }}</p>
                    </div>
                @endif
            @endforeach
        </div>

    </div>

    <div class="p-4 bg-gray-50 dark:bg-slate-600 hidden shadow-lg" id="licenseUsage">
        <div>
            @empty(!$assets->first())
                <div class="bg-light dark:bg-slate-900 font-extrabold"><p class="pl-12">Geräte:</p></div>
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                                <tr role="row">
                                    <th role="cell">ID</th>
                                    <th role="cell" style="text-align: left">Gegenstand</th>
                                    <th role="cell">Aktionen</th>
                                </tr>
                            </thead>
                            <tbody role="rowgroup">
                                @foreach($assets as $asset)
                                    <tr role="row">
                                        <td role="cell" data-label="ID">{{ $asset->asset_id }}</td>
                                        <td role="cell" data-label="Name"><a href="{{ route("inventory.assets.info", $asset->asset_id) }}" class="adminDashboardHyperLinks">{{ $asset->asset->model->name }} {{ $asset->asset->manufacturer->name }}</a></td>
                                        <td role="cell" data-label="Aktionen">
                                            <div class="actionsDiv">
                                                <form action="{{ route('assetpeople.destroy', $asset->asset_id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button onclick="return confirm('Sind Sie sicher dass sie das Gerät vom Benutzer entfernen möchten')" title="Gerät Entfernen">
                                                        @include("component.icon.unassign")
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

@endsection
