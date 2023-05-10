<?php

namespace App\Http\Controllers;

use App\Events\LogActionEvent;
use App\Models\GroupRightsModel;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;


class TicketMessageController extends Controller
{

    protected ImageController $imageController;
    protected GroupRightsModel $rights;

    public function __construct(ImageController $imageController,GroupRightsModel $rights) {
        $this->imageController = $imageController;
        $this->rights = $rights;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if (!$this->rights->checkIfAllRightsController(['sendticketmessage'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        if(!empty($request->file('imgUpload'))) {
            if(count($request->file('imgUpload')) > ConfigController::LIMITUPLOADEDIMAGES ) {
                return redirect()->back()->withInput()->with('error', ConfigController::TOOMANYIMAGES);
            }
            $result = [];
            foreach($request->file('imgUpload') as $validateImage) {
                try {
                    $this->imageController->validateImage($validateImage, ConfigController::IMAGEPATHTICKET, ConfigController::IMAGESIZETICKET);
                } catch(Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }
            foreach($request->file('imgUpload') as $file) {
                try {
                    $result[] = $this->imageController->create($file, ConfigController::IMAGEPATHTICKET, ConfigController::IMAGESIZETICKET);
                } catch(Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }

            $result = implode('|', $result);
        }
        else {
            $result = "";
        }

        $ticket = Ticket::find($id);

        $request->request->add([
            'images' => $result,
            'user_id' => Auth::id(),
            'ticket_id' => $id,
        ]);
        TicketMessage::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'ticket_messages', $id, $ticket->headline));

        if($ticket->status_id == ConfigController::STATUSNEW && $ticket->user_id != Auth::id()) {
            $ticket->status_id = ConfigController::STATUSINEDIT;
            $ticket->assigner_id = ConfigController::TICKETUSER;
            $ticket->save();
        }

        return redirect()->to(route('ticket.post', $id) . '#submitResponse');


    }

}
