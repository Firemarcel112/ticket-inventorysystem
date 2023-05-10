@extends("layout.app")

@section("content")

    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <x-dashboard-navigation
                headline="{{ $pageTitle }}"
                searchPlaceholder="Abteilungen suchen"
                createRoute="inventory.department.create"
                createTitle="Abteilung erstellen"
            ></x-dashboard-navigation>
            @empty(!$departments)
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                                <tr role="row">
                                    <th role="cell">Abteilungsname</th>
                                    <th role="cell">Abteilungsfarbe</th>
                                    <th role="cell">Aktionen</th>
                                </tr>
                            </thead>
                            <tbody role="rowgroup">
                                @foreach($departments as $content)
                                    <tr role="row">
                                        <td role="cell" data-label="Abteilungsname"><span>{{ $content->name }}</span></td>
                                        <td role="cell" data-label="Abteilungsfarbe"><div title="{{ $content->color }}" class="tableStatus" style="background-color: {{ $content["color"] }}" onclick="copyColor('{{ $content->color }}', '{{$content->id}}')"></div></td>
                                        <td role="cell" data-label="Aktionen">
                                            <div class="actionsDiv">
                                                @if (Rights::checkIfAnyRights(['modifydepartment', 'fullaccess']))
                                                    <a tooltip="Bearbeiten" flow="left" href="{{ route("inventory.department.edit", $content->id) }}" title="bearbeiten">
                                                        @include("component.icon.edit")
                                                    </a>
                                                @endif
                                                @if (Rights::checkIfAnyRights(['deletedepartment', 'fullaccess']))
                                                    <button tooltip="Löschen" flow="left" form="delete{{ $content->id }}" onclick="return confirm('Sind Sie sicher dass sie die Abteiliung {{ $content["name"] }} löschen möchten')" title="löschen">
                                                        @include("component.icon.delete")
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($departments as $content)
                                    <div class="hidden">
                                        @if(Rights::checkIfAnyRights(['fullaccess', 'deletedepartment']))
                                            <form id="delete{{ $content->id }}" action="{{ route('inventorydepartment.destroy', $content->id) }}" method="post">
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
