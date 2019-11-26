<?php $__env->startSection('content'); ?>
    <style>
        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 64px;
            height: 37px;
        }
        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 6px;
            width: 13px;
            background: #99ff48;
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }
        .lds-facebook div:nth-child(1) {
            left: 6px;
            animation-delay: -0.24s;
        }
        .lds-facebook div:nth-child(2) {
            left: 26px;
            animation-delay: -0.12s;
        }
        .lds-facebook div:nth-child(3) {
            left: 45px;
            animation-delay: 0;
        }
        @keyframes  lds-facebook {
            0% {
                top: 6px;
                height: 51px;
            }
            50%, 100% {
                top: 19px;
                height: 26px;
            }
        }

    </style>

    <?php if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="InternetEmp"): ?>
    <h3>Internet</h3>
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="<?php echo e(route('bill.internet.showTotalBillRecieved')); ?>">Total Bill Recieved</a></h4>
                    <div class="row">
                    <div class="text-left col-md-6">
                        
                        


                    </div>
                    <div class="text-right col-md-6">
                        <h4 class="font-light m-b-0"><?php echo e($totalbilllastmonthinternet->totalbillinternet); ?></h4>

                        <span class="text-muted">This Month</span>

                    </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="<?php echo e(route('bill.showPastDueLastMonth')); ?>">Total Bill Due</a></h4>

                    <div class="row">

                        <div class="text-left col-md-6">
                            
                            



                        </div>

                    <div class="text-right col-md-6">
                        <h4 class="font-light m-b-0"><?php echo e($totalduelastmonthinternet->totaldueinternet); ?></h4>

                        <span class="text-muted">This Month</span>

                    </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="<?php echo e(route('bill.showPastDue')); ?>">Past Bill Due</a></h4>

                    <div class="row">

                        <div class="text-left col-md-6">
                            




                        </div>

                    <div class="text-right col-md-6">
                        <h4 class="font-light m-b-0"><?php echo e($totalpastduelastmonthinternet->totalpastdueinternet); ?></h4>

                        <span class="text-muted">Total Previous Months</span>

                    </div>

                    </div>


                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total Expense</a></h4>

                    <div class="row">

                        <div class="text-left col-md-6">
                            
                            
                            


                        </div>

                    <div class="text-right col-md-6">
                        <h5 class="font-light m-b-0"><?php echo e($totalOFLastMonthDebit); ?></h5>

                        <span class="text-muted">This Month</span>

                    </div>

                    </div>


                </div>
            </div>
        </div>
        <div style="margin-top: 10px;margin-bottom: 10px" class="col-md-12"></div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total Earning</a></h4>
                    <div class="row">

                        <div class="text-left col-md-6">
                            
                            
                            


                        </div>

                    <div class="text-right col-md-6">
                        <h5 class="font-light m-b-0"><?php echo e($totalOFLastMonthCredit); ?></h5>

                        <span class="text-muted">This Month</span>

                    </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total(Summary)</a></h4>
                    <div class="row">
                        <div class="text-left col-md-6">
                            
                            
                            


                        </div>
                    <div class="text-right col-md-6">
                        <h5 class="font-light m-b-0"><?php echo e($summary); ?></h5>

                        <span class="text-muted">This Month</span>

                    </div>

                    </div>


                </div>
            </div>
        </div>

    </div>

    <?php endif; ?>
    <br>
    <?php if(Auth::user()->fkusertype=="Admin" || Auth::user()->fkusertype=="CableEmp"): ?>
    <h3>Cable</h3>
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="<?php echo e(route('bill.cable.showTotalBillRecieved')); ?>">Total Bill Recieved</a></h4>
                    <div class="row">
                        <div class="text-left col-md-6">
                            
                            


                        </div>
                        <div class="text-right col-md-6">
                            <h4 class="font-light m-b-0"><?php echo e($totalbilllastmonthcable->totalbillcable); ?></h4>

                            <span class="text-muted">This Month</span>

                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="<?php echo e(route('bill.showPastDueLastMonth')); ?>">Total Bill Due</a></h4>

                    <div class="row">

                        <div class="text-left col-md-6">
                            
                            



                        </div>

                        <div class="text-right col-md-6">
                            <h4 class="font-light m-b-0"><?php echo e($totalduelastmonthcable->totalduecable); ?></h4>

                            <span class="text-muted">This Month</span>

                        </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="<?php echo e(route('bill.showPastDue')); ?>">Past Bill Due</a></h4>

                    <div class="row">

                        <div class="text-left col-md-6">
                            




                        </div>

                        <div class="text-right col-md-6">
                            <h4 class="font-light m-b-0"><?php echo e($totalpastduelastmonthcable->totalpastduecable); ?></h4>

                            <span class="text-muted">Total Previous Months</span>

                        </div>

                    </div>


                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total Expense</a></h4>

                    <div class="row">

                        <div class="text-left col-md-6">
                            
                            
                            


                        </div>

                        <div class="text-right col-md-6">
                            <h5 class="font-light m-b-0"><?php echo e($totalOFLastMonthDebitcable); ?></h5>

                            <span class="text-muted">This Month</span>

                        </div>

                    </div>


                </div>
            </div>
        </div>
        <div style="margin-top: 10px;margin-bottom: 10px" class="col-md-12"></div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total Earning</a></h4>
                    <div class="row">

                        <div class="text-left col-md-6">
                            
                            
                            


                        </div>

                        <div class="text-right col-md-6">
                            <h5 class="font-light m-b-0"><?php echo e($totalOFLastMonthCreditcable); ?></h5>

                            <span class="text-muted">This Month</span>

                        </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#">Total(Summary)</a></h4>
                    <div class="row">
                        <div class="text-left col-md-6">
                            
                            
                            


                        </div>
                        <div class="text-right col-md-6">
                            <h5 class="font-light m-b-0"><?php echo e($summarycable); ?></h5>

                            <span class="text-muted">This Month</span>

                        </div>

                    </div>


                </div>
            </div>
        </div>

    </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
    

        
            
            
            
            
            
                
                
            
        

    

    $(document).ready( function () {
        $.ajax({
            type: 'GET',
            url: "<?php echo route('dashboard.insertbillformonth'); ?>",
            cache: false,
            data: {_token: "<?php echo e(csrf_token()); ?>"},
            success: function (data) {


              //  $("#duepayment").html(data);
                 console.log(data);
            }
        });

    });
    </script>
    }
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>