




    
        
    
    
        <?php if($report->status==ACCOUNT_STATUS['Debit']): ?>
        <h5 class="card-title"><?php echo e($report->expenseType); ?></h5>
        <p class="card-text"><?php echo e($report->cause); ?></p>
        <div class="row">
            <?php if($report->tableName =='employee'): ?>
            <div class="col-md-4">
                <label>Name</label> :<?php echo e($report->employeeName); ?>

            </div>
            <div class="col-md-4">
                <label>Designation</label> :<?php echo e($report->degisnation); ?>

            </div>
            <div class="col-md-4">
                <label>phone</label> :<?php echo e($report->phone); ?>

            </div>
            <div class="col-md-4">
                <label>email</label> :<?php echo e($report->email); ?>

            </div>
            <div class="col-md-4">
                <label>Paid Salary</label> :<?php echo e($report->price); ?>

            </div>
            <?php else: ?>

            <div class="col-md-4">
                <label>Amount</label> : <?php echo e($report->amount); ?>

            </div>
            <div class="col-md-4">
                <label>Price</label> : <?php echo e($report->price); ?>

            </div>
            <div class="col-md-4">
                <label>Expense For</label> : <?php echo e($report->expenseFor); ?>

            </div>
            <?php endif; ?>
        </div>


        

        <?php else: ?>

            <h5 style="text-align: center" class="card-title">
                <?php if($report->tableName=="cable_bill"): ?>
                    Cable
                <?php elseif($report->tableName=="internet_bill"): ?>
                    Internet
                <?php endif; ?>
                Bill


            </h5>
            <div class="row">
            <div class="col-md-12">
                <label>Name</label> : <?php echo e($report->clientFirstName.' '. $report->clientLastName); ?>

            </div>

            <div class="col-md-6">
                <label>phone</label> :<?php echo e($report->phone); ?>

            </div>
            <div class="col-md-4">
                <label>email</label> :<?php echo e($report->email); ?>

            </div>
            <div class="col-md-4">
                <label>Bill Paid</label> :<span style="color: red"><?php echo e($report->price); ?></span>
            </div>
            <div class="col-md-12">
                <label>Address</label> :<?php echo e($report->address); ?>

            </div>
            </div>



        <?php endif; ?>
    


