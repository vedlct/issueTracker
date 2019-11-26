<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect"><i class="ion-close"></i></button>
    <div class="left-side-logo d-block d-lg-none">
        <div>ISP</h2>
            
        </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li>
                    <a href="<?php echo e(route('index')); ?>" class="waves-effect">
                        <i class="dripicons-blog"></i> <span>Dashboard </span>
                    </a>
                </li>
                <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-meter"></i> <span>Package </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <?php if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="InternetEmp"): ?>
                        <li><a href="<?php echo e(route('package.show')); ?>" class="waves-effect">Internet Package</a></li>
                        <?php endif; ?>
                            <?php if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="CableEmp"): ?>
                        <li><a href="<?php echo e(route('package.cable.show')); ?>" class="waves-effect">Cable Package</a></li>
                            <?php endif; ?>

                    </ul>
                </li>



                <?php if(Auth::user()->fkusertype=="Admin"): ?>
                <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span>HRM </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo e(route('employee.show')); ?>" class="waves-effect">
                                <i class="fa fa-empire"></i> <span>Employee List</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('employee.getSalary')); ?>" class="waves-effect">
                                <i class="fa fa-empire"></i> <span>Payrole</span>
                            </a>
                        </li>
                        
                    </ul>

                </li>
                    <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span>Settings </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="<?php echo e(route('sms.config')); ?>" class="waves-effect">
                                    <i class="fa fa-empire"></i> <span>SMS-Config</span>
                                </a>
                            </li>

                            
                        </ul>

                    </li>
                <?php endif; ?>


                
                    
                        
                    
                
                <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-meter"></i> <span>Client </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <?php if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="InternetEmp"): ?>
                        <li><a href="<?php echo e(route('internet.client.index')); ?>" class="waves-effect">Internet Client</a></li>
                        <?php endif; ?>
                            <?php if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="CableEmp"): ?>
                        <li><a href="<?php echo e(route('cable.client.index')); ?>" class="waves-effect">Cable Client</a></li>
                            <?php endif; ?>

                    </ul>
                </li>



                
                    
                        
                        
                        
                    
                

                <?php if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="InternetEmp"): ?>
                <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span>Internet Bill</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(route('bill.Internet.show')); ?>" class="waves-effect">Monthly Bill</a></li>
                        <li><a href="<?php echo e(route('bill.Internet.showPastDue')); ?>" class="waves-effect">Past Due</a></li>
                        
                    </ul>
                </li>
                <?php endif; ?>
                <?php if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="CableEmp"): ?>
                <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span>Cable Bill</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(route('bill.Cable.show')); ?>" class="waves-effect">Monthly Bill</a></li>
                        <li><a href="<?php echo e(route('bill.Cable.showPastDue')); ?>" class="waves-effect">Past Due</a></li>
                        
                    </ul>
                </li>
                <?php endif; ?>

                <li>
                    <a href="<?php echo e(route('expense.show')); ?>" class="waves-effect">
                        <i class="fa fa-shopping-basket"></i> <span>Expense</span>
                    </a>
                </li>
                <?php if(Auth::user()->fkusertype=="Admin"): ?>

                <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span>Report </span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(route('report.showDebit')); ?>" class="waves-effect">Debit</a></li>
                        <li><a href="<?php echo e(route('report.showCredit')); ?>" class="waves-effect">Credit</a></li>
                        
                    </ul>
                </li>


                <li>
                    <a href="<?php echo e(route('company')); ?>" class="waves-effect">
                        <i class="fa fa-bar-chart"></i> <span>Company Info</span>
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end sidebarinner -->
</div>