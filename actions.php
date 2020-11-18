<?php
$db=new mysqli('localhost',"root","","cafe") or die("not connected");
$db->set_charset('utf8');
$action=$_GET['action'];
@$id=$_GET['id'];
switch ($action):
    case 'view';
       $a=$db->prepare("select * from orders where table_id='$id.'");
       $a->execute();
       $b=$a->get_result();
       if ($b->num_rows==0):
           echo "Sifariş yoxdur";
       else:
while ($c=$b->fetch_assoc()):
  echo '<div class="col-md-12 border-bottom border-dark">'.$c["product_name"].'</div>';
    endwhile;
           endif;
     break;
    case "add":
        if ($_POST):
        @$product_price=htmlspecialchars($_POST['product_price']);
        @$quantity=htmlspecialchars($_POST['quantity']);
        @$table_id=$_POST['table_id'];
         if ($quantity=="" or $table_id==""):
                echo "boş buraxma";
         else:
             $order_insert=$db->prepare("INSERT INTO orders (table_id,quantity,product_name,product_price,product_id) values ($table_id,$quantity,'yeni pr',55,1)");
             $order_insert->execute();
             echo "sifaris edildi";
             endif;
        else:
            echo "Xeta baş verdi";
        endif;
        break;
    case 'product':
        $kat_id=$_GET['id'];
        $products=$db->prepare("select * from products where cat_id='$kat_id'");
        $products->execute();
        $get_pr=$products->get_result();
        if ($get_pr->num_rows!=0) {
            while ($product = $get_pr->fetch_assoc()):
                echo '<a class="btn btn-dark  mt-2" sectionId="'.$product['id'].'">'.$product['name'].'</a><br>';
                echo '<a sectionId="'.$product['price'].'"></a><br>';
            endwhile;
        }else{
            echo "Bu Kateqoriyada Məhsul yoxdur";
        }
        break;
    endswitch;
?>