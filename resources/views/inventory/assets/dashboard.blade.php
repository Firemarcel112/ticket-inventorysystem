@extends("layout.app")

@section("content")
    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
             <x-dashboard-navigation
                 headline="{{ $pageTitle }}"
                 searchPlaceholder="Gegenstände suchen"
                 createRoute="inventory.assets.create"
                 createTitle="Gegenstände erstellen"
                 qrcode="1"
                 delete="1"
             ></x-dashboard-navigation>

            @if(!empty($assets))
                <form id="multipleForm" target="_blank" action="{{ route("qrcodePost") }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST" class="hidden" id="formMETHOD">
                    <div class="overflow-x-scroll">
                        <div class="customTableWrapper">
                            <table class="w-full" role="table">
                                <thead role="rowgroup">
                                <tr role="row">
                                    <th role="cell"></th>
                                    <th role="cell">ID</th>
                                    <th role="cell">Name</th>
                                    <th role="cell">Kategorie</th>
                                    <th role="cell">Status</th>
                                    <th role="cell">Ort</th>
                                    <th role="cell">Zugestellt</th>
                                    <th role="cell">Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assets as $asset)
                                    @if($asset->model->id == 1) @php $asset->model->name = $asset->customname @endphp @endif
                                    <tr role="row">
                                        <td role="cell" data-label="" class="h-full hidden md:block" class="qrTable"><input type="checkbox" name="id[]" value="{{ $asset->id }}"></td>
                                        <td role="cell" data-label="ID">
                                            <a href="{{ route("inventory.assets.info", $asset->id) }}" class="adminDashboardHyperLinks"><span>{{ $asset->id }}</span></a>
                                        </td>
                                        <td role="cell" data-label="Name">
                                            <a href="{{ route("inventory.assets.info", $asset->id ) }}" class="adminDashboardHyperLinks"><span>{{ $asset->manufacturer->name }} {{ $asset->model->name }}</span></a>
                                        </td>

                                        <td role="cell" data-label="Kategorie"><span>{{ $asset->category->name }}</span></td>
                                        <td role="cell" data-label="Status">
                                            <div class="flex align-items items-center gap-2">
                                                <div style="background-color: {{ $asset->status->color }};"
                                                     class="w-4 h-4 rounded-lg"></div>
                                                <p>{{ $asset->status->name }}</p></div>
                                        </td>
                                        <td role="cell" data-label="Ort"><span>{{ $asset->location->street }}@if($asset->location->room != ""){{ ", " }}@endif{{ $asset->location->room }}</span></td>
                                        <td role="cell" data-label="Zugestellt"><span>@isset($asset->rental->user->username){{ $asset->rental->user->username }}@endisset</span></td>

                                        <td role="cell" data-label="Aktionen">
                                            <div class="actionsDiv">
                                                @if(Rights::checkIfAnyRights(['fullaccess', 'modifyasset']))
                                                    <a tooltip="Bearbeiten" flow="left" href="{{ route("inventory.assets.edit", $asset["id"]) }}" title="bearbeiten">
                                                        @include("component.icon.edit")
                                                    </a>
                                                @endif
                                                @if(Rights::checkIfAnyRights(['fullaccess', 'deleteasset']))
                                                    <button tooltip="Löschen" flow="left" form="deleteAsset{{ $asset['id'] }}"onclick="return confirm('Sind Sie sicher dass sie das Asset löschen möchten')"
                                                        title="löschen">
                                                        @include("component.icon.delete")
                                                    </button>
                                                @endif
                                                @if(Rights::checkIfAnyRights(['fullaccess']))
                                                    @isset($asset->rental->user->username)
                                                        <button tooltip="Entziehen" flow="left" form="assetassign{{ $asset['id'] }}"title="entziehen">
                                                            @include("component.icon.unassign")
                                                        </button>
                                                    @else
                                                        <a tooltip="Zuweisen" flow="left" href="{{ route('inventory.assets.assign', $asset['id']) }}" title="zuweisen">
                                                            @include("component.icon.assign")
                                                        </a>
                                                    @endisset
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </form>
                @foreach($assets as $asset)
                    <div class="hidden">
                        @if(Rights::checkIfAnyRights(['fullaccess', 'deleteasset']))
                            <form id="deleteAsset{{ $asset['id'] }}" action="{{ route('assets.destroy', $asset['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                        @if(Rights::checkIfAnyRights(['fullaccess']))
                            <form id="assetassign{{ $asset['id'] }}" action="{{ route('assetassign.destroy', $asset['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    </div>
                @endforeach
            @endif

        </div>
    </div>
    <script>
        function changeFormRoute(action) {
            let form = document.querySelector('#multipleForm');
            let formMETHOD = document.querySelector('#formMETHOD');
            @if(count($assets) > 0)
                if(action == 'delete') {
                    form.action = "{{ route('assets.destroy', $assets->random()->id) }}";
                    formMETHOD.value = 'DELETE';
                    form.target = '_self'
                }
                else if(action == 'qrcode') {
                    form.action = "{{ route("qrcodePost") }}";
                    formMETHOD.value = 'POST';
                    form.target = '_blank'
                }
                form.submit();
            @endempty
        }
    </script>
@endsection


