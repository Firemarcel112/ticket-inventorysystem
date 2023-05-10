@extends("layout.app")

@section("content")

    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>

        <div id="BearbeitenMain">
            <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="POST" action="{{route('ticketpostedit', $ticket->id)}}">
                @csrf
                <x-form.select
                    label="Status"
                    inputName="status_id"
                    :compare="$ticket->status_id"
                    :array="$statuses"
                    visibleValue="name"
                ></x-form.select>
                <x-form.select
                    label="Kategorie"
                    inputName="category_id"
                    :compare="$ticket->category_id"
                    :array="$categories"
                    visibleValue="name"
                ></x-form.select>
                <x-form.select
                    label="Zuweisen zu einem Benutzer"
                    inputName="assigner_id"
                    :compare="$ticket->assigner_id"
                    :array="$allowedUsers"
                    visibleValue="username"
                ></x-form.select>
                <x-form.select
                    label="Zuweisen zu einer Gruppe"
                    inputName="group_id"
                    :compare="$ticket->group_id"
                    :array="$allowedGroups"
                    visibleValue="name"
                ></x-form.select>

                <div class="formButtons">
                    <x-button content="Speichern" colorType="success"></x-button>
                    <x-button type="1" :link="route('ticket.dashboard')" content="Abbrechen" colorType="danger"></x-button>
                </div>

            </form>
        </div>
    </div>

@endsection
