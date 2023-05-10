<?php

namespace App\Http\Controllers;

use App\Models\GroupDetailModel;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Events\LogActionEvent;

class GroupController extends Controller
{

    protected GroupRightsModel $rights;
    protected GroupDetailModel $group;

    public function __construct(GroupRightsModel $rights, GroupDetailModel $group){
        $this->rights = $rights;
        $this->group = $group;
    }

    public function index(Request $request) {

        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $pageTitle = "Gruppenverwaltung";

        $group = $this->rights->getAllGroups();

        $result = [];
        for ($i = 0; $i < count($group); $i++) {
            $result[$i] = $group[$i];
        }
        if ($request->get("search")) {
            $search = $this->rights->findGroup($request->get("search"));

            if (empty($search[0])) {
                return redirect()->route("admin.groupmanagement")->with("info", ConfigController::GROUPNOTFOUND);
            }
            else{
                $result = $search;
            }
            return view("admin.groupmanagement.management", compact("result", "pageTitle"));
        }
        return view("admin.groupmanagement.management", compact("result", "pageTitle"));
    }

    /* TODO
    * createGroupView und CreateGroup in einer Funktion
    */
    public function create() {
        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = " Neue Gruppe erstellen";
        $groups = $this->rights->getAllGroups();
        $result = [];
        for($i = 0; $i < count($groups); $i++) {
            $result[$i] = $groups[$i]["name"];
        }
        return view("admin.groupmanagement.create", compact("result", "pageTitle"));
    }

    public function store(Request $request) {
        if(!empty($request->post())) {
            $groupname = $request->post("name");

            $isadmin = $request->post("isadmin");
            $openTicket = $request->post("openticket");
            $closeTicket = $request->post("closeticket");
//            $changeticketstatus = $request->post("changeticketstatus");
            $modifyticketcategories = $request->post("modifyticketcategories");
            $readticket = $request->post("readticket");
            $sendticketmessage = $request->post("sendticketmessage");
            $archiveaccess = $request->post("archiveaccess");
            $deletearchive = $request->post("deletearchive");
            $fullaccess = $request->post("fullaccess");
            $dashboardaccess = $request->post("dashboardaccess");
            $assetaccess = $request->post("assetaccess");
            $modifymodel = $request->post("modifymodel");
            $deletemodel = $request->post("deletemodel");
            $createmodel = $request->post("createmodel");
            $modifymanufacturer = $request->post("modifymanufacturer");
            $deletemanufacturer = $request->post("deletemanufacturer");
            $createmanufacturer = $request->post("createmanufacturer");
            $modifycategories = $request->post("modifycategories");
            $deletecategories = $request->post("deletecategories");
            $createcategories = $request->post("createcategories");
            $modifylocation = $request->post("modifylocation");
            $deletelocation = $request->post("deletelocation");
            $createlocation = $request->post("createlocation");
            $modifystatus = $request->post("modifystatus");
            $deletestatus = $request->post("deletestatus");
            $createstatus = $request->post("createstatus");
            $modifydepartment = $request->post("modifydepartment");
            $deletedepartment = $request->post("deletedepartment");
            $createdepartment = $request->post("createdepartment");
            $accesslicense = $request->post("accesslicense");
            $modifylicense = $request->post("modifylicense");
            $deletelicense = $request->post("deletelicense");
            $createlicense = $request->post("createlicense");
            $managefaq = $request->post("managefaq");
            $modifyticket = $request->post('modifyticket');
            $modifyasset = $request->post('modifyasset');
            $deleteasset = $request->post('deleteasset');
            $createasset = $request->post('createasset');
            $departmentaccess = $request->post('departmentaccess');
            $statusaccess = $request->post('statusaccess');
            $locationaccess = $request->post('locationaccess');
            $categoriesaccess = $request->post('categoriesaccess');
            $manufactureraccess = $request->post('manufactureraccess');
            $modelaccess = $request->post('modelaccess');
            $createticketcategories = $request->post('createticketcategories');
            $deleteticketcategories = $request->post('deleteticketcategories');
            $createticketstatus = $request->post('createticketstatus');
            $modifyticketstatus = $request->post('modifyticketstatus');
            $deleteticketstatus = $request->post('deleteticketstatus');
            $ticketaccess = $request->post('ticketaccess');
//            dd($request->post());
            if($this->rights->checkIfExist($groupname)) {
                return redirect()->back()->with("error", ConfigController::GROUPALREADYEXIST);
            } else {
                $this->rights->insert([
                    'name' => $groupname,
                    'isadmin' => $isadmin,
                    'openticket' => $openTicket,
                    'closeticket' => $closeTicket,
                    'modifyticketcategories' => $modifyticketcategories,
                    'readticket' => $readticket,
                    'sendticketmessage' => $sendticketmessage,
                    'archiveaccess' => $archiveaccess,
                    'deletearchive' => $deletearchive,
                    'fullaccess' => $fullaccess,
                    'dashboardaccess' => $dashboardaccess,
                    'assetaccess' => $assetaccess,
                    'modifymodel' => $modifymodel,
                    'deletemodel' => $deletemodel,
                    'createmodel' => $createmodel,
                    'modifymanufacturer' => $modifymanufacturer,
                    'deletemanufacturer' => $deletemanufacturer,
                    'createmanufacturer' => $createmanufacturer,
                    'modifycategories' => $modifycategories,
                    'deletecategories' => $deletecategories,
                    'createcategories' => $createcategories,
                    'modifylocation' => $modifylocation,
                    'deletelocation' => $deletelocation,
                    'createlocation' => $createlocation,
                    'modifystatus' => $modifystatus,
                    'deletestatus' => $deletestatus,
                    'createstatus' => $createstatus,
                    'modifydepartment' => $modifydepartment,
                    'deletedepartment' => $deletedepartment,
                    'createdepartment' => $createdepartment,
                    'accesslicense' => $accesslicense,
                    'modifylicense' => $modifylicense,
                    'deletelicense' => $deletelicense,
                    'createlicense' => $createlicense,
                    'managefaq' => $managefaq,
                    'modifyticket' => $modifyticket,
                    'modifyasset' => $modifyasset,
                    'deleteasset' => $deleteasset,
                    'createasset' => $createasset,
                    'departmentaccess' => $departmentaccess,
                    'statusaccess' => $statusaccess,
                    'locationaccess' => $locationaccess,
                    'categoriesaccess' => $categoriesaccess,
                    'manufactureraccess' => $manufactureraccess,
                    'modelaccess' => $modelaccess,
                    'createticketcategories' => $createticketcategories,
                    'deleteticketcategories' => $deleteticketcategories,
                    'createticketstatus' => $createticketstatus,
                    'modifyticketstatus' => $modifyticketstatus,
                    'deleteticketstatus' => $deleteticketstatus,
                    'ticketaccess' => $ticketaccess,
                    "created_at" => now("Europe/Berlin"),
                    "updated_at" => now("Europe/Berlin")
                ]);
                event(new LogActionEvent(ConfigController::LOGSCREATE, $this->rights->getTable(), $groupname));
                return redirect()->route("admin.groupcreate")->with("success", ConfigController::GROUPCREATESUCCESS);
            }

        }

        return redirect()->route("admin.groupmanagement")->with("success", ConfigController::GROUPCREATESUCCESS);
    }

