@extends("layout.app")

@section("content")

    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <x-dashboard-navigation
                headline="{{ $pageTitle }}"
                searchPlaceholder="Status suchen"
                createRoute="inventory.status.create"
                createTitle="Status erstellen"
            ></x-dashboard-navigation>
            <div>
            @empty(!$statuses)
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                                <tr role="row">
                                    <th role="cell">Statusname</th>
                                    <th role="cell">Statusfarbe</th>
                                    <th role="cell">Aktionen</th>
                                </tr>
                            </thead>
                            <tbody role="rowgroup">
                                @foreach($statuses as $content)
                                    <tr role="row">
                                        <td role="cell" data-label="Statusname"><span>{{ $content['name'] }}</span></td>
                                        <td role="cell" data-label="Statusfarbe"><div title="{{ $content['color'] }}" class="tableStatus" style="background-color: {{ $content["color"] }}" onclick="copyColor('{{ $content['color'] }}', '{{$content['id']}}')"></div></td>
                                        <td role="cell" data-label="Aktionen">
                                            <div class="actionsDiv">
                                                @if (Rights::checkIfAnyRights(['modifystatus', 'fullaccess']))
                                                    <a tooltip="Bearbeiten" flow="left" href="{{ route("inventory.status.edit", $content["id"]) }}" title="bearbeiten">
                                                        @include("component.icon.edit")
                                                    </a>
                                                @endif
                                                @if (Rights::checkIfAnyRights(['deletestatus', 'fullaccess']))
                                                    <button tooltip="Löschen" flow="left" form="delete{{ $content->id }}" onclick="return confirm('Sind Sie sicher dass sie den Status {{ $content["name"] }} löschen möchten')" title="löschen">
                                                        @include("component.icon.delete")
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($statuses as $content)
                                    <div class="hidden">
                                        @if(Rights::checkIfAnyRights(['fullaccess', 'deletestatus']))
                                            <form id="delete{{ $content->id }}" action="{{ route('inventorystatus.destroy', $content->id) }}" method="post">
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
    </div>

@endsection
