<?php require "functions/function.php";
$sistem=new sistem();?>

<?php
$qars_data=$db->prepare('SELECT * from qarson where status=1');
$qars_data->execute();
$q=$qars_data->get_result();
$qars_num=$q->num_rows;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cafe system</title>
    <script src="assets/jquery.js"></script>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function (){
var deyer="<?php echo $qars_num;?>"
            if (deyer==0) {
                //modal
                $("#girismodal").modal({
                    backdrop: 'static',
                    keyboard: false
                });
//modal
                $('body').on('hidden.bs.modal', '.modal', function () {
                    $(this).removeData('bs.modal');
                });
            }else {
                $("#girismodal").modal('hide');
            }
      $("#girisbak").click(function (){
    $.ajax({
       type:'POST',
       url:'actions.php?action=qarsongiris',
        data:$('#garsonform').serialize(),
        success:function (e){
$(".modalcevap").html(e);
        }
    });
      });

            $(".qarsoncixis").click(function (){

               alert("sala");
            });


        });
    </script>

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
        <div class="col-md-2 ">Ümumi sifariş: <a class="text-warning"><?php $sistem->get_orders_num($db); ?></a></div>
        <div class="col-md-2 ">Doluluq miqdarı: <a class="text-warning"><?php $sistem->doluluq($db);?></a></div>
        <div class="col-md-2 ">Ümumi masa: <a class="text-warning"><?php $sistem->get_tables_num($db);?></a></div>
        <div class="col-md-2 ">Qarson: <a class="text-warning"><?php $sistem->qarson_sec($db);?></a></div>
        <div class="col-md-2 ">Tarix: <a class="text-warning">10</a></div>
    </div>
    <div class="row">
   <?php sistem::get_tables($db); ?>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="girismodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h4 class="modal-title">Qarson Girişi</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="post" id="garsonform">
                        <div class="row mx-auto text-center">
                            <div class="col-md-12">Qarson Ad</div>
                            <div class="col-md-12">
                                <select class="form-control mt-2" name="ad" >
                                    <?php
                           $qarson=$sistem->common_result($db,"SELECT * FROM qarson",1);
                                    ?>
                                    <option>Seç</option>
                                    <?php  while ($q=$qarson->fetch_assoc()){ ?>
                                    <option value="<?php echo $q['ad'] ?>"><?php echo $q['ad'];?></option>
                                    <?php } ?>
                                </select></div>
                            <div class="col-md-12">Şifrə </div>
                            <div class="col-md-12">
                                <input  type="text" name="sifre" class="form-control  mt-2" />
                            </div>
                            <div class="col-md-12">
                                <input type="button" id="girisbak" value="GİR" class="btn btn-info mt-4"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modalcevap">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>