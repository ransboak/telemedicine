{{-- -------------------- Saved Messages -------------------- --}}
<?php 
use App\Models\Appointment;
use App\Models\ChMessage;
?>
@if($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            <div class="saved-messages avatar av-m">
                <span class="far fa-bookmark"></span>
            </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>

    </table>

    <?php
        if(Auth::user()->role == 'patient'){
            $appointments = Appointment::where('patient_id', Auth::user()->id)
                            ->where('status', 'Approved')
                            ->whereDate('scheduled_at', \Carbon\Carbon::today())
                            ->distinct('doctor_id')
                            ->get();
        }elseif(Auth::user()->role == 'doctor'){
            $appointments = Appointment::where('doctor_id', Auth::user()->id)
            ->where('status', 'Approved')
            ->whereDate('scheduled_at', \Carbon\Carbon::today())
            ->get();
        }

        
?>
    
    
        @foreach ($appointments as $appointment)
        <table class="messenger-list-item">
        @php
            $user = Auth::user();
            if($user->role == 'doctor'){
                $lastMessage = ChMessage::where('from_id', $user->id)
                        ->where('to_id', $appointment->patient->id)
                        // ->orWhere('to_id', $user->id)
                        ->latest()
                        ->first();
        
        // Count unseen messages where the user is the recipient
        $unseenCounter = ChMessage::where('to_id', $user->id)
                        ->where('seen', false)
                        ->count();
            }elseif($user->role == 'patient'){
                $lastMessage = ChMessage::where('from_id', $user->id)
                        ->where('to_id', $appointment->doctor->user->id)
                        // ->orWhere('to_id', $user->id)
                        ->latest()
                        ->first();
        
        // Count unseen messages where the user is the recipient
        $unseenCounter = ChMessage::where('to_id', $user->id)
                        ->where('seen', false)
                        ->count();
            }
            

                        $lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
                        $lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
        @endphp
        @if (!!$lastMessage)
        @if(Auth::user()->role == 'patient')
        <tr data-action="0">
            {{-- Avatar side --}}
            <td style="position: relative">
                @if($appointment->doctor->user->active_status)
                    <span class="activeStatus"></span>
                @endif
            <div class="avatar av-m"
            style="background-image:url('{{ asset('storage/users-avatar/' . $appointment->doctor->user->avatar) }}');">
            </div>
            </td>
            {{-- center side --}}
            <td>
            <p data-id="{{ $appointment->doctor->user->id }}" data-type="user">
                Dr. {{$appointment->doctor->user->name }}
                {{-- <span class="contact-item-time" data-time="{{$lastMessage->created_at}}">{{ $lastMessage->timeAgo }}</span> --}}
            </p>
            <span>
                {{-- Last Message user indicator --}}
                {!! $lastMessage->from_id == Auth::user()->id ? '<span class="lastMessageIndicator">You :</span>' : '' !!}
                {{-- Last message body --}}
                @if(is_null($lastMessage->attachment))
                    {!! $lastMessageBody !!}
                @else
                    <span class="fas fa-file"></span> Attachment
                @endif
            </span>
            {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
            
            {{-- New messages counter --}}
                
            </td>
        </tr>
        @elseif(Auth::user()->role == 'doctor')
        <tr data-action="0">
            {{-- Avatar side --}}
            <td style="position: relative">
                @if($appointment->patient->active_status)
                    <span class="activeStatus"></span>
                @endif
            <div class="avatar av-m"
            style="background-image:url('{{ asset('storage/users-avatar/' . $appointment->patient->avatar) }}');">
            </div>
            </td>
            {{-- center side --}}
            <td>
            <p data-id="{{ $appointment->patient->id }}" data-type="user">
                {{$appointment->patient->name }}
                {{-- <span class="contact-item-time" data-time="{{$lastMessage->created_at}}">{{ $lastMessage->timeAgo }}</span> --}}
            </p>
            <span>
                {{-- Last Message user indicator --}}
                {!! $lastMessage->from_id == Auth::user()->id ? '<span class="lastMessageIndicator">You :</span>' : '' !!}
                {{-- Last message body --}}
                @if(is_null($lastMessage->attachment))
                    {!! $lastMessageBody !!}
                @else
                    <span class="fas fa-file"></span> Attachment
                @endif
            </span>
            {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
            
            {{-- New messages counter --}}
                
            </td>
        </tr>
        @endif
    </table>
    @endif
    @endforeach
       
    
    
@endif

{{-- -------------------- Contact list -------------------- --}}
@if($get == 'users' && !!$lastMessage)
<?php
$lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
$lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
?>
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
        <div class="avatar av-m"
        style="background-image: url('{{ $user->avatar }}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $user->id }}" data-type="user">
            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
            <span class="contact-item-time" data-time="{{$lastMessage->created_at}}">{{ $lastMessage->timeAgo }}</span></p>
        <span>
            {{-- Last Message user indicator --}}
            {!!
                $lastMessage->from_id == Auth::user()->id
                ? '<span class="lastMessageIndicator">You :</span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {!!
                $lastMessageBody
            !!}
            @else
            <span class="fas fa-file"></span> Attachment
            @endif
        </span>
        {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
    </tr>
</table>
@endif



{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
        <div class="avatar av-m"
        style="background-image: url('{{asset('storage/users-avatar/' . $user->avatar)}}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
            @if($user->role == 'doctor')
            Dr. {{$user->name }}
            @else
            {{$user->name }}
            @endif
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif


