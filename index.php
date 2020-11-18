<?php require "functions/function.php";
$sistem=new sistem();?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cafe system</title>
    <script src="assets/jquery.js"></script>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <style>
        #rows{
            height: 32px;
        }
        #table{
            height: 80px;
            margin: 12px;
            font-size: 20px;
            border-radius: 10px;
            color: white;
        }
        #mas a:link,a:visited{
            text-decoration: none;
        }


    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row table-dark" id="rows">
        <div class="col-md-3 ">Ümumi sifariş: <a class="text-warning">10</a></div>
        <div class="col-md-3 ">Doluluq miqdarı: <a class="text-warning">10</a></div>
        <div class="col-md-3 ">Ümumi masa: <a class="text-warning"><?php $sistem->get_tables_num($db);?></a></div>
        <div class="col-md-3 ">Tarix: <a class="text-warning">10</a></div>
    </div>
    <div class="row">
   <?php sistem::get_tables($db); ?>
    </div>
</div>
</body>
</html>