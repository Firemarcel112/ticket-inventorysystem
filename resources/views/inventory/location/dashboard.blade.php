@extends("layout.app")


@section("content")

    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <x-dashboard-navigation
                headline="{{ $pageTitle }}"
                searchPlaceholder="Orte suchen"
                createRoute="inventory.location.create"
                createTitle="Ort erstellen"
            ></x-dashboard-navigation>

            @empty(!$locations)
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                            <tr role="row">
                                <th role="cell">Raum</th>
                                <th role="cell">Verstauraum</th>
                                <th role="cell">Adresse</th>
                                <th role="cell">Aktionen</th>
                            </tr>
                            </thead>
                            <tbody role="rowgroup">
                            @foreach($locations as $location)
                                <tr role="row">
                                    <td role="cell" data-label="Raum"><span>{{ $location->room }}</span></td>
                                    <td role="cell" data-label="Verstauraum"><span>{{ $location->storageplace }}</span></td>
                                    <td role="cell" data-label="Adresse"><span>{{ $location->street }} {{ $location->postalcode }}</span></td>
                                    <td role="cell" data-label="Aktionen">
                                        <div class="actionsDiv">
                                            @if(Rights::checkIfAnyRights(['modifylocation', 'fullaccess']))
                                                <a tooltip="Bearbeiten" flow="left" href="{{ route("inventory.location.edit", $location->id) }}" title="bearbeiten">
                                                    @include("component.icon.edit")
                                                </a>
                                            @endif
                                            @if(Rights::checkIfAnyRights(['deletelocation', 'fullaccess']))
                                                <button tooltip="Löschen" flow="left" form="delete{{ $location->id }}" onclick="return confirm('Sind Sie sicher dass sie den Ort löschen möchten')" title="löschen">
                                                    @include("component.icon.delete")
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($locations as $content)
                                <div class="hidden">
                                    @if(Rights::checkIfAnyRights(['fullaccess', 'deletelocation']))
                                        <form id="delete{{ $content->id }}" action="{{ route('inventorylocation.destroy', $content->id) }}" method="post">
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
