@php
 use App\Models\Appointment;
@endphp
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="{{route('home')}}" class="logo">
                <img src="{{asset('assets/images/default-logo.png')}}" class="img-fluid" alt="img">
            </a>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect"><i class="mdi mdi-home-analytics"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{route('appointments')}}" class="waves-effect"><i class="mdi mdi-home-analytics"></i><span>Appointments</span></a>
                </li>
                @if (Auth::user()->role == 'admin')
                <li>
                    <a href="{{route('view.doctors')}}" class="waves-effect"><i class="mdi mdi-home-analytics"></i><span>Doctors</span></a>
                </li>
                @endif
                
                @php
                if (Auth::user()->role == 'patient'){
                    $consultation = Appointment::where('patient_id', Auth::user()->id)->where('status', 'Approved')->whereDate('scheduled_at', \Carbon\Carbon::today())->count();
                }else{
                    $consultation = Appointment::where('doctor_id', Auth::user()->id)->where('status', 'Approved')->whereDate('scheduled_at', \Carbon\Carbon::today())->count();
                }
                @endphp
                @if (Auth::user()->role == 'patient')
                @if($consultation > 0)
                <li>
                    <a href="{{route('chat')}}" class="waves-effect"><i class="mdi mdi-home-analytics"></i><span
                        class="badge badge-pill badge-primary float-right">{{$consultation}}</span><span>Consultation Room</span></a>
                </li>
                @endif
                @else
                <li>
                    <a href="{{route('chat')}}" class="waves-effect"><i class="mdi mdi-home-analytics"></i><span
                        class="badge badge-pill badge-primary float-right">{{$consultation}}</span><span>Consultation Room</span></a>
                </li>
                @endif
                

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-diamond-stone"></i><span>UI Elements</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-buttons.html">Buttons</a></li>
                        <li><a href="ui-cards.html">Cards</a></li>
                        <li><a href="ui-carousel.html">Carousel</a>
                        <li><a href="ui-embeds.html">Embeds</a>
                        <li><a href="ui-general.html">General</a></li>
                        <li><a href="ui-grid.html">Grid</a></li>
                        <li><a href="ui-media-objects.html">Media Objects</a></li>
                        <li><a href="ui-modals.html">Modals</a></li>
                        <li><a href="ui-progressbars.html">Progress Bars</a></li>
                        <li><a href="ui-tabs.html">Tabs</a></li>
                        <li><a href="ui-typography.html">Typography</a></li>
                        <li><a href="ui-toasts.html">Toasts</a></li>
                        <li><a href="ui-tooltips-popovers.html">Tooltips & Popovers</a></li>
                        <li><a href="ui-scrollspy.html">Scrollspy</a></li>
                        <li><a href="ui-spinners.html">Spinners</a></li>
                        <li><a href="ui-sweetalerts.html">Sweet Alerts</a></li>
                    </ul>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>