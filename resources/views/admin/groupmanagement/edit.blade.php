@extends("layout.app")


@section("content")
    <div class="ml-4 sm:ml-0 mb-8">
        <div id="BearbeitenHeader" class="mt-4 sm:mt-12 md:mt-16 mb-4">
            <div class="w-full">
                <h1 class="inline-block text-2xl sm:text-4xl">{{ $pageTitle }}</h1>
            </div>
        </div>
        <div id="BearbeitenMain">
            <form class="userEdit w-[95%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="POST" action="{{ route("groupedit", $group['id']) }}">
                @csrf
                <x-form.input
                        label="Gruppe"
                        inputName="name"
                        inputType="text"
                        placeholder="Gruppe eingeben"
                        :value="$group['name']"
                        setRequired="1"
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
                    @include("admin.groupmanagement.right", ["right" => $permissions['isadmin']['name'], "label" => $permissions['isadmin']['label'], 'hasRight' => $permissions['isadmin']['value']])

                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Tickets</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => $permissions['ticketaccess']['name'], "label" => $permissions['ticketaccess']['label'], 'hasRight' => $permissions['ticketaccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['openticket']['name'], "label" => $permissions['openticket']['label'], 'hasRight' => $permissions['openticket']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['closeticket']['name'], "label" => $permissions['closeticket']['label'], 'hasRight' => $permissions['closeticket']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifyticket']['name'], "label" => $permissions['modifyticket']['label'], 'hasRight' => $permissions['modifyticket']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['readticket']['name'], "label" => $permissions['readticket']['label'], 'hasRight' => $permissions['readticket']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['sendticketmessage']['name'], "label" => $permissions['sendticketmessage']['label'], 'hasRight' => $permissions['sendticketmessage']['value']])
                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Ticketkategorien</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => $permissions['createticketcategories']['name'], "label" => $permissions['createticketcategories']['label'], 'hasRight' => $permissions['createticketcategories']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifyticketcategories']['name'], "label" => $permissions['modifyticketcategories']['label'], 'hasRight' => $permissions['modifyticketcategories']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deleteticketcategories']['name'], "label" => $permissions['deleteticketcategories']['label'], 'hasRight' => $permissions['deleteticketcategories']['value']])
                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Ticketstatus</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => $permissions['createticketstatus']['name'], "label" => $permissions['createticketstatus']['label'], 'hasRight' => $permissions['createticketstatus']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifyticketstatus']['name'], "label" => $permissions['modifyticketstatus']['label'], 'hasRight' => $permissions['modifyticketstatus']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deleteticketstatus']['name'], "label" => $permissions['deleteticketstatus']['label'], 'hasRight' => $permissions['deleteticketstatus']['value']])


                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Archiv</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => $permissions['archiveaccess']['name'], "label" => $permissions['archiveaccess']['label'], 'hasRight' => $permissions['archiveaccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deletearchive']['name'], "label" => $permissions['deletearchive']['label'], 'hasRight' => $permissions['deletearchive']['value']])

                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Asset</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => $permissions['fullaccess']['name'], "label" => $permissions['fullaccess']['label'], 'hasRight' => $permissions['fullaccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['dashboardaccess']['name'], "label" => $permissions['dashboardaccess']['label'], 'hasRight' => $permissions['dashboardaccess']['value']])

                    @include("admin.groupmanagement.right", ["right" => $permissions['assetaccess']['name'], "label" => $permissions['assetaccess']['label'], 'hasRight' => $permissions['assetaccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifyasset']['name'], "label" => $permissions['modifyasset']['label'], 'hasRight' => $permissions['modifyasset']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deleteasset']['name'], "label" => $permissions['deleteasset']['label'], 'hasRight' => $permissions['deleteasset']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['createasset']['name'], "label" => $permissions['createasset']['label'], 'hasRight' => $permissions['createasset']['value']])

                    @include("admin.groupmanagement.right", ["right" => $permissions['modelaccess']['name'], "label" => $permissions['modelaccess']['label'], 'hasRight' => $permissions['modelaccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifymodel']['name'], "label" => $permissions['modifymodel']['label'], 'hasRight' => $permissions['modifymodel']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deletemodel']['name'], "label" => $permissions['deletemodel']['label'], 'hasRight' => $permissions['deletemodel']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['createmodel']['name'], "label" => $permissions['createmodel']['label'], 'hasRight' => $permissions['createmodel']['value']])

                    @include("admin.groupmanagement.right", ["right" => $permissions['manufactureraccess']['name'], "label" => $permissions['manufactureraccess']['label'], 'hasRight' => $permissions['manufactureraccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifymanufacturer']['name'], "label" => $permissions['modifymanufacturer']['label'], 'hasRight' => $permissions['modifymanufacturer']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deletemanufacturer']['name'], "label" => $permissions['deletemanufacturer']['label'], 'hasRight' => $permissions['deletemanufacturer']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['createmanufacturer']['name'], "label" => $permissions['createmanufacturer']['label'], 'hasRight' => $permissions['createmanufacturer']['value']])

                    @include("admin.groupmanagement.right", ["right" => $permissions['categoriesaccess']['name'], "label" => $permissions['categoriesaccess']['label'], 'hasRight' => $permissions['categoriesaccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifycategories']['name'], "label" => $permissions['modifycategories']['label'], 'hasRight' => $permissions['modifycategories']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deletecategories']['name'], "label" => $permissions['deletecategories']['label'], 'hasRight' => $permissions['deletecategories']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['createcategories']['name'], "label" => $permissions['createcategories']['label'], 'hasRight' => $permissions['createcategories']['value']])

                    @include("admin.groupmanagement.right", ["right" => $permissions['locationaccess']['name'], "label" => $permissions['locationaccess']['label'], 'hasRight' => $permissions['locationaccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifylocation']['name'], "label" => $permissions['modifylocation']['label'], 'hasRight' => $permissions['modifylocation']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deletelocation']['name'], "label" => $permissions['deletelocation']['label'], 'hasRight' => $permissions['deletelocation']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['createlocation']['name'], "label" => $permissions['createlocation']['label'], 'hasRight' => $permissions['createlocation']['value']])

                    @include("admin.groupmanagement.right", ["right" => $permissions['statusaccess']['name'], "label" => $permissions['statusaccess']['label'], 'hasRight' => $permissions['statusaccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifystatus']['name'], "label" => $permissions['modifystatus']['label'], 'hasRight' => $permissions['modifystatus']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deletestatus']['name'], "label" => $permissions['deletestatus']['label'], 'hasRight' => $permissions['deletestatus']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['createstatus']['name'], "label" => $permissions['createstatus']['label'], 'hasRight' => $permissions['createstatus']['value']])

                    @include("admin.groupmanagement.right", ["right" => $permissions['departmentaccess']['name'], "label" => $permissions['departmentaccess']['label'], 'hasRight' => $permissions['departmentaccess']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifydepartment']['name'], "label" => $permissions['modifydepartment']['label'], 'hasRight' => $permissions['modifydepartment']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deletedepartment']['name'], "label" => $permissions['deletedepartment']['label'], 'hasRight' => $permissions['deletedepartment']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['createdepartment']['name'], "label" => $permissions['createdepartment']['label'], 'hasRight' => $permissions['createdepartment']['value']])

                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">Lizenzen</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => $permissions['accesslicense']['name'], "label" => $permissions['accesslicense']['label'], 'hasRight' => $permissions['accesslicense']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['modifylicense']['name'], "label" => $permissions['modifylicense']['label'], 'hasRight' => $permissions['modifylicense']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['deletelicense']['name'], "label" => $permissions['deletelicense']['label'], 'hasRight' => $permissions['deletelicense']['value']])
                    @include("admin.groupmanagement.right", ["right" => $permissions['createlicense']['name'], "label" => $permissions['createlicense']['label'], 'hasRight' => $permissions['createlicense']['value']])

                    <div class="flex w-full bg-gray-50 dark:bg-slate-800 px-2 py-1 mt-3">
                        <p class="font-bold">FAQ</p>
                    </div>
                    @include("admin.groupmanagement.right", ["right" => $permissions['managefaq']['name'], "label" => $permissions['managefaq']['label'], 'hasRight' => $permissions['managefaq']['value']])


                </div>

                <div class="formButtons">
                    <x-button content="Speichern" colorType="success"></x-button>
                    <x-button type="1" :link="route('admin.groupmanagement')" content="Abbrechen" colorType="danger"></x-button>
                </div>
            </form>
        </div>
    </div>
@endsection
