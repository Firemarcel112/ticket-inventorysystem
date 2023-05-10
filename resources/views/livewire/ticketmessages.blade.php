
<div id="messageTicket" wire:poll.1000ms class="flex flex-col">
    @php $i = 0; @endphp
    @foreach($ticketMessages as $ticketMessage)

        <div class="{{ Auth::id() == $ticketMessage->user_id ? "messageUser" : "messageAdmin" }}">

            <p class="hyphens-auto">{{ $ticketMessage->message }}</p>
            <div class="imgBox ">
                @if($ticketMessage->images != "")
                    @foreach(explode("|", $ticketMessage->images) as $image)
                        @php $i++ @endphp
                        <div id="divImage{{$i}}" onclick="scaleImage(this)">
                            <img src="/{{$image}}" class="img w-24 h-24 mt-2 border border-black"
                                 alt="Bild im Ticket #{{$ticket->id}}">
                        </div>
                    @endforeach
                @endif
            </div>
            <p class="text-right">
                <small>
                    {!! $ticketMessage->user->username !!}
                    {{ Time::formatDate($ticketMessage->created_at, 'd.m.Y | H:i') . ' Uhr' }}
                </small></p>
        </div>


        <br class="clear-both">
    @endforeach
</div>
