<?php require "functions/function.php";
$sistem=new sistem(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cafe system</title>
    <script src="assets/jquery.js"></script>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <script>
        $(document).ready(function (){
           $('#r3 #product_delete_id').click(function (){
                var pr_delete_id=$(this).attr('sectionId');
                $.post('actions.php?action=delete',{'id':pr_delete_id},function (e){

                });
               window.location.reload();
           });
           //hesab al postu
           $('#hesab').click(function (){
               $.ajax({
                   type:"POST",
                   url:'actions.php?action=hesab',
                   data:$("#hesabform").serialize(),
                   success:function (e){
                       $('#hesabform').trigger('reset');
                       window.location.reload();
                   }
               });
           });
           //masalara deyisdir ve birlesdirm div hereketleri
$('#deyisdirform').hide();
$('#birlesdirform').hide();
            $('#deyisdir').click(function (){
                $('#deyisdirform').slideDown();
                $('#birlesdirform').slideUp();
            });
            $('#birlesdir').click(function (){
                $('#birlesdirform').slideDown();
                $('#deyisdirform').slideUp();
            });
           //masa deyisdirme postu
            $('#deyisdirbtn').click(function (){
                $.ajax({
                    type:"POST",
                    url:'actions.php?action=tableaction',
                    data:$("#formdey").serialize(),
                    success:function (e){
                        $('#formdey').trigger('reset');
                        window.location.reload();

                    }
                });
            });
$('#birlesdirbtn').click(function (){
   $.ajax({
       url:'actions.php?action=tableaction',
       type:'post',
       data:$('#formbir').serialize(),
       success:function (e){
           $('#formbir').trigger('reset');
window.location.reload();
       }
   });
});

        });
    </script>
</head>
<body>
<?php
$db=new mysqli('localhost',"root","","cafe") or die("not connected");
$db->set_charset('utf8');

//umumidi db funksiyasi
 function common_sql2($sql,$dtbs,$status)
 {
     $a=$sql;
     $b=$dtbs->prepare($a);
     $b->execute();
     if ($status==1){
         return $c=$b->get_result();
     }
 }

 //formdeyisdir ve birlesdir funksiyasi
 function form_get($formname,$db,$id,$tab_id,$btnid,$btntext){
echo '<form method="post" id="'.$formname.'" >
   <input type="hidden" name="table_id" value="'.$tab_id.'">
   <select class="form-control" name="gedecey_table">';
 $tab_sec=common_sql2("SELECT * FROM tables where status=$id",$db,1);
while ($t=$tab_sec->fetch_assoc()) {
    if ($t['id']!=$tab_id) {
        echo '<option value='.$t['id'].'>' . $t['table_name'] . '</option>';
    }
}
  echo '</select>
  <button type="button" class="btn-danger btn-block font-weight-bolder" id='.$btnid.' > '.$btntext.'</button>
</form>';
 }

$action=$_GET['action'];
@$id=$_GET['id'];
switch ($action):
    case 'tableaction';
        $masa_id=htmlspecialchars($_POST['table_id']);
        $gedecey_tab_id=htmlspecialchars($_POST['gedecey_table']);
        common_sql2("UPDATE orders SET table_id='$gedecey_tab_id' where table_id=$masa_id",$db,1);
         common_sql2("UPDATE tables SET status=1 where id=$gedecey_tab_id",$db,1);





        break;
    case 'view';
      $result=common_sql2("select * from orders where table_id='$id.'",$db,1);
       if ($result->num_rows==0):
           //table statusunu guncellemek
           $table_upd=common_sql2("update tables set status=0 where id=$id",$db,0);

           $sistem->alert("Hələki Sifariş Yoxdur",'danger');
       else:
           echo '<table class="table table-bordered table-striped text-center">
    <thead>
    <tr class="bg-dark text-white text-center">
        <th scope="col">Ad</th>
        <th scope="col">Ədəd</th>
        <th scope="col">Qiymət</th>
        <th scope="col">Emeliyyat</th>
    </tr>
    </thead>
    <tbody>';
       $eded=0;
       $qiymet=0;
         while ($c=$result->fetch_assoc()):
             $total_price=$c['quantity']*$c['product_price'];
             $eded+=$c['quantity'];
             $qiymet+=$total_price;
             $tab_id=$c['table_id'];
   echo '<tr>
        <td>'.$c['product_name'].'</td>
        <td>'.$c['quantity'].'</td>
        <td>'.$total_price.' Azn</td>
        <td id="r3"><a id="product_delete_id" class="btn btn-danger" sectionId="'.$c['id'].'">SİL</a></td>
        </tr>';
         endwhile;
    echo '
<div>
<tr class="btn-dark">
        <td class="btn-dark"><b>Toplam:</b></td>
        <td class="btn-dark"><b>'.$eded.'</b></td>
        <td colspan="2" class="text-warning btn-dark" ><b>'.$qiymet.' Azn</b></td>
    </tr>
    </div>
</tbody>
</table>
          <div class="row">
<div class="col-md-12">
     <button class="btn btn-success ml-4" id="deyisdir" >Masa Dəyişdir</button>
     <button class="btn btn-warning" id="birlesdir">Masa birləşdir</button>
                       
               </div>
                  </div>
                  
                  <div class="row">
                  <div class="btn btn-block" id="deyisdirform">';
        form_get('formdey',$db,0,$id,'deyisdirbtn','Dəyişdir');
                   echo '</div>
                               <div class="btn btn-block" id="birlesdirform">';
           form_get('formbir',$db,1,$id,'birlesdirbtn','Birləşdir');
           echo '</div>
                  
               </div>
                  
                  

<div class="row">
<div class="col-md-12">
<form id="hesabform">
   <input type="hidden" name="table_id" value="'.$tab_id.'">
  <button type="button" class="btn-danger btn-block font-weight-bolder" id="hesab" >Hesabı Al</button>
</form>
</div>
</div>
';
           endif;
     break;
    case "add":
        if ($_POST):
        @$product_price=htmlspecialchars($_POST['product_price']);
        @$quantity=htmlspecialchars($_POST['quantity']);
        @$product_id=htmlspecialchars($_POST['product_id']);
        @$table_id=$_POST['table_id'];
         if ($quantity=="" or $table_id=="" or $product_id==""):
             $sistem->alert("Boş Buraxmayın",'danger');
         else:
             //productun guncellenmesi
                $prod_upd=common_sql2("SELECT * FROM orders where product_id='$product_id' and table_id='$table_id'",$db,1);
                            if ($prod_upd->num_rows!=0){
                                $prod=$prod_upd->fetch_assoc();
                                $pr_id=$prod['product_id'];
                                $last_quant=$quantity+$prod['quantity'];
                                $quant_update=$db->prepare("UPDATE orders SET quantity='$last_quant' where product_id='$pr_id' ");
                                $quant_update->execute();
                                //table statusnunun guncellenmesi
                                $table_upd=common_sql2("UPDATE tables set status=1 where id=$table_id",$db,0);
                                $sistem->alert("Sifariş Güncəlləndi",'success');


                            }else{
                                $get_prod=$db->prepare("SELECT * FROM products where id='$product_id'");
                                $get_prod->execute();
                                $f=$get_prod->get_result();
                                $g=$f->fetch_assoc();
                                $res_price=$g['price'];
                                $res_name=$g['name'];
//productun elave edilmesi
                                $qarsonsec=common_sql2("SELECT * FROM qarson where status=1",$db,1);
                                $qars=$qarsonsec->fetch_assoc();
                                $qarson_id=$qars['id'];
                                $order_insert=$db->prepare("INSERT INTO orders(table_id,qarson_id,quantity,product_name,product_price,product_id) VALUES ($table_id,$qarson_id,$quantity,'$res_name','$res_price',$product_id )");                                $order_insert->execute();
                                $sistem->alert("Sifariş əlavə edildi",'success');

                                //table statusnunun guncellenmesi
                                $table_upd=common_sql2("UPDATE tables set status=1 where id=$table_id",$db,1);



                            }
         endif;
        else:
            $sistem->alert("Xəta baş verdi!!!",'danger');
        endif;
        break;
    case 'product':
        $kat_id=$_GET['id'];
        $products=common_sql2("select * from products where cat_id='$kat_id'",$db,1);
        if ($products->num_rows!=0) {
            while ($product = $products->fetch_assoc()):
            echo '<label class="btn btn-dark m-2 text-white text-center">'.$product['name'].'
            <input name="product_id" type="radio"  value="'.$product['id'].'">                                        
</label>';
            endwhile;
        }else{
            $sistem->alert("Kateqoriyada Məhsul yoxdur",'danger');

        }
        break;
    case 'hesab':
        if (!$_POST):
            echo "Error";
        else:
            @$order_table_id=htmlspecialchars($_POST['table_id']);
        $get_orders_data=common_sql2("select * from orders where table_id='$order_table_id'",$db,1);
        while ($get_orders=$get_orders_data->fetch_assoc()):
        $a=$get_orders['product_id'];
        $b=$get_orders['quantity'];
        $c=$get_orders['product_name'];
        $d=$get_orders['product_price'];
        $qar_id=$get_orders['qarson_id'];
        $e=date('Y-m-d');
        $insert_report=$db->prepare("insert into report (table_id,qarson_id,quantity,product_name,product_price,product_id,report_date) 
                                           VALUES ('$order_table_id','$qar_id','$b','$c','$d','$a','$e')");
        $insert_report->execute();
        endwhile;
        //table statusunu guncellemek
        $table_upd=common_sql2("UPDATE tables set status=0 where id=$order_table_id",$db,0);

            //siafrisi bititrib silmek
        $hesabdelete=common_sql2("DELETE FROM orders where table_id='$order_table_id'",$db,2);
        endif;
        break;
    case "delete":
        if (!$_POST):
            $sistem->alert("Error!!!",'danger');
        else:
            $pr_post=$_POST['id'];
           $delet_order=$db->prepare("DELETE FROM orders where id='$pr_post'");
           $delet_order->execute();
        endif;
        break;
        case "qarsongiris";
        @$qars_name=htmlspecialchars($_POST['ad']);
        @$qars_pass=htmlspecialchars($_POST['sifre']);
        $qars_sec=$db->prepare("SELECT * FROM qarson where ad='$qars_name' AND sifre='$qars_pass'");
        $qars_sec->execute();
        $get_qars=$qars_sec->get_result();
            if ($qars_name=="" or $qars_pass==""){
                echo '<div class=" alert alert-danger"> Boş buraxmayın</div>';

            }else{
      if (($get_qars->num_rows)==0)
      {
          echo '<div class=" alert alert-danger">Şifrəniz səhfdir</div>';

      }
      else{
          $q=$get_qars->fetch_assoc();
          $qars_id=$q['id'];
          $qar_upd=$sistem->common_result($db,"UPDATE qarson set status=1 where id=$qars_id",0);
?>
       <script>
           window.location.reload();
       </script>
  <?php    } }
        break;
    case "qarscixis" :

        $q_upd=$sistem->common_result($db,"UPDATE qarson set status=0",0);
        header('Location:index.php');

    endswitch;
?>


