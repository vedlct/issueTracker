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



    </style>


    

        
            
            
        

        
        
            
            
        


    

</head>

<style>
    @page  { size: auto;  margin:18mm 3mm 3mm 3mm; }
</style>

<body style="background: #fff ">
<div class="structure">
    <?php $i=0;
    ?>
    <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($i>=1): ?>
            <p style="page-break-before: always"></p>
        <?php endif; ?>
    <div style= "background: #fff; padding: 20px; " class="container ">



        <table  style="width:100%; text-align: center; border: none; margin-top: -60px " >

            <tr style="">

                <td style="text-align: center; border: none; ">
                    <h1 style="">
                        <span style=" padding: 20px ;  border: 1px solid #787878; background-color: #ddd;font-weight: bold">INVOICE</span>
                    </h1>
                </td>

            </tr>

        </table>

        <h3>Client Copy</h3>
        <table style="width:100%; margin-top: 0;border: none;">

            <tr>

                <td style="width: 35%;border: none ">


                    <p><h3 style="color: #0476BD;"><?php echo e(strtoupper($company->companyTitle)); ?></h3></p>

                    <p><?php echo e($company->companyAddress); ?></p>

                    <p style="margin-top: -10px">
                        P: <?php echo e($company->companyPhone1); ?>, <?php echo e($company->companyPhone2); ?> <br>
                        E: <?php echo e($company->companyEmail); ?><br>
                    </p>

                </td>
                <td style="width: 40%;border: none "></td>

                <td style="border: none;width: 25%;">
                
                <td style="width: 40%; border: none;">
                    <p><h3 style="color: #0476BD"><?php echo e(strtoupper($client->clientFirstName)); ?> <?php echo e(strtoupper($client->clientLastName)); ?></h3></p>

                    <p style="margin-top: -10px">

                        E: <?php echo e($client->email); ?> <br>
                        P: <?php echo e($client->phone); ?><br>
                        IP: <?php echo e($client->ip); ?><br>
                        Bandwidth : <?php echo e($client->bandWide); ?><br>
                        Address : <?php echo e($client->address); ?><br>


                    </p>


                </td>
                </td>
            </tr>
        </table>

        <table style="width:100%; margin-top: 0; margin-bottom: 15px;border: none;">

            <tr style="width: 100%; border: none;">


                <td style="width: 45%;border: none;">

                </td>

            </tr>

        </table>

        <table border="0" style="width:100%;">
            <tr style="background: #4682B4;color: white">
                <td style="text-align: center;" colspan=""><b>Date</b></td>
                <td style="text-align: center;" colspan=""><b>Package Name</b></td>
                <td style="text-align: center;" colspan=""><b>Rate</b></td>
                <td style="text-align: center;" colspan=""><b>Total</b></td>
            </tr>
            <tr style="">
                <td style="text-align: center;" colspan=""><b><?php echo e($date); ?></b></td>
                <td style="text-align: center;" colspan=""><b><?php echo e($client->packageName); ?></b></td>
                <td style="text-align: center;" colspan=""><b><?php echo e($client->price); ?></b></td>
                <td style="text-align: center;" colspan=""><b><?php echo e($client->price); ?></b></td>
            </tr>




        </table>
        <hr style="border:2px solid dotted;">
        <h3>Client Copy</h3>
        <table style="width:100%; margin-top: 0;border: none;">

            <tr>

                <td style="width: 35%;border: none ">


                    <p><h3 style="color: #0476BD;"><?php echo e(strtoupper($company->companyTitle)); ?></h3></p>

                    <p><?php echo e($company->companyAddress); ?></p>

                    <p style="margin-top: -10px">
                        P: <?php echo e($company->companyPhone1); ?>, <?php echo e($company->companyPhone2); ?> <br>
                        E: <?php echo e($company->companyEmail); ?><br>
                    </p>

                </td>
                <td style="width: 40%;border: none "></td>

                <td style="border: none;width: 25%;">
                
                <td style="width: 40%; border: none;">
                    <p><h3 style="color: #0476BD"><?php echo e(strtoupper($client->clientFirstName)); ?> <?php echo e(strtoupper($client->clientLastName)); ?></h3></p>

                    <p style="margin-top: -10px">

                        E: <?php echo e($client->email); ?> <br>
                        P: <?php echo e($client->phone); ?><br>
                        IP: <?php echo e($client->ip); ?><br>
                        Bandwidth : <?php echo e($client->bandWide); ?><br>
                        Address : <?php echo e($client->address); ?><br>


                    </p>


                </td>
                </td>
            </tr>
        </table>

        <table style="width:100%; margin-top: 0; margin-bottom: 15px;border: none;">

            <tr style="width: 100%; border: none;">


                <td style="width: 45%;border: none;">

                </td>

            </tr>

        </table>

        <table border="0" style="width:100%;">
            <tr style="background: #4682B4;color: white">
                <td style="text-align: center;" colspan=""><b>Date</b></td>
                <td style="text-align: center;" colspan=""><b>Package Name</b></td>
                <td style="text-align: center;" colspan=""><b>Rate</b></td>
                <td style="text-align: center;" colspan=""><b>Total</b></td>
            </tr>
            <tr style="">
                <td style="text-align: center;" colspan=""><b><?php echo e($date); ?></b></td>
                <td style="text-align: center;" colspan=""><b><?php echo e($client->packageName); ?></b></td>
                <td style="text-align: center;" colspan=""><b><?php echo e($client->price); ?></b></td>
                <td style="text-align: center;" colspan=""><b><?php echo e($client->price); ?></b></td>
            </tr>




        </table>

        <hr style="border:2px solid dotted;">
        <h3>Office Copy</h3>
        <table style="width:100%; margin-top: 0;border: none;">

            <tr>

                <td style="width: 35%;border: none ">


                    <p><h3 style="color: #0476BD;"><?php echo e(strtoupper($company->companyTitle)); ?></h3></p>

                    <p><?php echo e($company->companyAddress); ?></p>

                    <p style="margin-top: -10px">
                        P: <?php echo e($company->companyPhone1); ?>, <?php echo e($company->companyPhone2); ?> <br>
                        E: <?php echo e($company->companyEmail); ?><br>
                    </p>

                </td>
                <td style="width: 40%;border: none "></td>

                <td style="border: none;width: 25%;">

                <td style="width: 40%; border: none;">
                    <p><h3 style="color: #0476BD"><?php echo e(strtoupper($client->clientFirstName)); ?> <?php echo e(strtoupper($client->clientLastName)); ?></h3></p>

                    <p style="margin-top: -10px">

                        E: <?php echo e($client->email); ?> <br>
                        P: <?php echo e($client->phone); ?><br>
                        IP: <?php echo e($client->ip); ?><br>
                        Bandwidth : <?php echo e($client->bandWide); ?><br>
                        Address : <?php echo e($client->address); ?><br>


                    </p>


                </td>
                </td>
            </tr>
        </table>

        <table style="width:100%; margin-top: 0; margin-bottom: 15px;border: none;">

            <tr style="width: 100%; border: none;">


                <td style="width: 45%;border: none;">

                </td>

            </tr>

        </table>

        <table border="0" style="width:100%;">
            <tr style="background: #4682B4;color: white">
                <td style="text-align: center;" colspan=""><b>Date</b></td>
                <td style="text-align: center;" colspan=""><b>Package Name</b></td>
                <td style="text-align: center;" colspan=""><b>Rate</b></td>
                <td style="text-align: center;" colspan=""><b>Total</b></td>
            </tr>
            <tr style="">
                <td style="text-align: center;" colspan=""><b><?php echo e($date); ?></b></td>
                <td style="text-align: center;" colspan=""><b><?php echo e($client->packageName); ?></b></td>
                <td style="text-align: center;" colspan=""><b><?php echo e($client->price); ?></b></td>
                <td style="text-align: center;" colspan=""><b><?php echo e($client->price); ?></b></td>
            </tr>




        </table>


    </div>
        <?php $i++; ?>

            <hr style="border:2px solid dotted;">
            <p style="page-break-before: always">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

</body>
</html>