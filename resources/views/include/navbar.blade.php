<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect"><i class="ion-close"></i></button>
    <div class="left-side-logo d-block d-lg-none">
        <div>Issue Tracker</h2>
            {{--<a href="{{route('index')}}" class="logo"><img src="{{url('public/images/logo-dark.png')}}" height="20" alt="logo"></a>--}}
        </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{route('index')}}" class="waves-effect">
                        <i class="dripicons-blog"></i> <span> Dashboard </span>
                    </a>
                </li>

                @if(Auth::user()->fk_userTypeId == 1)
                    <li>
                        <a href="{{route('company.showAllCompany')}}" class="waves-effect">
                            <i class="fa fa-address-card"></i> <span> Company </span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->fk_userTypeId == 1)
                    <li class="has_sub"><a href="{{ route('user.show.allEmployee') }}" class="waves-effect"><i class="fa fa-users"></i> <span>User Management</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('user.show.allAdmin') }}" class="waves-effect">All Admin</a></li>
                            <li><a href="{{ route('user.show.allEmployee') }}" class="waves-effect">All Employee</a></li>
                            <li><a href="{{ route('user.show.allClient') }}" class="waves-effect">All Client</a></li>
                            <li><a href="{{ route('user.add.employee') }}" class="waves-effect">Add Employee</a></li>
                            <li><a href="{{ route('add.client') }}" class="waves-effect">Add Client</a></li>

                            <li><a href="{{ route('add.company.admin') }}" class="waves-effect">Add Company Admin</a></li>
                        </ul>
                    </li>
                @else
                    @if(Auth::user()->fk_userTypeId == 4)
                        <li class="has_sub"><a href="{{ route('user.show.allEmployee') }}" class="waves-effect"><i class="fa fa-users"></i> <span>User Management</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                {{--<li><a href="{{ route('user.show.allAdmin') }}" class="waves-effect">All Admin</a></li>--}}
                                <li><a href="{{ route('user.show.allEmployee') }}" class="waves-effect">All Employee</a></li>
                                <li><a href="{{ route('user.show.allClient') }}" class="waves-effect">All Client</a></li>
                                <li><a href="{{ route('user.add.employee') }}" class="waves-effect">Add Employee</a></li>
                                <li><a href="{{ route('add.client') }}" class="waves-effect">Add Client</a></li>
                                {{--<li><a href="{{ route('add.company.admin') }}" class="waves-effect">Add Company Admin</a></li>--}}
                            </ul>
                        </li>
                    @endif
                @endif

                @if(Auth::user()->fk_userTypeId == 1)
                    <li class="has_sub"><a href="{{ route('assignteam.showAllteam') }}" class="waves-effect"><i class="fa fa-user-circle"></i> <span>Team management</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('assignteam.showAllteam') }}" class="waves-effect">Team list</a></li>
                            <li><a href="{{ route('team.assign') }}" class="waves-effect">Assign Member To Team</a></li>
                            <li><a href="{{ route('assign.team.member') }}" class="waves-effect">Team Members List</a></li>
                        </ul>
                    </li>
                @endif


                <li class="has_sub"><a href="{{ route('project.showAllProject') }}" class="waves-effect"><i class="fa fa-hashtag"></i> <span>Project</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('project.showAllProject') }}" class="waves-effect">Project Information</a></li>
                    </ul>
                </li>

                <li class="has_sub"><a href="{{ route('ticket.showAllCTicket') }}" class="waves-effect"><i class="fa fa-ticket"></i> <span>Ticket</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('ticket.showAllCTicket') }}" class="waves-effect">All Ticket</a></li>
                    </ul>
                </li>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end sidebarinner -->
</div>
