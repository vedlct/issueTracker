<?php $__env->startSection('css'); ?>
    <style>
        .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
            padding: 5px;
        }

        .table-custom-1{
            width: 100%;
        }

        .container2 {
            border: 1px solid #dedede;
            margin-bottom: 10px !important;
            border-radius: 5px;
            padding: 10px;
            margin: 5px 0;
        }

        /* Darker chat container */
        .darker {
            border-color: #ccc;

        }

        /* Clear floats */
        .container2::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Style images */
        .circle-img {
            float: none;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        /* Style the right image */
        .container2 img.right {
            float: none;
            margin-left: 20px;
            margin-right:0;
        }

        /* Style time text */
        .time-right {
            float: right;
            color: #aaa;
        }

        /* Style time text */
        .time-left {
            float: right;
            color: #999;
        }
        .custom-2{
            padding-top: 3px;
            padding-bottom: 3px;
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        
        <div class="card">
            <div class="card-header bg-dark text-white custom-2">
                <h4 class="float-left font-weight-normal">Ticket Information</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table-condensed table-bordered table-custom-1">
                            <tbody>
                            <tr>
                                <th scope="col">Ticket Topic</th>
                                <td><?php echo e($ticket->ticketTopic); ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Ticket Creation Time</th>
                                <td><?php echo e($ticket->created_at); ?></td>
                            </tr>
                            <tr>
                                <?php if($ticket->ticketAssignPersonUserId == null): ?>
                                    <th scope="col">Assigned Team</th>
                                    <td>
                                        <a style="text-decoration: underline; cursor: pointer;" data-toggle="modal" data-target="#exampleModal"> <?php echo e($ticket->teamName); ?> </a>
                                    </td>
                                <?php else: ?>
                                    <th scope="col">Assigned Person</th>
                                    <td>
                                        <?php echo e($assignedPerson->fullName); ?>

                                    </td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th scope="col">Ticket Expected End Date</th>
                                <td><?php echo e($ticket->exp_end_date); ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table-condensed table-bordered table-sm table-custom-1">
                            <tbody>
                            <tr>
                                <th scope="col">Ticket Priority</th>
                                <td><?php echo e($ticket->ticketPriority); ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Last Updated</th>
                                <td><?php echo e($ticket->lastUpdated); ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Ticket Opener</th>
                                <td><?php echo e($ticket->fullName); ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table-condensed table-bordered table-sm table-custom-1">
                            <tbody>
                                <tr>
                                    <th scope="col">Ticket Status</th>
                                    <td><?php echo e($ticket->ticketStatus); ?></td>
                                </tr>
                                <tr>

                                    <th scope="col">Worked Hour</th>
                                    <td><?php echo e($ticket->workedHour); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-2 shadow-none mb-1 bg-light rounded">
                    <div class="card-body p-1">
                        <div id="ticketInformation" class="mt-2 pl-3" style="box-shadow: 1px 0 10px rgba(0, 0, 0, 0.20) !important; padding: 20px;">

                            <?php if(Auth::user()->fk_userTypeId == 1 || Auth::user()->fk_userTypeId == 4 || Auth::user()->userId == $ticket->fk_ticketOpenerId): ?>
                                <button class="float-right btn btn-success mr-1" type="button" onclick="editTicket(<?php echo e($ticket->ticketId); ?>)">Edit</button>
                            <?php endif; ?>

                            <?php echo $ticket->ticketDetails; ?>

                        </div>
                    </div>
                </div>

                
                <?php if($ticket->ticketFile != null): ?>
                    <div class="mt-4">
                        <a href="<?php echo e(url('/public/files/ticketFile').'/'.$ticket->ticketFile); ?>" download> Download File</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        
        <div class="card mt-4">
            <div class="card-body">
                
                <?php if($ticketReplies): ?>
                    <?php $__currentLoopData = $ticketReplies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($reply->fk_userId == Auth::user()->userId): ?>
                            
                            <div class="container2 darker" >
                                <span class="badge badge-secondary" style="color: white;"  > <?php echo e($reply->fullName); ?> </span>
                                <div class="in ">
                                    <?php echo $reply->replyData; ?>


                                     
                                    <?php if($reply->ticketReplyFile != null): ?>
                                        <div class="mt-4">
                                            <a href="<?php echo e(url('/public/files/ticketReplyFile').'/'.$reply->ticketReplyFile); ?>" download> Download File</a>
                                        </div>
                                    <?php endif; ?>

                                    <span class="time-right float-right" style="font-size:15px; color: grey !important; font-weight: lighter;"> <?php echo e($reply->created_at); ?> </span>
                                </div>

                            </div>
                        <?php else: ?>
                            
                            <?php if(Auth::user()->fk_userTypeId == 1 OR Auth::user()->fk_userTypeId == 3): ?>
                                <div class="container2" >
                                    <span class="badge badge-secondary" style="color: white;" > <?php echo e($reply->fullName); ?> </span>
                                    <div class="in">
                                        <?php echo $reply->replyData; ?>


                                        
                                        <?php if($reply->ticketReplyFile != null): ?>
                                            <div class="mt-4">
                                                <a href="<?php echo e(url('/public/files/ticketReplyFile').'/'.$reply->ticketReplyFile); ?>" download> Download File</a>
                                            </div>
                                        <?php endif; ?>

                                        <span class="time-right" style="font-size:15px; color: grey !important; font-weight: lighter;"> <?php echo e($reply->created_at); ?> </span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php if($reply->ticketReplyType == 'public'): ?>
                                    <div class="container2">
                                        <span class="badge badge-secondary" style="color: white;" > <?php echo e($reply->fullName); ?> </span>
                                        <div class="in">
                                            <?php echo $reply->replyData; ?>


                                            
                                            <?php if($reply->ticketReplyFile != null): ?>
                                                <div class="mt-4">
                                                    <a href="<?php echo e(url('/public/files/ticketReplyFile').'/'.$reply->ticketReplyFile); ?>" download> Download File</a>
                                                </div>
                                            <?php endif; ?>

                                            <span class="time-right " style="font-size:15px; color: grey !important; font-weight: lighter;">  <?php echo e($reply->created_at); ?> </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                



                <br>
                <button id="addcommnet" onclick="addcomment()" class="btn btn-warning">Add Comment</button>
                
                <form id="reply" method="post" enctype="multipart/form-data" style="clear: both; display: none">

                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="ticketId" value="<?php echo e($ticket->ticketId); ?>">
                    <div class="form-group">
                        <label>Reply Type</label>
                        <select class="form-control" name="type">
                            <option value="public">Public</option>
                            <option value="internal">Internal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="replyData" class="form-control ckeditor" placeholder="Enter Your reply" rows="3"></textarea>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label>Choose file</label>
                                    <input type="file" class="form-control-file" name="replyFile">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary float-right mt-3">Post Reply</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Team Members</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item"><?php echo e($member->fullName); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script type="text/javascript" src="<?php echo e(url('public/ck/ckeditor/ckeditor.js')); ?>"></script>

    <script>
            function editTicket(id) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo route('ticket.ckEditorView'); ?>",
                    cache: false,
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        'id': id
                    },
                    success: function (data) {
                        $('#ticketInformation').html(data);
                    }
                });
            }


            function addcomment() {
                document.getElementById('addcommnet').style.display = "none";
                document.getElementById('reply').style.display = "block";
            }

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>