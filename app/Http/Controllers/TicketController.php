<?php

namespace App\Http\Controllers;

use App\Events\LogActionEvent;
use App\Http\Requests\TicketStoreRequest;
use App\Models\GroupRightsModel;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    protected GroupRightsModel $rights;

    public function __construct(GroupRightsModel $rights)
    {
        $this->rights = $rights;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {

        if (!$this->rights->checkIfAllRightsController(['openticket'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $pageTitle = 'Ticket Dashboard von: ' . Auth::user()->username;

        $tickets = Ticket::where('user_id', Auth::id())->whereNot('status_id', ConfigController::STATUSCLOSED)->get();

        return view('dashboard', compact('pageTitle', 'tickets'));
    }


    public function create()
    {
        if (!$this->rights->checkIfAllRightsController(['openticket'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Ticket erstellen";

        if (Ticket::where('user_id', Auth::id())->get()->count() >= ConfigController::MAXTICKETAMOUNTS) return redirect()->route('dashboard')->with('error', ConfigController::MAXTICKETSREACHED);

        $categories = TicketCategory::all();

        return view("ticket.create", compact('categories', 'pageTitle'));
    }


    public function store(TicketStoreRequest $request)
    {
        if (!$this->rights->checkIfAllRightsController(['openticket'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);

        $request->request->add([
            'assigner_id' => ConfigController::TICKETUSER,
            'user_id' => Auth::id(),
            'group_id' => ConfigController::TICKETGROUP,
            'status_id' => ConfigController::STATUSNEW,
        ]);

        Ticket::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'tickets', $request->headline));

        return redirect()->back()->with('success', ConfigController::TICKETCREATEDSUCCESS);
    }


    public function show(Ticket $ticket)
    {
        if (!$this->rights->checkIfAnyRight(['ticketaccess', 'readticket']) && $ticket->user_id != Auth::user()->id) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $ticketMessages = $ticket->messages()->get();
        $pageTitle = "Ticket {$ticket->headline}";
        return view("ticket.post", compact('pageTitle', 'ticketMessages', 'ticket'));
    }
}
