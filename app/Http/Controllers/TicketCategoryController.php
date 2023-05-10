<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCategoryStoreRequest;
use App\Models\GroupRightsModel;
use App\Events\LogActionEvent;
use App\Models\TicketCategory;
use Illuminate\Http\Request;


class TicketCategoryController extends Controller
{
    protected GroupRightsModel $rights;

    public function __construct(GroupRightsModel $right)
    {
        $this->rights = $right;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if (!$this->rights->checkIfAllRightsController(['modifyticketcategories'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Ticketkategorie Dashboard";
        $categories = TicketCategory::all();

        if ($request->get("search")) {
            $search = TicketCategory::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if (empty($search[0])) {
                return redirect()->route("ticket.categories.dashboard")->with("info", "Es konnte keine Kategorie unter \"" . $request->search . "\" gefunden werden!");
            } else {
                $categories = $search;
            }
        }
        return view("ticket.categories.dashboard", compact('pageTitle', 'categories'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->rights->checkIfAllRightsController(['createticketcategories'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = 'Ticketkategorie erstellen';

        return view("ticket.categories.create", compact('pageTitle'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TicketCategoryStoreRequest $request)
    {
        if (!$this->rights->checkIfAllRightsController(['createticketcategories'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);

        TicketCategory::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'ticket_categories', $request->name));
        return redirect()->back()->with('success', ConfigController::CATEGORYCREATESUCCESS);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(TicketCategory $ticketcategory)
    {
        if (!$this->rights->checkIfAllRightsController(['modifyticketcategories'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);

        $pageTitle = "Kategorie {$ticketcategory->name} bearbeiten";

        return view('ticket.categories.edit', compact('ticketcategory', 'pageTitle'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request, $id)
    {
        if (!$this->rights->checkIfAllRightsController(['modifyticketcategories'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $ticketcategory = TicketCategory::find($id);
        if (TicketCategory::where('name', $request->name)->exists() && $ticketcategory->name != $request->name) return redirect()->back()->with("error", ConfigController::CATEGORYALREADYEXIST);

        $ticketcategory->name = $request->name;
        $ticketcategory->save();
        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'ticket_categories', $request->name));
        return redirect()->route("ticket.categories.dashboard")->with("success", ConfigController::CATEGORYCHANGED);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(TicketCategory $ticketcategory)
    {
        if (!$this->rights->checkIfAllRightsController(['deleteticketcategories'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        if (!is_null($ticketcategory->tickets->first())) return redirect()->route("ticket.categories.dashboard")->with("error", ConfigController::CATEGORYCANTDELETE);

        $ticketcategory->delete();

        return redirect()->route("ticket.categories.dashboard")->with("success", ConfigController::CATEGORYDELETEDSUCCESS);
    }
}
