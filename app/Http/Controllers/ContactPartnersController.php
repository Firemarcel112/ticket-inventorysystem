<?php

namespace App\Http\Controllers;

use App\Models\ContactPartner;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;
use Exception;

class ContactPartnersController extends Controller
{
    protected GroupRightsModel $groupRightsModel;
    protected ImageController $imageController;

    public function __construct(GroupRightsModel $groupRightsModel, ImageController $imageController)
    {
        $this->groupRightsModel = $groupRightsModel;
        $this->imageController = $imageController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight()) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = 'Ansprechtpartner Verwaltung';
        $contactPartners = ContactPartner::all();
        if ($request->search) {
            $search = ContactPartner::where('firstname', 'LIKE', '%' . $request->search . '%')->orWhere('lastname' , 'LIKE' , '%' . $request->search . '%')->get();
            if (empty($search[0])) {
                return redirect()->route('admin.contactmanagement')->with('info', "Es konnte keine Benutzer unter \"" . $request->search . "\" gefunden werden!");
            } else {
                $contactPartners = $search;
            }
        }

        return view('admin.contactpartners.management', compact('pageTitle', 'contactPartners'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->groupRightsModel->checkIfAnyRight()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = 'Neuen Ansprechpartner erstellen';

        return view('admin.contactpartners.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (ContactPartner::where('firstname', $request->firstname)->where('lastname', $request->lastname)->exists()) return redirect()->back()->with('error', ConfigController::CONTACTPARTNERALREADYEXISTS);

        try {
            $imagepath = $this->imageController->create($request->image, ConfigController::IMAGEPATHPARTNERS, ConfigController::IMAGESIZEPARTNERS);
        } catch (Exception $e) {
            return redirect()->route('admin.contactcreate')->with('error', $e->getMessage());
        }

        if (empty($request->post("visiblefrontpage"))) {
            $request->request->set('visiblefrontpage', 0);
        } else {
            $request->request->set('visiblefrontpage', 1);
        }
        $request->request->add([
            'imagepath' => $imagepath,
        ]);
        ContactPartner::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'contact_partners', $request->firstname . ' ' . $request->lastname));
        return redirect()->route('admin.contactmanagement')->with('success', ConfigController::CONTACTPARTNERSUCCESS);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactPartner $contactpartner)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $pageTitle = "{$contactpartner->firstname} {$contactpartner->lastname} bearbeiten";
        return view('admin.contactpartners.edit', compact('contactpartner', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $contactPartner = ContactPartner::find($id);
        if (empty($request->post("visiblefrontpage"))) {
            $visible = 0;
        } else {
            $visible = 1;
        }
        if (ContactPartner::where('firstname', $request->firstname)->where('lastname', $request->lastname)->exists() && ($request->firstname != $contactPartner->firstname || $request->lastname != $contactPartner->lastname)) return redirect()->back()->with("error", ConfigController::CONTACTPARTNERALREADYEXISTS);

        if ($request->image) {
            try {
                $image = $request->image;
                $filename = $this->imageController->create($image, ConfigController::IMAGEPATHPARTNERS, ConfigController::IMAGESIZEPARTNERS);
                $deleteName = $contactPartner->imagepath;
                $this->imageController->delete($deleteName);
            } catch (Exception $e) {
                return redirect()->route('admin.contactedit', $request->id)->with('error', $e->getMessage());
            }
        } else {
            $filename = $contactPartner->imagepath;
        }
        $contactPartner->firstname = $request->firstname;
        $contactPartner->lastname = $request->lastname;
        $contactPartner->visiblefrontpage = $visible;
        $contactPartner->imagepath = $filename;
        $contactPartner->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'contact_partners', $request->firstname . ' ' . $request->lastname));
        return redirect()->route('admin.contactmanagement')->with('success', "Der Ansprechpartner {$request->firstname} {$request->lastname} wurde bearbeitet!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactPartner $contactpartner) {
        if (!$this->groupRightsModel->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $contactpartner->delete();
        $this->imageController->delete($contactpartner->imagepath);

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'contact_partners', $contactpartner->firstname, ' ' . $contactpartner->lastname));
        return redirect()->route('admin.contactmanagement')->with('success', ConfigController::CONTACTPARTNERDELETESUCCESS);
    }
}

