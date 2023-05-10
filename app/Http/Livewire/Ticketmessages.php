<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;

class Ticketmessages extends Component
{
    public int $ticketID;

    public function render() {
        $ticket = Ticket::find($this->ticketID);
        $ticketMessages = $ticket->messages()->get();

        return view('livewire.ticketmessages', compact('ticket', 'ticketMessages'));
    }
}
