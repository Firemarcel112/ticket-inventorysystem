<aside id="sidebar">
    <div>

        <ul class="flex flex-col py-4 space-y-1">
            <x-sidebar-item name="Startseite" route="startseite" icon="home"></x-sidebar-item>
            @auth
                <x-sidebar-item name="Dashboard" route="dashboard"></x-sidebar-item>
            @endauth

            @auth
                @if(Rights::checkIfAnyRights(['isadmin']))
                    <li class="dropdown">
                        <x-sidebar-item name="Administration" menuID="administrationMenu" icon="admin" dropdown="2"></x-sidebar-item>
                        <ul id="administrationMenu" class="hidden">
                            <x-sidebar-item name="Dashboard" dropdown="1" route="admin.dashboard" icon="dashboard-icon"></x-sidebar-item>
                            <x-sidebar-item name="Benutzerverwaltung" route="admin.usermanagement" dropdown="1" icon="users-management"></x-sidebar-item>
                            <x-sidebar-item name="Gruppenverwaltung" route="admin.groupmanagement" dropdown="1" icon="group-management-icon"></x-sidebar-item>
                            <x-sidebar-item name="FAQ Verwaltung" route="admin.faqmanagement" dropdown="1" icon="faq-management-icon"></x-sidebar-item>
                            <x-sidebar-item name="FAQ Kategorien" route="admin.faqcategories" dropdown="1" icon="faq-category"></x-sidebar-item>
                            <x-sidebar-item name="Ansprechpartner" route="admin.contactmanagement" dropdown="1" icon="contact-us-icon"></x-sidebar-item>
                            <x-sidebar-item name="Logs" route="admin.logs" dropdown="1" icon="logs"></x-sidebar-item>
                        </ul>
                    </li>

                @elseif(Rights::checkIfAnyRights(['managefaq']))
                    <li class="dropdown">
                        <x-sidebar-item name="Administration" menuID="administrationMenu" icon="admin" dropdown="2"></x-sidebar-item>
                        <ul id="administrationMenu" class="hidden">
                            <x-sidebar-item name="FAQ Verwaltung" route="admin.faqmanagement" dropdown="1"></x-sidebar-item>
                            <x-sidebar-item name="FAQ Kategorien" route="admin.faqcategories" dropdown="1"></x-sidebar-item>
                        </ul>
                    </li>
                @endif

            @endauth

            @auth
                @if(Rights::checkIfAnyRights(['openticket', 'modifyticket', 'readticket', 'modifyticketstatus' , 'modifyticketcategories', 'archiveaccess', 'ticketaccess']))
                    <li class="dropdown">
                        <x-sidebar-item name="Ticket" menuID="ticketMenu" icon="ticket" dropdown="2"></x-sidebar-item>
                        <ul id="ticketMenu" class="hidden">

                            @if(Rights::checkIfAnyRights(['openticket']))
                                <x-sidebar-item name="Erstellen" route="ticket.create" dropdown="1" icon="add-ticket-icon"></x-sidebar-item>
                            @endif
                            @if(Rights::checkIfAnyRights(['readticket', 'ticketaccess']))
                                <x-sidebar-item name="Dashboard" route="ticket.dashboard" dropdown="1" icon="dashboard-icon"></x-sidebar-item>
                            @endif

                            @if(Rights::checkIfAnyRights(['ticketaccess', 'modifyticketstatus']))
                                <x-sidebar-item name="Status" route="ticket.status.dashboard" dropdown="1" icon="status-icon"></x-sidebar-item>
                            @endif

                            @if(Rights::checkIfAnyRights(['ticketaccess', 'modifyticketcategories']))
                                <x-sidebar-item name="Kategorien" route="ticket.categories.dashboard" dropdown="1" icon="categories-icon"></x-sidebar-item>
                            @endif

                            @if(Rights::checkIfAnyRights(['archiveaccess']))
                                <x-sidebar-item name="Archiv" route="ticket.archive.dashboard" dropdown="1" icon="archive-icon"></x-sidebar-item>
                            @endif

                        </ul>
                    </li>
                @endif
            @endauth

            @auth
                @if(Rights::checkIfAnyRights(['assetaccess', 'manufactureraccess', 'categoriesaccess', 'locationaccess', 'modelaccess', 'statusaccess', 'departmentaccess', 'accesslicense', 'dashboardaccess', 'fullaccess']))
                    <li class="dropdown">
                        <x-sidebar-item name="Inventarisierung" menuID="inventarisierungMenu" icon="inventarisierung" dropdown="2"></x-sidebar-item>

                        <ul id="inventarisierungMenu" class="hidden">

                            @if(Rights::checkifAnyRights(['dashboardaccess', 'fullaccess']))
                                <x-sidebar-item name="Dashboard" route="inventory.dashboard" dropdown="1" icon="dashboard-icon"></x-sidebar-item>
                            @endif

                            @if(Rights::checkifAnyRights(['fullaccess', 'assetaccess', 'dashboardaccess']))
                                <x-sidebar-item name="Gegenstände" route="inventory.assets.dashboard" dropdown="1" icon="access-icon"></x-sidebar-item>
                            @endif

                            @if(Rights::checkifAnyRights(['fullaccess', 'accesslicense', 'dashboardaccess']))
                                <x-sidebar-item name="Lizenzen" route="inventory.license.dashboard" dropdown="1" icon="license-icon"></x-sidebar-item>
                            @endif
                            @if(Rights::checkifAnyRights(['fullaccess', 'categoriesaccess', 'dashboardaccess']))
                                <x-sidebar-item name="Kategorien" route="inventory.categories.dashboard" dropdown="1" icon="categories-icon"></x-sidebar-item>
                            @endif
                            @if(Rights::checkifAnyRights(['fullaccess', 'locationaccess', 'dashboardaccess']))
                                <x-sidebar-item name="Orte" route="inventory.location.dashboard" dropdown="1" icon="location-icon"></x-sidebar-item>
                            @endif
                            @if(Rights::checkifAnyRights(['fullaccess', 'manufactureraccess', 'dashboardaccess']))
                                    <x-sidebar-item name="Hersteller" route="inventory.manufacturer.dashboard" dropdown="1" icon="manufactor-icon"></x-sidebar-item>
                            @endif
                            @if(Rights::checkifAnyRights(['fullaccess', 'modelaccess', 'dashboardaccess']))
                                    <x-sidebar-item name="Modelle" route="inventory.model.dashboard" dropdown="1" icon="models-icon"></x-sidebar-item>
                            @endif
                            @if(Rights::checkifAnyRights(['fullaccess', 'statusaccess', 'dashboardaccess']))
                                    <x-sidebar-item name="Status" route="inventory.status.dashboard" dropdown="1" icon="status-icon"></x-sidebar-item>
                            @endif
                            @if(Rights::checkifAnyRights(['fullaccess', 'departmentaccess', 'dashboardaccess']))
                                <x-sidebar-item name="Abteilungen" route="inventory.department.dashboard" dropdown="1" icon="department-icon"></x-sidebar-item>
                            @endif
                            @if(Rights::checkIfAnyRights(['isadmin']))
                                    <x-sidebar-item name="Personen" route="inventory.people.dashboard" dropdown="1" icon="users-icon"></x-sidebar-item>
                            @endif
                        </ul>
                    </li>
                @endif
            @endauth
            <x-sidebar-item name="FAQ" route="faq.dashboard" icon="faq"></x-sidebar-item>
            @if(Rights::checkIfAnyRights(['isadmin']))
            <x-sidebar-item name="Debug" route="telescope" icon="debug"></x-sidebar-item>
            @endif
        </ul>

        <div id="toggleMainWrapper">
            <div id="toggleWrapper">
                <div class="toggle_switch">
                    <div class="absolute bg-slate-700" id="nightmode"></div>
                    <input type="checkbox" id="toggler" onclick="toggleDarkmode()" class="switch_3">
                    <svg class="checkbox" xmlns="http://www.w3.org/2000/svg" style="isolation:isolate" viewBox="0 0 168 80">
                        <path class="outer-ring" d="M41.534 9h88.932c17.51 0 31.724 13.658 31.724 30.482 0 16.823-14.215 30.48-31.724 30.48H41.534c-17.51
