@extends('layout.app')

@section('outerApp')
    <div id="imageBox" class="hidden" onclick="scaleImage(event)">
        <img src="">
    </div>
@endsection

@section('content')

    <div id="titelTicket" class="w-[95%] m-auto md:w-[80%] mb-16">
        <h1>{{ $pageTitle }}</h1>
        <p class="text-right mt-6 mb-2">{{ $ticket->user()->first()->username }}
            , {{ Time::formatDate($ticket->created_at, 'd.m.Y | H:i') . ' Uhr' }}</p>
        @if($ticket->status_id != Config::STATUSCLOSED && (Rights::checkIfAnyRights(['closeticket'])) || Auth::id() == $ticket->user_id )
            <div class="w-36 h-8 float-right">
                <form method="POST" action="{{route('ticketclose', $ticket->id)}}" class="cursor-pointer">
                    @csrf
                    @method('PATCH')
                    <x-button content="Schließen" colorType="danger"></x-button>
                </form>
            </div>
        @endif
    </div>

    <div id="descriptionTicket" style="hyphens: auto">
        <p>{{ $ticket->content }}</p>
    </div>
    <hr class="mb-12 mt-4 border-t-4 border-red-500 dark:border-white w-[80%] m-auto">


    <livewire:ticketmessages :ticketID="$ticket->id"></livewire:ticketmessages>

    @if($ticket->status_id != Config::STATUSCLOSED && Rights::checkIfAnyRights(['sendticketmessage']))
        <div id="submitResponse" class="w-[90%] md:w-[60%] m-auto mt-12 pb-8">
            <form method="POST" id="messageFormular" enctype="multipart/form-data"
                  action="{{ route("ticketmessagepost", $ticket->id) }}">
                @csrf
                <x-form.textarea
                    label="Antwort verfassen:"
                    inputName="message"
                    placeholder="Antwort eingeben ...."
                    :value="old('message')"
                    setRequired="1"
                    customClasses="inputTextareaCustom"
                ></x-form.textarea>
                <x-form.input
                    label="Bilder anhängen"
                    inputName="imgUpload[]"
                    id="inputMultiple"
                    inputType="file"
                    placeholder=""
                    setRequired="0"
                    value=""
                    subText="Das Bild muss vom Datentyp: {{ str_replace(array('image', 'application', '/'), ' ', implode(' ',Config::ALLOWEDEXTENSIONS)) }} sein. Maximale Größe: {{ Config::IMAGESIZEFAQ }}mb"
                    showSubText="1"
                    extra="multiple"
                ></x-form.input>

                <x-button id="submitBtn" colorType="success" content="Senden" btnClasses="mt-4"></x-button>
                <p class="text-red-500" id="errorMessage"></p>
            </form>
        </div>
    @endif
@endsection






