@extends("layout.app")

@section("outerApp")
    <div
        class="lg:w-[89%] lg:ml-52 h-96 flex mt-[32px] relative dark:shadow-[0_10px_20px_0px_rgba(15,23,42,0.7)] shadow-[0_10px_20px_0px_rgba(189,13,13,0.7)]">
        <div
            class="contentgrad hidden sm:block dark:bg-gradient-to-r dark:from-slate-800 dark:to-contentgradiantdarkright bg-gradient-to-r from-gray-300 to-white">
            <div>
                <h1 class="text-3xl lg:text-4xl lg:ml-[-150px] md:ml-[200px] xl:ml-[-150px] 2xl:ml-[-150px] pb-[25px]">
                    Hilfecenter</h1>
                <p class="sm:ml-[60px] sm:text-[17px] md:ml-[200px] lg:ml-[10%] md:text-[0.8rem] xl:text-[17px] 2xl:w-[70%] lg:w-[70%] 2xl:ml[50%] 2xl:text-[20px]">
                    In unserem Hilfecenter finden Sie zahlreiche Einträge zu Fragen die oft gestellt werden, sowie die Möglichkeit, Tickets zu eröffnen um direkt Kontakt mit uns aufzunehmen.</p>
            </div>
        </div>
        <div class="grad sm:w-[60%] md:w-[50%] lg:w-[80%] 2xl:w-[80%] dark:bg-darkimage bg-lightimage">
            <div class="w-[80%] ml-[50px] dark:bg-darkbox bg-lightbox sm:hidden">
                <h2 class="text-3xl lg:text-5xl md:ml-[150px] lg:ml-0 2xl:text-left pl-3 font-medium">Hilfecenter</h2>
                <p class="font-normal p-[0.8rem] dark:bg-[rgba(51,65,85,0.5)] bg-[rgba(245,245,245,0.5)] text-[1rem]">
                    In unserem Hilfecenter finden Sie zahlreiche Einträge sowie die Möglichkeit, Tickets zu eröffnen um direkt Kontakt mit uns aufzunehmen.</p>
            </div>
        </div>
    </div>
@endsection


@section("content")
    <div id="home">
        <div class="container">
            <h2 class="animation">{{ $pageTitle }}</h2>
        </div>
        <div id="box">

        </div>
        <div class="mb-32">

            <h2 class="!text-2xl md:!text-5xl">Häufige Probleme</h2>

            <div id="frequentProblems" class="flex flex-wrap gap-4 md:gap-24 justify-center">
                @foreach($faqcategories as $categories)
                    @if(!is_null($categories->faqs->first()))
                    <div class="frequentBox w-72">
                        <h3 class="!text-lg md:!text-2xl !mb-[0px] !text-center !text-black dark:!text-white">{{ $categories->name }}</h3>
                        @foreach($categories->faqs as $faq)
                        <a href="{{ route("faq.article", $faq->id ) }}"
                           class="text-blue-600 dark:text-white text-center block pb-2 text-base hover:text-blue-300 hover:dark:text-blue-300">{{ $faq->title }}</a>
                        @endforeach
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

        @if($visibileContacts->count() > 0)
            <div id="contact"
                 class="mb-32 mx-auto w-fit pb-8 pr-8 pl-8 pt-4 bg-white dark:bg-transparent rounded-xl">
                <h2 class="mb-12 !text-2xl md:!text-5xl">Ihre Ansprechpartner</h2>
                <div class="flex justify-center gap-8 sm:gap-16 lg:gap-24 flex-wrap">
                    @foreach($visibileContacts as $user)
                        <div>
                            <div class="rounded-full border-black border w-40 aspect-square bg-cover"
                                 style="background-image: url( {{ asset($user['imagepath']) }})">

                            </div>
                            <p class="text-xl text-center font-bold">{{$user->firstname}} {{$user->lastname}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


        <div id="moreSupportOptions" class="mb-16">
            <h2 class="!text-2xl md:!text-5xl mb-8 text-center">Mehr Supportoptionen</h2>
            <div class="block md:flex md:justify-center md:gap-16 h-fit">
                <div
                    class="w-full p-8 rounded-xl bg-white dark:bg-transparent md:w-5/12 xl:w-[400px] mb-12 md:mb-0 relative flex flex-col">
                    <h3 class="text-center text-xl md:text-2xl dark:text-white text-black font-bold">Frequently
                        Asked Questions</h3>
                    <p class="text-center text-sm md:text-base h-full">Sie haben ein Problem, welches möglicherweise
                        schon
                        Leute vor Ihnen hatten? Dann Lesen Sie unseren FAQ durch und schauen Sie, ob Sie den
                        richtigen Beitrag finden zu Ihren Problem!</p>

                    <div class="buttonBox mt-4 flex justify-center">
                        <x-button
                            content="FAQ Lesen"
                            type="1"
                            colorType="primary"
                            :link="route('faq.dashboard')"
                        ></x-button>
                    </div>

                </div>
                <div
                    class="w-full p-8 rounded-xl bg-white dark:bg-transparent md:w-5/12 xl:w-[400px] relative flex flex-col">
                    <h3 class="text-center text-xl md:text-2xl dark:text-white text-black font-bold">Tickets</h3>
                    <p class="text-center text-sm md:text-base h-full">Sie haben ein spezifisches Problem, welches Sie
                        nicht
                        im FAQ gefunden haben?<br>Dann erstellen Sie einfach ein Ticket und wir werden uns das genauer
                        anschauen!</p>
                    <div class="buttonBox mt-4 flex justify-center">
                        @auth
                            <x-button
                                content="Ticket erstellen"
                                type="1"
                                colorType="primary"
                                :link="route('ticket.create')"
                            ></x-button>
                        @endauth

                        @guest
                            <x-button
                                content="Ticket erstellen"
                                type="1"
                                colorType="primary"
                                :link="route('login')"
                            ></x-button>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