0                        -31.724-13.657-31.724-30.48C9.81 22.658 24.025 9 41.534 9z" fill="none" stroke="#233043" stroke-width="5" stroke-
                              linecap="square" stroke-miterlimit="3"
                        />

                        <path class="is_checked" d="M17 39.482c0-12.694 10.306-23 23-23s23 10.306 23 23-10.306 23-23 23-23-10.306-23-23z"
                        />

                        <path class="is_unchecked" d="M132.77 22.348c7.705 10.695 5.286 25.617-5.417 33.327-2.567 1.85-5.38 3.116-8.288 3.812 7.977 5.03 18.54 5.024
                                  26.668-.83 10.695-7.706 13.122-22.634 5.418-33.33-5.855-8.127-15.88-11.474-25.04-9.23 2.538 1.582 4.806 3.676 6.666.25z"
                        />
                    </svg>
                </div>
            </div>


            <hr>
            @auth
                <div
                    class="iconBox p-2 flex items-center rounded-lg dark:bg-gray-600 bg-gray-200 w-9/12 md:w-3/12 justify-center mx-auto mt-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button tooltip="Abmelden" flow="up"
                           class="ml-1 text-center text-gray-400 block cursor-pointer hover:text-main dark:hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" style="transform: rotate(180deg)" class="w-8 h-8"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                        </button>
                    </form>

                </div>
            @endauth
        </div>

    </div>
</aside>
<br>
