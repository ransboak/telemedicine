<div>
    @if ($lastMessage)
        <table class="messenger-list-item">
            @foreach ($appointments as $appointment)
                @if (Auth::user()->role == 'patient')
                    <tr data-action="0">
                        {{-- Avatar side --}}
                        <td style="position: relative">
                            @if($appointment->doctor->user->active_status)
                                <span class="activeStatus"></span>
                            @endif
                            <div class="avatar av-m" style="background-image:url('{{ asset('storage/users-avatar/' . $appointment->doctor->user->avatar) }}');"></div>
                        </td>
                        {{-- center side --}}
                        <td>
                            <p data-id="{{ $appointment->doctor->user->id }}" data-type="user">
                                Dr. {{ $appointment->doctor->user->name }}
                                <span class="contact-item-time" data-time="{{ $lastMessage->created_at }}">{{ $lastMessage->timeAgo }}</span>
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
                        </td>
                    </tr>
                @elseif (Auth::user()->role == 'doctor')
                    <tr data-action="0">
                        {{-- Avatar side --}}
                        <td style="position: relative">
                            @if($appointment->patient->active_status)
                                <span class="activeStatus"></span>
                            @endif
                            <div class="avatar av-m" style="background-image:url('{{ asset('storage/users-avatar/' . $appointment->patient->avatar) }}');"></div>
                        </td>
                        {{-- center side --}}
                        <td>
                            <p data-id="{{ $appointment->patient->id }}" data-type="user">
                                {{ $appointment->patient->name }}
                                {{-- <span class="contact-item-time" data-time="{{ $lastMessage->created_at }}">{{ $lastMessage->timeAgo }}</span> --}}
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
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    @endif
</div>
