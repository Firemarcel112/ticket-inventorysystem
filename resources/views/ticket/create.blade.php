@extends('layout.app')

@section('content')

    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>
        <form method="POST" action="{{ route("ticketcreate") }}" class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]">
            @csrf
            <x-form.input
                    label="Betreff"
                    inputName="headline"
                    inputType="text"
                    placeholder="Betreff eingeben"
                    :value="old('headline')"
                    setRequired="1"
            ></x-form.input>
            <x-form.select
                label="Kategorie"
                inputName="category_id"
                :compare="NULL"
                :array="$categories"
                visibleValue="name"
            ></x-form.select>
            <x-form.textarea
                    label="Inhalt"
                    inputName="content"
                    placeholder="Inhalt eingeben"
                    :value="old('content')"
                    setRequired="0"
                    customClasses="inputTextareaCustom"
            ></x-form.textarea>
            <div class="formButtons">
                <x-button
                        content='<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 stroke-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>'
                        colorType="success"
                        :link="route('faq.dashboard')"
                ></x-button>
                <x-button type="1" :link="route('dashboard')" content="Abbrechen" colorType="danger"></x-button>
            </div>

        </form>

    </div>


@endsection