    public function edit(Request $request) {
        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $id = $request->route()->parameters()["id"];
        $group = $this->rights->getGroup($id);
        if(empty($group)) {
            return redirect()->back()->with("500", ConfigController::SERVERERROR);
        }
        $permissions = [
            'isadmin' => [
                'name' => 'isadmin',
                'label' => 'Admin',
                'value' => $group['isadmin'],
            ],
            'openticket' => [
                'name' => 'openticket',
                'label' => 'Tickets öffnen',
                'value' => $group['openticket'],
            ],
            'closeticket' => [
                'name' => 'closeticket',
                'label' => 'Tickets schließen',
                'value' => $group['closeticket'],
            ],
            'modifyticketcategories' => [
                'name' => 'modifyticketcategories',
                'label' => 'Kategorien bearbeiten',
                'value' => $group['modifyticketcategories'],
            ],
            'readticket' => [
                'name' => 'readticket',
                'label' => 'Tickets lesen',
                'value' => $group['readticket'],
            ],
            'sendticketmessage' => [
                'name' => 'sendticketmessage',
                'label' => 'Nachrichten in Tickets versenden',
                'value' => $group['sendticketmessage'],
            ],
            'archiveaccess' => [
                'name' => 'archiveaccess',
                'label' => 'Zugriff auf das Archiv',
                'value' => $group['archiveaccess'],
            ],
            'deletearchive' => [
                'name' => 'deletearchive',
                'label' => 'Archivinhalte löschen',
                'value' => $group['deletearchive'],
            ],
            'fullaccess' => [
                'name' => 'fullaccess',
                'label' => 'Vollzugriff',
                'value' => $group["fullaccess"],
            ],
            'dashboardaccess' => [
                'name' => 'dashboardaccess',
                'label' => 'Zugriff auf Die Dashboards',
                'value' => $group['dashboardaccess'],
            ],
            'assetaccess' => [
                'name' => 'assetaccess',
                'label' => 'Assets zuweisen',
                'value' => $group['assetaccess'],
            ],
            'modifymodel' => [
                'name' => 'modifymodel',
                'label' => 'Modelle bearbeiten',
                'value' => $group['modifymodel'],
            ],
            'deletemodel' => [
                'name' => 'deletemodel',
                'label' => 'Modelle löschen',
                'value' => $group["deletemodel"],
            ],
            'createmodel' => [
                'name' => 'createmodel',
                'label' => 'Modelle erstellen',
                'value' => $group["createmodel"],
            ],
            'modifymanufacturer' => [
                'name' => 'modifymanufacturer',
                'label' => 'Hersteller bearbeiten',
                'value' => $group["modifymanufacturer"],
            ],
            'deletemanufacturer' => [
                'name' => 'deletemanufacturer',
                'label' => 'Hersteller löschen',
                'value' => $group["deletemanufacturer"],
            ],
            'createmanufacturer' => [
                'name' => 'createmanufacturer',
                'label' => 'Hersteller erstellen',
                'value' => $group["createmanufacturer"],
            ],
            'modifycategories' => [
                'name' => 'modifycategories',
                'label' => 'Kategorien bearbeiten',
                'value' => $group["modifycategories"],
            ],
            'deletecategories' => [
                'name' => 'deletecategories',
                'label' => 'Kategorien löschen',
                'value' => $group["deletecategories"],
            ],
            'createcategories' => [
                'name' => 'createcategories',
                'label' => 'Kategorien erstellen',
                'value' => $group["createcategories"],
            ],
            'modifylocation' => [
                'name' => 'modifylocation',
                'label' => 'Standorte bearbeiten',
                'value' => $group["modifylocation"],
            ],
            'deletelocation' => [
                'name' => 'deletelocation',
                'label' => 'Standorte löschen',
                'value' => $group["deletelocation"],
            ],
            'createlocation' => [
                'name' => 'createlocation',
                'label' => 'Standorte erstellen',
                'value' => $group["createlocation"],
            ],
            'statusaccess' => [
                'name' => 'statusaccess',
                'label' => 'Zugriff auf die Statusse',
                'value' => $group["statusaccess"],
            ],
            'modifystatus' => [
                'name' => 'modifystatus',
                'label' => 'Status bearbeiten',
                'value' => $group["modifystatus"],
            ],
            'deletestatus' => [
                'name' => 'deletestatus',
                'label' => 'Status löschen',
                'value' => $group["deletestatus"],
            ],
            'createstatus' => [
                'name' => 'createstatus',
                'label' => 'Status erstellen',
                'value' => $group["createstatus"],
            ],
            'modifydepartment' => [
                'name' => 'modifydepartment',
                'label' => 'Abteilungen bearbeiten',
                'value' => $group["modifydepartment"],
            ],
            'deletedepartment' => [
                'name' => 'deletedepartment',
                'label' => 'Abteilungen löschen',
                'value' => $group["deletedepartment"],
            ],
            'createdepartment' => [
                'name' => 'createdepartment',
                'label' => 'Abteilungen erstellen',
                'value' => $group["createdepartment"],
            ],
            'accesslicense' => [
                'name' => 'accesslicense',
                'label' => 'Zugriff auf Lizenzen & Zuweisen',
                'value' => $group['accesslicense'],
            ],
            'modifylicense' => [
                'name' => 'modifylicense',
                'label' => 'Lizenzen bearbeiten',
                'value' => $group['modifylicense'],
            ],
            'deletelicense' => [
                'name' => 'deletelicense',
                'label' => 'Lizenzen löschen',
                'value' => $group['deletelicense'],
            ],
            'createlicense' => [
                'name' => 'createlicense',
                'label' => 'Lizenzen erstellen',
                'value' => $group["createlicense"],
            ],
            'managefaq' => [
                'name' => 'managefaq',
                'label' => 'FAQ verwalten',
                'value' => $group['managefaq'],
            ],
            'modifyticket' => [
                'name' => 'modifyticket',
                'label' => 'Ticket bearbeiten',
                'value' => $group["modifyticket"],
            ],
            'modifyasset' => [
                'name' => 'modifyasset',
                'label' => 'Assets bearbeiten',
                'value' => $group['modifyasset'],
            ],
            'deleteasset' => [
                'name' => 'deleteasset',
                'label' => 'Assets löschen',
                'value' => $group['deleteasset'],
            ],
            'createasset' => [
                'name' => 'createasset',
                'label' => 'Assets erstellen',
                'value' => $group['createasset'],
            ],
            'departmentaccess' => [
                'name' => 'departmentaccess',
                'label' => 'Zugriff auf die Abteilungen',
                'value' => $group["departmentaccess"],
            ],
            'locationaccess' => [
                'name' => 'locationaccess',
                'label' => 'Zugriff auf die Standorte',
                'value' => $group["locationaccess"],
            ],
            'categoriesaccess' => [
                'name' => 'categoriesaccess',
                'label' => 'Zugriff auf die Kategorien',
                'value' => $group['categoriesaccess'],
            ],
            'manufactureraccess' => [
                'name' => 'manufactureraccess',
                'label' => 'Zugriff auf die Hersteller',
                'value' => $group['manufactureraccess'],
            ],
            'modelaccess' => [
                'name' => 'modelaccess',
                'label' => 'Zugriff auf die Modelle',
                'value' => $group['modelaccess'],
            ],
            'createticketcategories' => [
                'name' => 'createticketcategories',
                'label' => 'Kategorien erstellen',
                'value' => $group["createticketcategories"],
            ],
            'deleteticketcategories' => [
                'name' => 'deleteticketcategories',
                'label' => 'Kategorien löschen',
                'value' => $group['deleteticketcategories'],
            ],

            'createticketstatus' => [
                'name' => 'createticketstatus',
                'label' => 'Status erstellen',
                'value' => $group['createticketstatus'],
            ],
            'modifyticketstatus' => [
                'name' => 'modifyticketstatus',
                'label' => 'Status bearbeiten',
                'value' => $group['modifyticketstatus'],
            ],
            'deleteticketstatus' => [
                'name' => 'deleteticketstatus',
                'label' => 'Status löschen',
                'value' => $group["deleteticketstatus"],
            ],
            'ticketaccess' => [
                'name' => 'ticketaccess',
                'label' => 'Zugriff auf die Tickets',
                'value' => $group['ticketaccess'],
            ]


        ];
        $groupname = $group['name'];
        $pageTitle = "Gruppe {$groupname} bearbeiten";
        return view("admin.groupmanagement.edit", compact('pageTitle','groupname', 'group', 'permissions'));
    }

