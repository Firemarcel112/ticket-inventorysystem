@extends("layout.app")

@section("content")

    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <x-dashboard-navigation
                headline="{{ $pageTitle }}"
                searchPlaceholder="Modelle suchen"
                createRoute="inventory.model.create"
                createTitle="Modell erstellen"
            ></x-dashboard-navigation>
            @empty(!$models)
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                            <tr role="row">
                                <th role="cell">Modellname</th>
                                <th role="cell">Webseite</th>
                                <th role="cell">Aktionen</th>
                            </tr>
                            </thead>
                            <tbody role="rowgroup">
                                @foreach($models as $model)
                                    @continue($model->id === 1)
                                    <tr role="row">
                                        <td role="cell" data-label="Modellname"><span>{{ $model->name }}</span></td>
                                        <td role="cell" data-label="Webseite">
                                            @if($model->website != "#" && $model->website != "")
                                                <a href="{{ $model->website }}">Zur Webseite</a>
                                            @endif
                                        </td>
                                        <td role="cell" data-label="Aktionen">
                                            <div class="actionsDiv">
                                                @if (Rights::checkIfAnyRights(['modifymodel', 'fullaccess']))
                                                    <a tooltip="Bearbeiten" flow="left" href="{{ route("inventory.model.edit", $model->id) }}" title="bearbeiten">
                                                        @include("component.icon.edit")
                                                    </a>
                                                @endif
                                                @if (Rights::checkIfAnyRights(['deletemodel', 'fullaccess']))
                                                    <button tooltip="Löschen" flow="left" form="delete{{ $model->id }}" onclick="return confirm('Sind Sie sicher dass Sie das Modell {{ $model["name"] }} löschen möchten')" title="löschen">
                                                        @include("component.icon.delete")
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($models as $content)
                                    <div class="hidden">
                                        @if(Rights::checkIfAnyRights(['fullaccess', 'deletemodel']))
                                            <form id="delete{{ $content->id }}" action="{{ route('inventorymodel.destroy', $content->id) }}" method="post">
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
            @endif
        </div>
    </div>

@endsection
