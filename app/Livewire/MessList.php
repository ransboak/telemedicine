<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\ChMessage;

class MessList extends Component
{
    public $appointments;
    public $lastMessage;
    public $unseenCounter;
    public $lastMessageBody;

    protected $listeners = ['messageSent' => 'fetchData'];

    public function mount()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $user = Auth::user();

        if ($user->role == 'patient') {
            $this->appointments = Appointment::where('patient_id', $user->id)->distinct('doctor_id')->get();
        } else {
            $this->appointments = Appointment::where('doctor_id', $user->id)->get();
        }

        $this->lastMessage = ChMessage::where('from_id', $user->id)
                            ->orWhere('to_id', $user->id)
                            ->latest()
                            ->first();
        
        $this->unseenCounter = ChMessage::where('to_id', $user->id)
                            ->where('seen', false)
                            ->count();

        if ($this->lastMessage) {
            $this->lastMessageBody = mb_convert_encoding($this->lastMessage->body, 'UTF-8', 'UTF-8');
            $this->lastMessageBody = strlen($this->lastMessageBody) > 30 ? mb_substr($this->lastMessageBody, 0, 30, 'UTF-8').'..' : $this->lastMessageBody;
        } else {
            $this->lastMessageBody = '';
        }
    }

    public function render()
    {
        return view('livewire.mess-list');
    }
}
