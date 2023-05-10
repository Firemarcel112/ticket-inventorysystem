@extends("layout.app")

@section("content")
    <div id="usertickets">
        <div class="sm:flex sm:pb-0 pb-5 w-full justify-between items-center">
            <h1>{{ $pageTitle }} </h1>
            @if($tickets->count() < Config::MAXTICKETAMOUNTS)
                <x-button
                    btnClasses="h-fit"
                    type="1"
                    content="Erstellen"
                    :link="route('ticket.create')"
                ></x-button>
            @endif
        </div>

        <div id="box">
            <div id="titleBox">
                <h2>Ihre geöffneten Tickets:</h2>
                <p id="ticketAmount">{{ $tickets->count() }}/{{ Config::MAXTICKETAMOUNTS }}</p>
            </div>

            <div class="">
                @if($tickets->count() < 1)
                    @include('component.message.information', ['message' => Config::NOTICKETSCREATED])
                @else
                    @foreach($tickets as $ticket)

                        <div class="ticket">
                            <div class="box">
                                <div class="flex items-center">
                                    <div>
                                        <p class="text break-all">
                                            <a class="text" href="{{ route('ticket.post', $ticket->id) }}">{{ $ticket->headline }}</a>
                                            <br><span>vom {{ Time::formatDate($ticket->created_at, 'd.m.Y | H:i') . ' Uhr'  }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-2 flex sm:mt-0 sm:ml-auto">
                                    <div class="grid grid-cols-2 gap-4 md:gap-4 lg:gap-8 h-full items-center">
                                        <form action="{{ route('ticketclose', $ticket->id)  }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <x-button
                                                content="Schließen"
                                                colorType="danger"
                                                jsConfirm="Möchten Sie das Ticket wirklich schließen?"
                                            ></x-button>
                                        </form>
                                        <x-button
                                            type="1"
                                            content="Ansehen"
                                            :link="route('ticket.post', $ticket->id)"
                                        ></x-button>
                                    </div>
                                </div>
                            </div>
                            <hr class="w-full mb-6 mt-2 bg-gray-500 dark:bg-white h-1">
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>

@endsection
