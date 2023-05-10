@extends("layout.app")

@section("content")

    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <x-dashboard-navigation
                headline="{{ $pageTitle }}"
                searchPlaceholder="Lizenz suchen"
                createRoute="inventory.license.create"
                createTitle="Lizenz erstellen"
            ></x-dashboard-navigation>
            @empty(!$licenses)
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                                <tr role="row">
                                    <th role="cell">Lizenz</th>
                                    <th role="cell">Produktschlüssel</th>
                                    <th role="cell">Ablaufdatum</th>
                                    <th role="cell">Total</th>
                                    <th role="cell">Verfügbar</th>
                                    <th role="cell">Aktionen</th>
                                </tr>
                            </thead>
                            <tbody role="rowgroup">
                            @foreach($licenses as $license)
                                <tr role="row">
                                    <td role="cell" data-label="Lizenz"><a href="{{ route("inventory.license.show", $license->id) }}" class="ticketDashboardHyperLinks">{{ $license->name }}</a></td>
                                    <td role="cell" data-label="Produktschlüssel"><span>{{ $license->licensekey }}</span></td>
                                    <td role="cell" data-label="Ablaufdatum"><span>{{ Time::formatDate($license->expirationdate, 'd.m.Y') }}</span></td>
                                    <td role="cell" data-label="Total"><span>{{ $license->total }}</span></td>
                                    <td role="cell" data-label="Verfügbar"><span>{{ $license->total - $license->rentals->count() }}</span></td>
                                    <td role="cell" data-label="Aktionen">
                                        <div class="actionsDiv">
                                            @if(Rights::checkIfAnyRights(['modifylicense', 'fullaccess']))
                                                    <a tooltip="Bearbeiten" flow="left" href="{{ route("inventory.license.edit", $license->id) }}" title="bearbeiten">
                                                        @include("component.icon.edit")
                                                    </a>
                                             @endif
                                            @if(Rights::checkIfAnyRights(['deletelicense', 'fullaccess']))
                                                <button tooltip="Löschen" flow="left" form="delete{{ $license->id }}" onclick="return confirm('Sind Sie sicher dass sie die Lizenz {{ $license->name }}  löschen möchten')">
                                                    @include("component.icon.delete")
                                                </button>
                                            @endif
                                            @if($license->total - $license->rentals->count() > 0)
                                                @if(Rights::checkIfAnyRights(['fullaccess']))
                                                    <a tooltip="Zuweisen" flow="left" href="{{ route('inventory.license.assign', $license->id) }}">
                                                        @include("component.icon.assignLicense")
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($licenses as $content)
                                <div class="hidden">
                                    @if(Rights::checkIfAnyRights(['fullaccess', 'deletelicense']))
                                        <form id="delete{{ $content->id }}" action="{{ route('license.destroy', $content->id) }}" method="post">
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


