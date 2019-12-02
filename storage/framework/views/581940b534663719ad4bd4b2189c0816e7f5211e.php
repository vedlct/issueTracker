<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invoice</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>


        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }

        input {
            border: medium none;
            padding: 0;
        }
        .tblColor{
            background-color: #ddd;

        }
        body{
            font-size: 11px;
        }


    </style>


</head>

<style>
    @page  { size: auto;  margin:10px 10px 10px 20px; }
</style>

<body style="background: #fff ">



<div class="structure" style="margin-left: 20px;">
    

        <table style="width: 100%; border:none;">

            <tr>

                <td  style="width: 100%;border: none;">
                    <table  style="width:100%; text-align: center; border: none;" >

                        <tr style="margin: 0px;width: 100%">
                            <td style="border: none;padding: 0px;" >
                            </td>
                            <td style="text-align: center; border: none; ">
                                <h1 style="">
                                    INVOICE-<?php echo e($date); ?>

                                </h1>
                            </td>
                            <td style="border: none;">

                            </td>

                        </tr>

                        <tr >
                            <td style="border: none;">
                                <p><h3 style="color: #0476BD;"><?php echo e(strtoupper($company->companyTitle)); ?></h3></p>

                                <p><?php echo e($company->companyAddress); ?></p>

                                <p style="margin-top: -10px">
                                    P: <?php echo e($company->companyPhone1); ?>, <?php echo e($company->companyPhone2); ?> <br>
                                    E: <?php echo e($company->companyEmail); ?><br>
                                </p>
                            </td>

                            <td style="text-align: center; border: none;">

                            </td>

                            <td style="border: none;">
                                <div style="margin-left: 20%">
                                    <p><h3 style="color: #0476BD"><?php echo e(strtoupper($client->clientFirstName)); ?> <?php echo e(strtoupper($client->clientLastName)); ?></h3></p>

                                    <p style="margin-top: -10px">

                                        E: <?php echo e($client->email); ?> <br>
                                        P: <?php echo e($client->phone); ?><br>
                                        Address : <?php echo e($client->address); ?><br>


                                    </p>
                                </div>
                            </td>

                        </tr>

                    </table>



                    <table border="0" style="width:100%;">
                        <tr style="background: #4682B4;color: white">
                            <td style="text-align: center;" colspan=""><b>Month</b></td>
                            <td style="text-align: center;" colspan=""><b>Prev Due</b></td>
                            <td style="text-align: center;" colspan=""><b>Due</b></td>
                            <td style="text-align: center;" colspan=""><b>Total</b></td>
                        </tr>
                        <tr style="">
                            <td style="text-align: center;" colspan=""></td>
                            <td style="text-align: center;" colspan=""><b>0</b></td>
                            <td style="text-align: center;" colspan=""><b><?php echo e($client->price); ?></b></td>
                            <td style="text-align: center;" colspan=""><b><?php echo e($client->price); ?></b></td>
                        </tr>




                    </table>

                </td>


            </tr>


            <tr>
                <td style="width: 100%;border: none;">
                    
                    <hr style="border:2px solid dotted;">
                    Client Copy
                    <table border="0" style="width:100%;">
                        <tr>
                            <td></td>
                            <td>Name :</td>
                            <td colspan="2"><?php echo e(strtoupper($client->clientFirstName)); ?> <?php echo e(strtoupper($client->clientLastName)); ?></td>
                            <td>Mem. No.</td>
                            <td colspan="2"><?php echo e($client->clientSerial); ?></td>
                            <td>Tv No.</td>
                            <td><?php echo e($client->noOfTv); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Address :</td>
                            <td colspan="2"><?php echo e($client->address); ?></td>
                            <td>Con. Date</td>
                            <td colspan="2"><?php echo e($client->conDate); ?></td>
                            <td>C.C.</td>
                            <td>0</td>

                        </tr>
                        <tr>
                            <td></td>
                            <td>Date</td>
                            <td colspan="2"></td>
                            <td colspan="2">Paid:</td>
                            <td colspan="2">Due:</td>
                            <td><?php echo e($client->phone); ?></td>
                        </tr>

                    </table>


                    
                    <hr style="border:2px solid dotted;">
                    Office Copy
                    <table border="0" style="width:100%;">
                        <tr>
                            <td></td>
                            <td>Name :</td>
                            <td colspan="2"><?php echo e(strtoupper($client->clientFirstName)); ?> <?php echo e(strtoupper($client->clientLastName)); ?></td>
                            <td>Mem. No.</td>
                            <td colspan="2"><?php echo e($client->clientSerial); ?></td>
                            <td>Tv No.</td>
                            <td><?php echo e($client->noOfTv); ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Address :</td>
                            <td colspan="2"><?php echo e($client->address); ?></td>
                            <td>Con. Date</td>
                            <td colspan="2"><?php echo e($client->conDate); ?></td>
                            <td>C.C.</td>
                            <td>0</td>

                        </tr>
                        <tr>
                            <td></td>
                            <td>Date</td>
                            <td colspan="2"></td>
                            <td colspan="2">Paid:</td>
                            <td colspan="2">Due:</td>
                            <td><?php echo e($client->phone); ?></td>
                        </tr>

                    </table>


                </td>


            </tr>

        </table>
        






        





</div>



</body>
</html>