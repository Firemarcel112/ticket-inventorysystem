@extends("layout.app")

@section("content")

    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <x-dashboard-navigation
                headline="{{ $pageTitle }}"
                searchPlaceholder="Hersteller suchen"
                createRoute="inventory.manufacturer.create"
                createTitle="Hersteller erstellen"
            ></x-dashboard-navigation>

            @empty(!$manufacturers)
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                            <tr role="row">
                                <th role="cell">Hersteller</th>
                                <th role="cell">Adresse</th>
                                <th role="cell">E-Mail</th>
                                <th role="cell">Webseite</th>
                                <th role="cell">Aktionen</th>
                            </tr>
                            </thead>
                            <tbody role="rowgroup">
                            @foreach($manufacturers as $manufacturer)
                                <tr role="row">
                                    <td role="cell" data-label="Hersteller"><span>{{ $manufacturer->name }}</span></td>
                                    <td role="cell" data-label="Adresse"><span>{{ $manufacturer->street }} {{ $manufacturer->postalcode }}</span></td>
                                    <td role="cell" data-label="Email"><span>{{ $manufacturer->email }}</span></td>
                                    <td role="cell" data-label="Webseite">
                                        @if($manufacturer->website != "#" && $manufacturer->website != "")
                                            <a href="{{ $manufacturer->website }}">Zur Webseite</a>
                                        @endif
                                    </td>
                                    <td role="cell" data-label="Aktionen">
                                        <div class="actionsDiv">
                                            @if(Rights::checkIfAnyRights(['modifymanufacturer', 'fullaccess']))
                                                <a tooltip="Bearbeiten" flow="left" href="{{ route("inventory.manufacturer.edit", $manufacturer->id) }}" title="bearbeiten">
                                                    @include("component.icon.edit")
                                                </a>
                                            @endif

                                            @if(Rights::checkIfAnyRights(['deletemanufacturer', 'fullaccess']))
                                                <button tooltip="Löschen" flow="left" form="delete{{ $manufacturer->id }}" onclick="return confirm('Sind Sie sicher dass sie Modell {{ $manufacturer->name }} löschen möchten')"
                                                    title="löschen">
                                                    @include("component.icon.delete")
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($manufacturers as $content)
                                <div class="hidden">
                                    @if(Rights::checkIfAnyRights(['fullaccess', 'deletemanufacturer']))
                                        <form id="delete{{ $content->id }}" action="{{ route('inventorymanufacturer.destroy', $content->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            @endempty

        </div>
    </div>

@endsection
