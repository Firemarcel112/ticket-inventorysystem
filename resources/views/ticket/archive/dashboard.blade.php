@extends("layout.app")

@section("content")

    <div class="inventoryDboardWrapper">
        @if($tickets->count() < 1)
            @include('component.message.information', ['message' => Config::NOARCHIVEDTICKETS])
        @else
            <div class="w-full px- h-fit pb-[40px]">
                <x-dashboard-navigation
                    headline="{{ $pageTitle }}"
                    searchPlaceholder="Ticket suchen"
                    create="0"
                ></x-dashboard-navigation>
                <div class="overflow-x-auto">
                    <div class="customTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                            <tr role="row">
                                <th role="cell">Titel</th>
                                <th role="cell">Kategorie</th>
                                <th role="cell">Autor</th>
                                <th role="cell">Zugeteilt</th>
                                <th role="cell">Archivert</th>
                                <th role="cell">Letzte Aktivität</th>
                                <th role="cell">Aktionen</th>
                            </tr>
                            </thead>
                            <tbody role="rowgroup">
                            @foreach($tickets as $ticket)
                                <tr role="row">
                                    <td role="cell" data-label="Titel"><a
                                            href="{{ route('ticket.archive.post', $ticket->id) }}"
                                            class="ticketDashboardHyperLinks">{{ $ticket->headline }}</a></td>
                                    <td role="cell" data-label="Kategorien"><span>{{ $ticket->category }}</span></td>
                                    <td role="cell" data-label="Autor"><span>{{ $ticket->username }}</span></td>
                                    <td role="cell" data-label="Zugeteilt"><span>{{ $ticket->assigned_to }}</span></td>
                                    <td role="cell" data-label="Erstellt">
                                        <span>{{ Time::formatDate($ticket->created_at, 'd.m.Y | H:i') . ' Uhr'  }}</span>
                                    </td>
                                    <td role="cell" data-label="Letzte Aktivität">
                                        <span>{{ Time::formatDate($ticket->updated_at, 'd.m.Y | H:i') . ' Uhr'  }}</span>
                                    </td>
                                    <td role="cell" data-label="Aktionen">
                                        @if(Rights::checkIfAnyRights(['deletearchive']))
                                            <div class="actionsDiv">
                                                <form action="{{ route('ticketarchive.destroy', $ticket->id) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button tooltip="Löschen" flow="left"
                                                            onclick="return confirm('Sind Sie sicher dass sie das Ticket {{ $ticket->headline }} löschen möchten')"
                                                            title="löschen">
                                                        @include("component.icon.delete")
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
