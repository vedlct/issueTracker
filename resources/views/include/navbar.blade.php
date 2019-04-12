<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect"><i class="ion-close"></i></button>
    <div class="left-side-logo d-block d-lg-none">
        <div>
            <h3 class="text-center">Issue Tracker</h3>
            {{--<a href="{{route('index')}}" class="logo"><img src="{{url('public/images/logo-dark.png')}}" height="20" alt="logo"></a>--}}
        </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>

                {{-- Dashboard --}}
                <li>
                    <a href="{{route('index')}}" class="waves-effect">
                        <i class="dripicons-blog"></i> <span> Dashboard </span>
                    </a>
                </li>

                {{-- All Company Settings --}}
                @if(Auth::user()->fk_userTypeId == 1)
                    <li class="has_sub"><a href="{{ route('company.showAllCompany') }}" class="waves-effect"><i class="fa fa-cogs"></i> <span>Company Management</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('company.showAllCompany')}}" class="waves-effect"><i class="fa fa-university"></i> <span> All Company </span></a></li>
                        </ul>
                    </li>
                @endif

                {{-- Manage My Company --}}
                @if(Auth::user()->fk_userTypeId == 4)
                    <li class="has_sub"><a href="{{ route('company.showAllCompany') }}" class="waves-effect"><i class="fa fa-cogs"></i> <span>Manage My Company</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('mycompany')}}" class="waves-effect"><i class="fa fa-university"></i> <span> Company Settings </span></a></li>
                            <li><a href="{{route('mycompany.departments')}}" class="waves-effect"><i class="fa fa-server"></i> <span> Department Settings </span></a></li>
                            <li><a href="{{route('mycompany.designation')}}" class="waves-effect"><i class="fa fa-id-badge"></i> <span> Designation Settings </span></a></li>
                        </ul>
                    </li>
                @endif

                {{-- Only For Super Admin --}}
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


                <li class="has_sub"><a href="{{ route('project.showAllProject') }}" class="waves-effect"><i class="fa fa-hashtag fa-"></i> <span>Project Management</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('project.showAllProject') }}" class="waves-effect">Projects</a></li>

                        @if(Auth::user()->fk_userTypeId == 1 || Auth::user()->fk_userTypeId == 3 || Auth::user()->fk_userTypeId == 4)
                            <li><a href="{{ route('project.projectList') }}" class="waves-effect">Project Management</a></li>
                        @endif

                        @if(Auth::user()->fk_userTypeId == 3)
                            <li><a href="{{ route('project.BacklogManagement.todayWork') }}" class="waves-effect">Today' Work</a></li>
                        @endif

                    </ul>
                </li>


                <li class="has_sub"><a href="{{ route('ticket.showAllCTicket') }}" class="waves-effect"><i class="fa fa-ticket"></i> <span>Ticket</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('ticket.showAllCTicket') }}" class="waves-effect">All Ticket</a></li>
                        <li><a href="{{ route('ticket.show.generateExcel') }}" class="waves-effect">Genarate Excel</a></li>
                    </ul>
                </li>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end sidebarinner -->
</div>
