@extends('layout.app')

@section('outerApp')
    <div id="imageBox" class="hidden" onclick="scaleImage(event)">
        <img src="">
    </div>
@endsection 

@section('content')

    <div id="titelTicket" class="w-[95%] m-auto md:w-[80%] mb-12">
        <h1>{{ $pageTitle }}</h1>
        <p class="text-right mb-2">{{ $ticket->username }}, {{ Time::formatDate($ticket->created_at, 'd.m.Y | H:i') . ' Uhr'  }}</p>
    </div>

    <div id="descriptionTicket" style="hyphens: auto" class="break-words w-[80%] md:w-[60%] m-auto mb-4 p-2 bg-gray-200 dark:bg-gray-700 border border-white">
        <p class="text-base sm:text-lg md:text-2xl">{{ $ticket->content }}</p>
    </div>
    <hr class="mb-8 border-t-4 border-red-500 dark:border-white w-[80%] m-auto">


    <div id="messageTicket" class="flex flex-col">
        @php $i = 0; @endphp
        @foreach($ticket->messages as $ticketMessage)
            <div class="{{ $ticket->username == $ticketMessage->username ? 'messageUser' : 'messageAdmin' }} break-all">
                <p style="hyphens: auto">{{ $ticketMessage->message }}</p>
                <div class="flex gap-2">
                    @if($ticketMessage->images != "")
                        @foreach(explode("|", $ticketMessage->images) as $image)
                            @php $i++ @endphp
                            <div id="divImage{{$i}}" class="" onclick="scaleImage(this)">
                                <img src="/{{$image}}" class="img w-24 h-24" alt="Bild im Ticket #{{$ticket->id}}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <p class="text-right"><small>{{ $ticketMessage->username }}, {{ Time::formatDate($ticketMessage->created_at, 'd.m.Y | H:i') . ' Uhr'  }}</small></p>
            </div>
            <br class="clear-both">
        @endforeach
    </div>

@endsection
