@extends("layout.app")


@section("content")
    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>
        <div id="BearbeitenMain">
            <form class="userEdit w-[95%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="post" action="{{ route('groupcreate') }}">
                @csrf
                <x-form.input
                        label="Gruppenname"
                        inputName="name"
                        inputType="text"
                        placeholder="Gruppenname eingeben"
                        :value="old('name')"
                        setRequired="1"
                ></x-form.input>

                <div class="mt-3">
                    <p class="text-2xl">Rechte ändern</p>
                    <div id="rechteHeader" class="flex w-full bg-white dark:bg-slate-900 px-2 py-1">
                        <div class="w-[50%]">
                            <p class="font-extrabold text-[0.67rem] sm:text-xl">Recht</p>
                        </div>
                        <div class="w-[25%]">
                            <p class="text-center font-extrabold text-[0.67rem] sm:text-xl">Erlauben</p>
                        </div>
                        <div class="w-[25%]">
                            <p class="text-center font-extrabold text-[0.67rem] sm:text-xl">Verweigern</p>
                        </div>
                    </div>

                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Administrator</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => "isadmin", "label" => "Admin"])

                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Tickets</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => "ticketaccess", "label" => "Zugriff auf das gesamte Ticket-System"])
                    @include("admin.groupmanagement.right", ["right" => "openticket", "label" => "Tickets öffnen"])
                    @include("admin.groupmanagement.right", ["right" => "closeticket", "label" => "Tickets schließen"])
                    @include("admin.groupmanagement.right", ["right" => "modifyticket", "label" => "Tickets bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "readticket", "label" => "Tickets lesen"])
                    @include("admin.groupmanagement.right", ["right" => "sendticketmessage", "label" => "Nachrichten in Tickets versenden"])
                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Ticketkategorien</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => "modifyticketcategories", "label" => "Kategorien bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "createticketcategories", "label" => "Kategorien erstellen"])
                    @include("admin.groupmanagement.right", ["right" => "deleteticketcategories", "label" => "Kategorien löschen"])
                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Ticketstatus</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => "modifyticketstatus", "label" => "Status bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "createticketstatus", "label" => "Status erstellen"])
                    @include("admin.groupmanagement.right", ["right" => "deleteticketstatus", "label" => "Status löschen"])


                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Archiv</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => "archiveaccess", "label" => "Zugriff auf das Ticketarchiv"])
                    @include("admin.groupmanagement.right", ["right" => "deletearchive", "label" => "Archivinhalte löschen"])

                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Asset</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => "fullaccess", "label" => "Vollzugriff"])
                    @include("admin.groupmanagement.right", ["right" => "dashboardaccess", "label" => "Zugriff auf das Dashboard"])

                    @include("admin.groupmanagement.right", ["right" => "assetaccess", "label" => "Zugriff auf die Gegenstände"])
                    @include("admin.groupmanagement.right", ["right" => "modifyasset", "label" => "Gegenstände bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "deleteasset", "label" => "Gegenstände löschen"])
                    @include("admin.groupmanagement.right", ["right" => "createasset", "label" => "Gegenstände erstellen"])


                    @include("admin.groupmanagement.right", ["right" => "modelaccess", "label" => "Zugriff auf die Modelle"])
                    @include("admin.groupmanagement.right", ["right" => "modifymodel", "label" => "Modelle bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "deletemodel", "label" => "Modelle löschen"])
                    @include("admin.groupmanagement.right", ["right" => "createmodel", "label" => "Modelle erstellen"])

                    @include("admin.groupmanagement.right", ["right" => "manufactureraccess", "label" => "Zugriff auf die Hersteller"])
                    @include("admin.groupmanagement.right", ["right" => "modifymanufacturer", "label" => "Hersteller bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "deletemanufacturer", "label" => "Hersteller löschen"])
                    @include("admin.groupmanagement.right", ["right" => "createmanufacturer", "label" => "Hersteller erstellen"])

                    @include("admin.groupmanagement.right", ["right" => "categoriesaccess", "label" => "Zugriff auf die Kategorien"])
                    @include("admin.groupmanagement.right", ["right" => "modifycategories", "label" => "Kategorien bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "deletecategories", "label" => "Kategorien löschen"])
                    @include("admin.groupmanagement.right", ["right" => "createcategories", "label" => "Kategorien erstellen"])

                    @include("admin.groupmanagement.right", ["right" => "locationaccess", "label" => "Zugriff auf die Standorte"])
                    @include("admin.groupmanagement.right", ["right" => "modifylocation", "label" => "Standorte bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "deletelocation", "label" => "Standorte löschen"])
                    @include("admin.groupmanagement.right", ["right" => "createlocation", "label" => "Standorte erstellen"])

                    @include("admin.groupmanagement.right", ["right" => "statusaccess", "label" => "Zugriff auf die Statusse"])
                    @include("admin.groupmanagement.right", ["right" => "modifystatus", "label" => "Status bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "deletestatus", "label" => "Status löschen"])
                    @include("admin.groupmanagement.right", ["right" => "createstatus", "label" => "Status erstellen"])

                    @include("admin.groupmanagement.right", ["right" => "departmentaccess", "label" => "Zugriff auf die Abteilungen"])
                    @include("admin.groupmanagement.right", ["right" => "modifydepartment", "label" => "Abteilungen bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "deletedepartment", "label" => "Abteilungen löschen"])
                    @include("admin.groupmanagement.right", ["right" => "createdepartment", "label" => "Abteilungen erstellen"])

                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Lizenzen</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => "accesslicense", "label" => "Zugriff auf Lizenzen & Zuweisen"])
                    @include("admin.groupmanagement.right", ["right" => "modifylicense", "label" => "Lizenzen bearbeiten"])
                    @include("admin.groupmanagement.right", ["right" => "deletelicense", "label" => "Lizenzen löschen"])
                    @include("admin.groupmanagement.right", ["right" => "createlicense", "label" => "Lizensen erstellen"])

                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">FAQ</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => "managefaq", "label" => "FAQ Verwaltung"])

                </div>

                <div class="formButtons">
                    <x-button content="Erstellen" colorType="success"></x-button>
                    <x-button type="1" :link="route('admin.groupmanagement')" content="Abbrechen" colorType="danger"></x-button>
                </div>

            </form>
        </div>
    </div>
@endsection
