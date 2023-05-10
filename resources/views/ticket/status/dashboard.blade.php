@extends('layout.app')

@section('content')

    <div class="inventoryDboardWrapper">
        <div class="w-full px- h-fit pb-[40px]">
            <x-dashboard-navigation
                headline="{{ $pageTitle }}"
                searchPlaceholder="Status suchen"
                createRoute="ticket.status.create"
                createTitle="Status erstellen"
            ></x-dashboard-navigation>
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
                            @foreach($statuses as $status)
                                <tr role="row">
                                    <td role="cell" data-label="Name"><span>{{ $status->name }}</span></td>
                                    <td role="cell" data-label="Statusfarbe">
                                        <div id="colorID{{ $status->id }}" title="{{ $status->color }}"
                                             class="tableStatus" style="background-color: {{ $status->color }}"
                                             onclick="copyColor('{{ $status->color }}', '{{ $status->id }}')"></div>
                                    </td>
                                    <td role="cell" data-label="Aktionen">
                                        <div class="actionsDiv">
                                            @if(!in_array($status->id, Config::SUPERTICKETSTATUS))
                                                <a tooltip="Bearbeiten" flow="left"
                                                   href="{{ route("ticket.status.edit", $status->id) }}"
                                                   title="bearbeiten">
                                                    @include("component.icon.edit")
                                                </a>
                                                @if(Rights::checkIfAnyRights(['ticketaccess', 'deleteticketstatus']))
                                                    <button tooltip="Löschen" flow="left"
                                                            form="delete{{ $status['id'] }}"
                                                            onclick="return confirm('Sind Sie sicher dass sie den Status: {{ $status->name }} löschen möchten')"
                                                            title="löschen">
                                                        @include("component.icon.delete")
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($statuses as $content)
                                <div class="hidden">
                                    @if(Rights::checkIfAnyRights(['ticketaccess', 'deleteticketstatus']))
                                        <form id="delete{{ $content->id }}"
                                              action="{{ route('ticketstatus.destroy', $content->id) }}" method="post">
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
