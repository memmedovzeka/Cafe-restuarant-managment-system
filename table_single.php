<?php require "functions/function.php";
$tables=new sistem();
$table_id=$_GET['table_id']; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cafe system</title>
    <script src="assets/jquery.js"></script>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <script>
        $(document).ready(function (){
            var id='<?php echo $table_id;?>';
            $('#data').load('actions.php?action=view&id='+id);
            //order add form
            $('#btn').click(function () {
                $.ajax({
                 type:'POST',
                 url:'actions.php?action=add',
                 data:$('#form_prod_add').serialize(),
                 success:function (e){
                     $('#data').load('actions.php?action=view&id='+id);
                     $('#form_prod_add').trigger('reset');
                     $('#cavab').html(e);
                 }
                });
            });
            $('#category a').click(function (){
                var katId=$(this).attr('sectionId');
                $("#sonuc").load("actions.php?action=product&id="+katId).fadeIn();
            })
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <?php if ($_GET['table_id']!=''):
        $single=$tables->get_table_single($db,$_GET['table_id']);
        $sing=$single->fetch_assoc();
        ?>
   <div class="row border border-dark" style="min-height: 630px" >
          <div class="col-md-2 border-right border-dark">
              <div class="row">
                  <div class="col-md-12 bg-info mx-auto text-center text-white p-3 border-danger" style="height: 70px;font-size: 20px"><?php echo $sing['table_name']?></div>
                  <div id="data">
<!--bura actions php deki view qismi gelir-->
                  </div>
                  <div id="cavab"></div>
              </div>
          </div>
          <div class="col-md-8 border border-dark" style="background-color: #F9F9F9" >
<!--              <form id="form_prod_add">
                  <input type="text" name="product_price"><br/>
                  <input type="text" name="quantity"><br/>
                  <input type="hidden" name="table_id" value="<?php /*echo $table_id;*/?>"><br/>
                  <button type="button" id="btn">Əlavə et</button>
              </form>-->
              <form id="form_prod_add">
              <div class="row">

                  <div class="col-md-12 " style="min-height: 550px;" id="sonuc">
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                       <div class="row">
                           <div class="col-md-6">
                               <input type="hidden" name="table_id" value="<?php echo $table_id;?>">
                              <input type="hidden" name="product_price" value="">
                               <button type="button" class="btn btn-success mt-4 btn-block" id="btn">Əlavə et</button>
                           </div>
                           <div class="col-md-6">
                               <?php for ($i=1;$i<13;$i++):
                                echo '<label class="btn btn-success m-2">
                                   <input type="radio" name="quantity" value="'.$i.'">
                                   '.$i.'
                               </label>';
                                     endfor;
                               ?>
                           </div>
                       </div>
                  </div>
              </div>
              </form>
                    <!--formun bitdiyi yer-->
          </div>
       <div class="col-md-2 border border-dark" id="category" >
      <?php $tables->get_category($db); ?>
       </div>
   </div>
    <?php
    else:
        echo "Xeta :Masa yoxdur!";
    endif;
    ?>
</div>
</body>
</html>