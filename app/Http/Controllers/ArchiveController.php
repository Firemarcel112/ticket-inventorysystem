<?php

namespace App\Http\Controllers;

use App\Models\GroupRightsModel;
use App\Models\Ticket;
use App\Models\TicketArchive;
use App\Models\TicketArchiveMessage;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;


class ArchiveController extends Controller
{

    protected TicketArchiveMessage $ticketArchiveMessage;
    protected GroupRightsModel $groupRightsModel;

    public function __construct(GroupRightsModel $groupRightsModel, TicketArchiveMessage $ticketMessage)
    {
        $this->groupRightsModel = $groupRightsModel;
        $this->ticketArchiveMessage = $ticketMessage;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['archiveaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);

        $overdueTickets = TicketArchive::whereDate('archived_at', now()->subDays(ConfigController::DAYSUNTILDELETED)->setTime(0,0,0)->toDateTimeString());
        foreach ($overdueTickets as $delete) {
            $this->ticketArchiveMessage->deleteImages($delete->ticket_id);
            $this->ticketArchiveMessage->where('ticket_id', $delete->ticket_id)->delete();
            $delete->delete();
        }
        $pageTitle = "Ticket Übersicht";
        $tickets = TicketArchive::all();
        if ($request->search) {
            $search = TicketArchive::where('headline', 'LIKE', '%' . $request->search . '%')->orWhere('ticket_id', $request->search)->get();
            if (empty($search[0])) {
                return redirect()->route('ticket.archive.dashboard')->with('info', "Es konnte keine Tickets unter \"" . $request->get('search') . "\" gefunden werden!");
            } else {
                $tickets = $search;
            }
        }
        return view('ticket.archive.dashboard', compact('pageTitle', 'tickets'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(TicketArchive $ticket)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['archiveaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $ticket->with('messages');
        $pageTitle = $ticket->headline;
        return view('ticket.archive.post', compact('pageTitle', 'ticket'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TicketArchive $ticket)
    {
        if (!$this->groupRightsModel->checkIfAllRightsController(['deletearchive'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $images = TicketArchiveMessage::where('ticket_id', $ticket->ticket_id)->get();
        foreach ($images as $image) {
            $files = explode("|", $image['images']);
            foreach ($files as $file) {
                if($file != "") {
                    unlink($file);
                }
            }
        }
        TicketArchiveMessage::where('ticket_id', $ticket->ticket_id)->delete();
        $ticket->delete();

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'ticket_archives', $ticket->headline));

        return redirect()->route('ticket.archive.dashboard')->with('success', ConfigController::TICKETDELETED);
    }

    public function moveToArchive($daysUntilArchived = ConfigController::DAYSUNTILARCHIVED)
    {
        $tickets = Ticket::with('category')
            ->whereDate('updated_at', '<=', now()->subDays(ConfigController::DAYSUNTILDELETED)->setTime(0, 0, 0)->toDateTimeString())
            ->Where('status_id', ConfigController::STATUSCLOSED)
            ->orWhere('status_id', ConfigController::STATUSARCHIVED)->get();


        foreach ($tickets as $ticket) {
            $this->moveFilesToArchive($ticket->id);

            TicketArchive::create([
                'ticket_id' => $ticket->id,
                'headline' => $ticket->headline,
                'username' => $ticket->user->username,
                'content' => $ticket->content,
                'category' => $ticket->category->name,
                'assigned_to' => $ticket->assigner->username,
                'archived_at' => now('Europe/Berlin'),
            ]);

            foreach ($ticket->messages as $message) {
                TicketArchiveMessage::create([
                    'ticket_id' => $ticket->id,
                    'username' => $message->user->username,
                    'message' => $message->message,
                    'images' => str_replace(ConfigController::IMAGEPATHTICKET, ConfigController::IMAGEPATHARCHIVE, $message->images),
                ]);
                $message->delete();
            }
            $ticket->delete();
            event(new LogActionEvent(ConfigController::LOGSARCHIVE, 'ticket_archives', $ticket->headline));
        }
        return true;
    }

    public function moveFilesToArchive($ticketid, $folder = ConfigController::IMAGEPATHARCHIVE)
    {
        $tickets = TicketMessage::where('ticket_id', $ticketid)->get();
        foreach ($tickets as $images) {
            $moveImages = explode('|', $images->images);
            foreach ($moveImages as $image) {
                $fileMove = str_replace(ConfigController::IMAGEPATHTICKET, $folder, $image);
                if ($image != '' && $fileMove != '') {
                    copy(public_path($image), public_path($fileMove));
                    unlink($image);
                }
            }
        }
    }
}
