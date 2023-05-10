@extends("layout.app")


@section("content")
    <h1 class="mb-16 mt-16">{{ $pageTitle }}</h1>
    <div>
        <div class="w-full px- h-full pb-[40px]">
            <div>
                <h2 class="adminDashboardH2">Kürzliche Aktivitäten: Tickets</h2>
            </div>
            <div>
                <div class="duoTable">
                    <div class="customDuoTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                            <tr role="row">
                                <th role="cell">Status</th>
                                <th role="cell">Titel</th>
                                <th role="cell">Benutzer</th>
                                <th role="cell">Datum</th>
                            </tr>
                            </thead>
                            <tbody role="rowgroup">
                            @foreach($ticketLogs as $log)
                                @php $created = Time::formatDate($log['created_at'], 'd.m.Y | H:i') . ' Uhr'; @endphp
                                <tr>
                                    <td role="cell" data-label="Status"><span>{{ $log['action'] }}</span></td>
                                    <td role="cell" data-label="Titel"><span>{{ $log['object'] }}</span></td>
                                    <td role="cell" data-label="Benutzer"><span>{{ $log['username'] }}</span></td>
                                    <td role="cell" data-label="Datum"><span>{{ $created }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="adminDashboardButton">
                    <div class="w-full h-10">
                        <a href="{{ route("ticket.dashboard") }}" class="w-full h-full p-0.5 flex items-center justify-center text-xl font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 hover:text-white dark:text-white">
                    <span class="w-full h-full text-base md:text-xl flex justify-center items-center transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Alle Ansehen
                    </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full px- h-full pb-[40px]">
            <div>
                <h2 class="adminDashboardH2">Kürzliche Aktivitäten: Inventarisierung</h2>
            </div>
            <div>
                <div class="duoTable">
                    <div class="customDuoTableWrapper">
                        <table class="w-full" role="table">
                            <thead role="rowgroup">
                            <tr role="row">
                                <th role="cell">Status</th>
                                <th role="cell">Item</th>
                                <th role="cell">Benutzer</th>
                                <th role="cell">Datum</th>
                            </tr>
                            </thead>
                            <tbody role="rowgroup">
                            @foreach($inventoryLogs as $log)
                                @php $created = Time::formatDate($log['created_at'], 'd.m.Y | H:i') . ' Uhr'; @endphp
                                <tr>
                                    <td role="cell" data-label="Status"><span>{{ $log['action'] }}</span></td>
                                    <td role="cell" data-label="Titel"><span>{{ $log['object'] }}</span></td>
                                    <td role="cell" data-label="Benutzer"><span>{{ $log['username'] }}</span></td>
                                    <td role="cell" data-label="Datum"><span>{{ $created }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="adminDashboardButton">
                    <div class="w-full h-10">
                        <a href="{{ route("inventory.dashboard") }}" class="w-full h-full p-0.5 flex items-center justify-center text-xl font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 hover:text-white dark:text-white">
                    <span class="w-full h-full text-base md:text-xl flex justify-center items-center transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Alle Ansehen
                    </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
