<?php
$db=new mysqli('localhost',"root","","cafe") or die("not connected");
$db->set_charset('utf8');
 class sistem{
     //common sql result function
      function common_result($dtbs,$sql,$status)
     {
         $a=$sql;
         $b=$dtbs->prepare($a);
         $b->execute();
         if ($status==1){
             return $c=$b->get_result();
         }
     }
     //get tables function
     function get_tables($dtbs)
     {
          $result=self::common_result($dtbs,"select * from tables",1);
          $bos=0;
          $dolu=0;
         while ($result_table=$result->fetch_assoc()):
             $res_id=$result_table['id'];
             $orders=self::common_result($dtbs,"SELECT * FROM orders where table_id='$res_id'",1);
             $orders->num_rows!=0 ? $color="bg-success" :$color="bg-danger";
             $orders->num_rows!=0 ? $dolu++ :$bos++;
             echo '<div class="col-md-2 col-sm-6 mr-2 border mx-auto p-2 text-center" id="mas" >
        <a href="table_single.php?table_id='.$result_table['id'].'">
        <div id="table" class="'.$color.' p-3">'.$result_table["table_name"].'</div>
        </a>
        </div>';
             endwhile;
             $dolu_update=$dtbs->prepare("UPDATE doluluq set bos='$bos',dolu=$dolu where id=1");
             $dolu_update->execute();
     }
     //table num function
     function get_tables_num($dtbs){
        echo $this->common_result($dtbs,"select * from tables",1)->num_rows;
         /*echo $a->num_rows;*/
     }
  //single table function
     function get_table_single($dtbs,$id){
         return $single_table=$this->common_result($dtbs,"select * from tables where id='$id'",1);
   }
   //category function
     function get_category($dtbs){
         $category=$this->common_result($dtbs,"SELECT * FROM category",1);
             while ($cat=$category->fetch_assoc()):
             echo '<a class="btn btn-dark  mt-2" sectionId="'.$cat['id'].'">'.$cat['cat_name'].'</a><br>';
             endwhile;
      }
      function doluluq($dtbs){
          $doluluq=$this->common_result($dtbs,"SELECT * FROM doluluq",1);
          $dol=$doluluq->fetch_assoc();
          $toplam=($dol['dolu']+$dol['bos']);
          $hesab=($dol['dolu']/$toplam)*100;
          echo $tam_hesab=substr($hesab,0,4).'%';
      }
      function get_orders_num($dtbs){
          echo self::common_result($dtbs,"select * from orders",1)->num_rows;
      }

      function alert($message,$color){
          echo "<div class='alert alert-$color mt-2 text-center ' style='margin-left: 95px;'>$message</div>";
      }

     function qarson_sec($db){
         $qars=$this->common_result($db,"SELECT * FROM qarson where status=1",1);
         $qa=$qars->fetch_assoc();
          if ($qa['ad']!=""){
              echo $qa['ad'].'&nbsp&nbsp';
              echo '<a  href="actions.php?action=qarscixis" style="color:#DC3545;text-decoration:none">Çıxış et</a><br>';

          }else{

          }

     }



   }
    ?>