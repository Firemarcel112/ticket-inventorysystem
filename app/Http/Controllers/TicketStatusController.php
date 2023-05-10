<?php

namespace App\Http\Controllers;

use App\Events\LogActionEvent;
use App\Http\Requests\TicketStatusStoreRequest;
use App\Models\GroupRightsModel;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Illuminate\Http\Request;



class TicketStatusController extends Controller
{
    protected GroupRightsModel $rights;

    public function __construct(GroupRightsModel $rights)
    {
        $this->rights = $rights;
    }


    public function index(Request $request)
    {
        if (!$this->rights->checkIfAllRightsController(['modifyticketstatus'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Ticketstatus Dashboard";
        $statuses = TicketStatus::all();

        if ($request->search) {
            $search = TicketStatus::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if (empty($search[0])) {
                return redirect()->route("ticket.status.dashboard")->with("info", "Es konnte kein Status unter \"" . $request->search . "\" gefunden werden!");
            } else {
                $statuses = $search;
            }
        }
        return view("ticket.status.dashboard", compact('pageTitle', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->rights->checkIfAllRightsController(['createticketstatus'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = 'Ticketstatus erstellen';

        return view("ticket.status.create", compact('pageTitle'));
    }


    public function store(TicketStatusStoreRequest $request)
    {
        if (!$this->rights->checkIfAnyRight(['createticketstatus', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        TicketStatus::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'ticket_statuses', $request->name));

        return redirect()->back()->with('success', 'Status wurde erstellt');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketStatus $ticketstatus)
    {
        if (!$this->rights->checkIfAllRightsController(['modifyticketstatus'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);

        $pageTitle = "Status {$ticketstatus->name} bearbeiten";

        return view("ticket.status.edit", compact("ticketstatus", "pageTitle"));
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
        if (!$this->rights->checkIfAllRightsController(['modifyticketstatus'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $ticketstatus = TicketStatus::find($id);
        if(TicketStatus::where('name', $request->name)->exists() && ($ticketstatus->name != $request->name)) return redirect()->route('ticket.status.edit', $id)->with('error', ConfigController::ASSETSTATUSALREADYEXIST);

        $ticketstatus->name = $request->name;
        $ticketstatus->color = $request->color;
        $ticketstatus->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'ticket_statuses', $request->name));
        return redirect()->route("ticket.status.dashboard")->with('success', 'Der Status wurde aktuallisiert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketStatus $ticketstatus)
    {
        if (!$this->rights->checkIfAllRightsController(['deleteticketstatus'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        if (Ticket::where('status_id', $ticketstatus->id)->exists()) return redirect()->route("ticket.status.dashboard")->with("error", ConfigController::TICKETSTATUSCANTDELETE);
        $ticketstatus->delete();

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'ticket_statuses', $ticketstatus->name));
        return redirect()->route("ticket.status.dashboard")->with("success", "Der Status wurde gelöscht!");
    }
}
