<form method="post" action="<?php echo e(route('client.update')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" value="<?php echo e($client->clientId); ?>" name="clientId">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Client Name *</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="name" value="<?php echo e($client->clientName); ?>" placeholder="client name" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Client Official Email</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="email" value="<?php echo e($client->clientEmail); ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Client Information</label>
        <div class="col-sm-9">
            <textarea class="form-control" name="info" placeholder="client information"><?php echo e($client->clientInfo); ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary pull-right">Update Client</button>
        </div>
    </div>
</form>
