@extends("layout.app")

@section("content")

    <div class="inventoryDboardWrapper">
        @if($tickets->count() < 1)
            @include('component.message.information', ['message' => Config::NOTICKETSEXIST])
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
                                <th role="cell">Erstellt</th>
                                <th role="cell">Letzte Aktivität</th>
                                <th role="cell">Status</th>
                                <th role="cell">Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr role="row">
                                    <td role="cell" data-label="Titel"><a
                                            href="{{ route('ticket.post', $ticket->id) }}"
                                            class="ticketDashboardHyperLinks">{{ $ticket->headline }}</a></td>
                                    <td role="cell" data-label="Kategorien">
                                        <span>{{ $ticket->category->name  }}</span></td>
                                    <td role="cell" data-label="Autor"><span>{{ $ticket->user->username }}</span></td>
                                    <td role="cell" data-label="Zugeteilt"><span>{{ $ticket->assigner->username }}<br>{{ $ticket->group->name }}</span>
                                    </td>
                                    <td role="cell" data-label="Erstellt"><span>{{ Time::formatDate($ticket->created_at, 'd.m.Y | H:i') . ' Uhr'  }}</span></td>
                                    <td role="cell" data-label="Letzte Aktivität"><span>{{ Time::formatDate($ticket->updated_at, 'd.m.Y | H:i') . ' Uhr'  }}</span></td>
                                    <td role="cell" data-label="Status">
                                        <div class="px-2 rounded-xl font-bold"
                                             style="background-color: {{ $ticket->status->color }};">
                                            <span
                                                class="text-center dark:text-black text-black">{{ $ticket->status->name }}</span>
                                        </div>
                                    </td>
                                    <td role="cell" data-label="Aktionen">
                                        @if(Rights::checkIfAnyRights(['ticketaccess', 'modifyticket', 'closeticket']))
                                            <div class="actionsDiv">
                                                @if(Rights::checkIfAnyRights(['modifyticket', 'ticketaccess']))
                                                    <a tooltip="Bearbeiten" flow="left"
                                                       href="{{ route("ticket.post.edit", $ticket->id) }}">
                                                        @include("component.icon.edit")
                                                    </a>
                                                @endif
                                                @if(Rights::checkIfAnyRights(['closeticket', 'ticketaccess']))
                                                    @if($ticket->status->id == Config::STATUSCLOSED)
                                                        <form action="{{ route('ticketopen', $ticket->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('PATCH')

                                                            <button tooltip="Ticket öffnen" flow="left"
                                                                    class="flex items-center justify-center text-xl font-medium text-gray-900">
                                                                @include("component.icon.ticketopen")
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('ticketclose', $ticket->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button tooltip="Ticket schließen" flow="left"
                                                                    onclick="return confirm('Ticket wirklich schließen?')"
                                                                    class="flex items-center justify-center text-xl font-medium text-gray-900">
                                                                @include("component.icon.ticketclose")
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif

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
