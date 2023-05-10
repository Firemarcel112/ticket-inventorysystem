@extends("layout.app")

@section("content")

    <div class="ml-4 sm:ml-0">
        <form class="w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%]" method="post" action="{{ route('importusers') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">CSV-Datei auswählen</label>
                    <input name="importFile" id="importFile" class="block w-[95%] 2xl:w-1/2 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="text/csv" required type="file">
                </div>
                <p class="text-base">Der Upload von CSV-Dateien ist nur gewährleistet, wenn das Format wie folgt ist:</p>
                <p class="text-base bg-white dark:bg-slate-500 p-2">id | Benutzername | email | Passwort</p>
                <p class="text-base">Die ID wird neu generiert!</p>
            </div>

            <hr class="w-full my-4">

            <div>
                <label>Passwort aus der CSV Datei verwenden</label>
                <input id="inputCheckbox" onchange=clearInput("inputCheckbox") name="checkbox" type="checkbox" checked required> <br>
            </div>

            <div>
                <label>Standardpasswort eingeben</label>
                <input id="inputPassword" onchange=clearInput("inputPassword") name="password" autocomplete="new-password" value="" type="password"> <br>
            </div>

            <hr class="w-full my-4">

            <div>
                <x-form.select
                    label="Gruppe festlegen"
                    inputName="group"
                    :compare="Config::DEFAULTGROUP"
                    :array="$groups"
                    visibleValue="name"
                ></x-form.select>
            </div>

            <div class="flex gap-4 md:gap-12 mt-4 w-full">
                <x-button content="Importieren" colorType="success"></x-button>
                <x-button type="1" :link="route('admin.usermanagement')" content="Abbrechen" colorType="danger"></x-button>
            </div>

        </form>

    </div>

@endsection

<script>
    function clearInput(value) {
        let checkbox = document.querySelector("#inputCheckbox");
        let password = document.querySelector("#inputPassword");
        if(value == "inputCheckbox") {
            password.value = "";
            password.required = false;
            checkbox.required = true;
        }
        else {
            checkbox.checked = false;
            checkbox.required = false;
            password.required = true;
        }
    }
</script>
