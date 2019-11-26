<form class="empform" action="<?php echo e(route('expense.update')); ?>" novalidate="" method="post">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="expenseId" value="<?php echo e($expense->expenseId); ?>">
    <div class="form-group">
        <label>Expense Type</label>
        <div>
            <select class="form-control" name="expenseType">
                <option value="">Select</option>
                <option <?php if($expense->expenseType == 'Food'): ?>selected <?php endif; ?>>Food</option>
                <option <?php if($expense->expenseType == 'Router'): ?>selected <?php endif; ?>>Router</option>
                <option <?php if($expense->expenseType == 'Accessories'): ?>selected <?php endif; ?>>Accessories</option>
                <option <?php if($expense->expenseType == 'Others'): ?>selected <?php endif; ?>>Others</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>Expense For</label>
        <div>
            <select id="statusFilter" class="form-control" name="expensefor">
                <option value="">Select</option>
                <option value="Internet" <?php if($expense->expenseFor == 'Internet'): ?>selected <?php endif; ?>>Internet</option>
                <option value="Cable" <?php if($expense->expenseFor == 'Cable'): ?>selected <?php endif; ?>>Cable</option>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label>price</label>
        <div>
            <input data-parsley-type="digits" name="price" value="<?php echo e($expense->price); ?>" type="text" class="form-control" required="" placeholder="Enter Salary Amount">
        </div>
    </div>
    <div class="form-group">
        <label>Quantity</label>
        <div>
            <input data-parsley-type="digits" name="amount" value="<?php echo e($expense->amount); ?>" type="text" class="form-control" required="" placeholder="Enter Salary Amount">
        </div>
    </div>
    <div class="form-group">
        <label>Cause</label>
        <div>
            <textarea required="" name="cause"class="form-control" rows="5"><?php echo e($expense->cause); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Expense</button>
        </div>
    </div>
</form>