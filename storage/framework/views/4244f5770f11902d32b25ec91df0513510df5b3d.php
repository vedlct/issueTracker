<form action="<?php echo e(route('sms.updateConfig')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

    <input id="smsId" type="hidden" required name="smsId" value="<?php echo e($smsConfig->id); ?>">


    <div class="form-group">

        <label for="">User Name<span style="color: red">*</span></label>

        <input class="form-control" maxlength="255" value="<?php echo e($smsConfig->userName); ?>" name="useName" required type="text">

    </div>

    <div class="form-group">

        <label for="">Password</label>

        <input class="form-control" name="password" type="password">

    </div>
    <div class="form-group">

        <label for="">Brand Name<span style="color: red">*</span></label>

        <input class="form-control" maxlength="11" value="<?php echo e($smsConfig->brandName); ?>" name="brandName" required type="text">

    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-success">Submit</button>
    </div>

</form>