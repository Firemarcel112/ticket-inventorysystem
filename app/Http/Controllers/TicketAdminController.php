<?php

namespace App\Http\Controllers;

use App\Models\GroupDetailModel;
use App\Models\GroupRightsModel;
use App\Events\LogActionEvent;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketAdminController extends Controller
{
    protected Ticket $ticket;
    protected ArchiveController $archiveController;
    protected GroupRightsModel $groupRightsModel;

    public function __construct(Ticket $ticket, ArchiveController $archiveController, GroupRightsModel $groupRightsModel)
    {
        $this->archiveController = $archiveController;
        $this->groupRightsModel = $groupRightsModel;
        $this->ticket = $ticket;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['ticketaccess', 'readticket'])) {
            return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        }
        $this->archiveController->moveToArchive(); // TODO cronjob
        $pageTitle = "Ticket Übersicht";
        $tickets = Ticket::with('user')->with('category')->with('assigner')->with('group')->get();

        if ($request->get('search')) {
            $search = Ticket::where('headline', 'LIKE', '%' . $request->search . '%')->get();
            if (empty($search[0])) {
                return redirect()->route("ticket.dashboard")->with("info", "Es konnte keine Tickets unter \"" . $request->get('search') . "\" gefunden werden!");
            } else {
                $tickets = $search;
            }
        }
        return view('ticket.dashboard', compact('pageTitle', 'tickets'));

    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function edit(Ticket $ticket)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifyticket', 'ticketaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Ticket '{$ticket->headline}' bearbeiten";

        $allowedUsersQuery = GroupDetailModel::with(['group' => function ($query) {
            $query->where('isadmin', 'GRANT')->orWhere('readticket', 'GRANT');
        }])->get();
        $allowedUsers = [];
        $allowedGroups = GroupRightsModel::where('isadmin', 'GRANT')->orWhere('readticket', 'GRANT')->get();
        foreach ($allowedUsersQuery as $allowed) {
            if (!is_null($allowed->group)) {
                $allowedUsers[] = $allowed->user;
            }
        }

        $categories = TicketCategory::all();
        $statuses = TicketStatus::all();
        return view('ticket.edit', compact('pageTitle', 'ticket', 'allowedUsers', 'allowedGroups', 'categories', 'statuses'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->status_id = $request->status_id;
        $ticket->category_id = $request->category_id;
        $ticket->assigner_id = $request->assigner_id;
        $ticket->group_id = $request->group_id;
        $ticket->save();
        //create log entry
        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'tickets', $ticket->headline, $ticket->id));
        return redirect()->route("ticket.dashboard")->with("success", ConfigController::TICKETEDITSUCCESS);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * USED IN ROUTE
     */
    public function closeTicket($id)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['closeticket', 'ticketaccess']) && Auth::id() != Ticket::find($id)->user_id) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $ticket = Ticket::find($id);
        $ticket->status_id = ConfigController::STATUSCLOSED;
        $ticket->save();

        event(new LogActionEvent(ConfigController::LOGSCLOSETICKET, 'tickets', $ticket->headline));
        $prevURL = url()->previous();
        $route = app('router')->getRoutes($prevURL)->match(app('request')->create($prevURL))->getName();

        /**
         * TODO Abfrage wenn isAdmin weiterleitung zum TicketDashboard einfügen
         * Erst wenn Eloquent eingefügt ist
         */
        if ($route == 'ticket.dashboard') return redirect()->route('ticket.dashboard')->with('success', ConfigController::TICKETCLOSED);

        return redirect()->route('dashboard')->with('success', ConfigController::TICKETCLOSED);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * USED IN ROUTE
     */
    public function openTicket($id)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['openticket', 'ticketaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $ticket = Ticket::find($id);
        $ticket->status_id = ConfigController::STATUSINEDIT;
        $ticket->save();

        event(new LogActionEvent(ConfigController::LOGSOPENTICKET, 'tickets', $ticket->headline, $ticket->id));

        return redirect()->route('ticket.dashboard')->with('success', ConfigController::TICKETOPENED);
    }



}