    public function update(Request $request) {
        if(!empty($request->post())) {
            $id = $request->route()->parameter("id");
            $oldname = $this->rights->getGroup($id);
            $oldname = $oldname['name'];
            $groupname = $request->post("name");

            $nameExist = $this->rights->checkIfExist($groupname);
            if($oldname != $groupname && $nameExist) {
                return redirect()->back()->with('error', ConfigController::GROUPNAMEALREADYEXIST);
            }

            $isadmin = $request->post("isadmin");
            $openTicket = $request->post("openticket");
            $closeTicket = $request->post("closeticket");
            $modifyticketcategories = $request->post("modifyticketcategories");
            $readticket = $request->post("readticket");
            $sendticketmessage = $request->post("sendticketmessage");
            $archiveaccess = $request->post("archiveaccess");
            $deletearchive = $request->post("deletearchive");
            $fullaccess = $request->post("fullaccess");
            $dashboardaccess = $request->post("dashboardaccess");
            $assetaccess = $request->post("assetaccess");
            $modifymodel = $request->post("modifymodel");
            $deletemodel = $request->post("deletemodel");
            $createmodel = $request->post("createmodel");
            $modifymanufacturer = $request->post("modifymanufacturer");
            $deletemanufacturer = $request->post("deletemanufacturer");
            $createmanufacturer = $request->post("createmanufacturer");
            $modifycategories = $request->post("modifycategories");
            $deletecategories = $request->post("deletecategories");
            $createcategories = $request->post("createcategories");
            $modifylocation = $request->post("modifylocation");
            $deletelocation = $request->post("deletelocation");
            $createlocation = $request->post("createlocation");
            $modifystatus = $request->post("modifystatus");
            $deletestatus = $request->post("deletestatus");
            $createstatus = $request->post("createstatus");
            $modifydepartment = $request->post("modifydepartment");
            $deletedepartment = $request->post("deletedepartment");
            $createdepartment = $request->post("createdepartment");
            $accesslicense = $request->post("accesslicense");
            $modifylicense = $request->post("modifylicense");
            $deletelicense = $request->post("deletelicense");
            $createlicense = $request->post("createlicense");
            $managefaq = $request->post("managefaq");
            $modifyticket = $request->post('modifyticket');
            $modifyasset = $request->post('modifyasset');
            $deleteasset = $request->post('deleteasset');
            $createasset = $request->post('createasset');
            $departmentaccess = $request->post('departmentaccess');
            $statusaccess = $request->post('statusaccess');
            $locationaccess = $request->post('locationaccess');
            $categoriesaccess = $request->post('categoriesaccess');
            $manufactureraccess = $request->post('manufactureraccess');
            $modelaccess = $request->post('modelaccess');
            $createticketcategories = $request->post('createticketcategories');
            $deleteticketcategories = $request->post('deleteticketcategories');
            $createticketstatus = $request->post('createticketstatus');
            $modifyticketstatus = $request->post('modifyticketstatus');
            $deleteticketstatus = $request->post('deleteticketstatus');
            $ticketaccess = $request->post('ticketaccess');

            $this->rights->where('id', $id)->update([
                'name' => $groupname,
                'isadmin' => $isadmin,
                'openticket' => $openTicket,
                'closeticket' => $closeTicket,
                'modifyticketcategories' => $modifyticketcategories,
                'readticket' => $readticket,
                'sendticketmessage' => $sendticketmessage,
                'archiveaccess' => $archiveaccess,
                'deletearchive' => $deletearchive,
                'fullaccess' => $fullaccess,
                'dashboardaccess' => $dashboardaccess,
                'assetaccess' => $assetaccess,
                'modifymodel' => $modifymodel,
                'deletemodel' => $deletemodel,
                'createmodel' => $createmodel,
                'modifymanufacturer' => $modifymanufacturer,
                'deletemanufacturer' => $deletemanufacturer,
                'createmanufacturer' => $createmanufacturer,
                'modifycategories' => $modifycategories,
                'deletecategories' => $deletecategories,
                'createcategories' => $createcategories,
                'modifylocation' => $modifylocation,
                'deletelocation' => $deletelocation,
                'createlocation' => $createlocation,
                'modifystatus' => $modifystatus,
                'deletestatus' => $deletestatus,
                'createstatus' => $createstatus,
                'modifydepartment' => $modifydepartment,
                'deletedepartment' => $deletedepartment,
                'createdepartment' => $createdepartment,
                'accesslicense' => $accesslicense,
                'modifylicense' => $modifylicense,
                'deletelicense' => $deletelicense,
                'createlicense' => $createlicense,
                'managefaq' => $managefaq,
                'modifyticket' => $modifyticket,
                'modifyasset' => $modifyasset,
                'deleteasset' => $deleteasset,
                'createasset' => $createasset,
                'departmentaccess' => $departmentaccess,
                'statusaccess' => $statusaccess,
                'locationaccess' => $locationaccess,
                'categoriesaccess' => $categoriesaccess,
                'manufactureraccess' => $manufactureraccess,
                'modelaccess' => $modelaccess,
                'createticketcategories' => $createticketcategories,
                'deleteticketcategories' => $deleteticketcategories,
                'createticketstatus' => $createticketstatus,
                'modifyticketstatus' => $modifyticketstatus,
                'deleteticketstatus' => $deleteticketstatus,
                'ticketaccess' => $ticketaccess,
                "updated_at" => now("Europe/Berlin")
            ]);
            event(new LogActionEvent(ConfigController::LOGSUPDATE, $this->rights->getTable(), $groupname));
            return redirect()->route("admin.groupmanagement")->with("success", ConfigController::GROUPEDITSUCCESS);
            }

    }

    public function delete(Request $request) {
        $id = $request['id'];
        $group = $this->rights->getGroup($id);
        if(in_array($id, ConfigController::SUPERGROUPS)) {
            return redirect()->route("admin.groupmanagement")->with("error", ConfigController::ISSUPERGROUP);
        }
        if(Ticket::where('group_id', $request->id)->exists()) return redirect()->route("admin.groupmanagement")->with("error", ConfigController::GROUPASSIGNEDTOTICKET);
        $groupname = $group["name"];
        $this->group->remGroupByGroupID($id);
        $this->rights->delGroup($id);

        event(new LogActionEvent(ConfigController::LOGSDELETE, $this->rights->getTable(), $groupname));
        return redirect()->route('admin.groupmanagement')->with("success", "Die Gruppe: $groupname wurde gelöscht!");
    }


}
