<?php
ob_start();
/*$servername = "localhost";
$username = "paypul_zm-db";
$password = "wjOH5bO1~0-L";*/
$servername = "localhost";
$username = "root";
$password = "";
try {
  $config = new PDO("mysql:host=$servername;dbname=cafe", $username, $password);
  $config->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
 class admin {
    private  $datas=array();
    private function warning($type,$mes,$page){
                echo '<div class="alert alert-'.$type.' text-center btn-block">'.$mes.'...</div>';
                        header("refresh:2,url='$page'");
    }
    function db_request($db,$db_request,$status=0){
        $response=$db->prepare($db_request);
        $response->execute();
        if($status==1):
            return $response->fetch();
         elseif ($status==2):
            return $response;
        endif;   //umumi srogu funksiyasi
    }
    //statistics datas
    function statistics($config){
        //orders count
            $get_orders=$this->db_request($config,"select SUM(quantity) from orders",1);
            $a=$get_orders['SUM(quantity)'];
            //tables count
            $get_tables=$config->prepare("select * from tables");
            $get_tables->execute();
            $num=$get_tables->rowCount();
           //$product rows
             $get_products=self::db_request($config,"select * from products",2)->rowCount();
            //doluluq faizi
             $dol=$this->db_request($config,"select * from doluluq",1);
             $toplam=($dol['dolu']+$dol['bos']);
             $hesab=($dol['dolu']/$toplam)*100;
             $tam_hesab=substr($hesab,0,4).'%';

        echo '<div class="row">
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">weekend</i>
                                </div>
                                <p class="card-category">Toplam sifariş</p>
                                <h3 class="card-title">'.$a.'</h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons text-danger">warning</i>
                                  <a href="#pablo">Get More Space...</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">equalizer</i>
                                </div>
                                <p class="card-category">Doluluq faizi</p>
                                <h3 class="card-title">'.$tam_hesab.'</h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons">local_offer</i> Tracked from Google Analytics
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">store</i>
                                </div>
                                <p class="card-category">Toplam masa</p>
                                <h3 class="card-title">'.$num.'</h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons">date_range</i> Last 24 Hours
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                  <i class="fa fa-twitter"></i>
                                </div>
                                <p class="card-category">Toplam məhsullar</p>
                                <h3 class="card-title">'.$get_products.'</h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons">update</i> Just Updated
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>';
    }
//ayarlari cekme funksiyasi
    function get_settings($config){

       $result=self::db_request($config,"select * from settings",1);

           if ($_POST):

               $title=htmlspecialchars($_POST['title']);

               $slogan=htmlspecialchars($_POST['slogan']);

               $MetaTitle=htmlspecialchars($_POST['MetaTitle']);

               $MetaDesc=htmlspecialchars($_POST['MetaDesc']);

               $MetaKey=htmlspecialchars($_POST['MetaKey']);

               $MetaAuthor=htmlspecialchars($_POST['MetaAuthor']);

               $MetaOwner=htmlspecialchars($_POST['MetaOwner']);

               $MetaCopy=htmlspecialchars($_POST['MetaCopy']);

               $LogoText=htmlspecialchars($_POST['LogoText']);

               $twitter=htmlspecialchars($_POST['twitter']);

               $facebook=htmlspecialchars($_POST['facebook']);

               $instagram=htmlspecialchars($_POST['instagram']);

               $PhoneNumber=htmlspecialchars($_POST['PhoneNumber']);

               $Mail=htmlspecialchars($_POST['Mail']);

               $Adress=htmlspecialchars($_POST['Adress']);

               $partnier_title=htmlspecialchars($_POST['partnier_title']);

               $portfolio_title=htmlspecialchars($_POST['portfolio_title']);

               $customer_title=htmlspecialchars($_POST['customer_title']);

               $contact_title=htmlspecialchars($_POST['contact_title']);
               $values_title=htmlspecialchars($_POST['values_title']);



               $setting_update=$config->prepare('update settings set title=?,slogan=?,MetaTitle=?,

                                                MetaDesc=?,MetaKey=?,MetaAuthor=?,MetaOwner=?,

                                                MetaCopy=?,LogoText=?,twitter=?,facebook=?,instagram=?,

                                                PhoneNumber=?,Mail=?,Adress=?,partnier_title=?,

                                                portfolio_title=?,customer_title=?,contact_title=?,values_title=?

                                                ');

               $setting_update->bindParam(1,$title,PDO::PARAM_STR);

               $setting_update->bindParam(2,$slogan,PDO::PARAM_STR);

               $setting_update->bindParam(3,$MetaTitle,PDO::PARAM_STR);

               $setting_update->bindParam(4,$MetaDesc,PDO::PARAM_STR);

               $setting_update->bindParam(5,$MetaKey,PDO::PARAM_STR);

               $setting_update->bindParam(6,$MetaAuthor,PDO::PARAM_STR);

               $setting_update->bindParam(7,$MetaOwner,PDO::PARAM_STR);

               $setting_update->bindParam(8,$MetaCopy,PDO::PARAM_STR);

               $setting_update->bindParam(9,$LogoText,PDO::PARAM_STR);

               $setting_update->bindParam(10,$twitter,PDO::PARAM_STR);

               $setting_update->bindParam(11,$facebook,PDO::PARAM_STR);

               $setting_update->bindParam(12,$instagram,PDO::PARAM_STR);

               $setting_update->bindParam(13,$PhoneNumber,PDO::PARAM_STR);

               $setting_update->bindParam(14,$Mail,PDO::PARAM_STR);

               $setting_update->bindParam(15,$Adress,PDO::PARAM_STR);

               $setting_update->bindParam(16,$partnier_title,PDO::PARAM_STR);

               $setting_update->bindParam(17,$portfolio_title,PDO::PARAM_STR);

               $setting_update->bindParam(18,$customer_title,PDO::PARAM_STR);

               $setting_update->bindParam(19,$contact_title,PDO::PARAM_STR);
               $setting_update->bindParam(20,$values_title,PDO::PARAM_STR);

               $setting_update->execute();

               echo '<div class="alert alert-success" role="alert">

                          <b>Site settings updated</b>

                    </div>';

               header('refresh:1,url=control.php?page=site_settings');

               else:
                   ?>
                   <form action="control.php?page=site_settings" method="post">

                       <div class="row">

                           <div class="col-lg-7 mx-auto">

                               <h3 class="text-info">Site Settings</h3>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Title</div>

                                   <div class="col-lg-9 border p-1">

                                       <input type="text" name="title" value="<?php echo $result['title']?>"   class="form-control">

                                   </div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Slogan</div>

                                   <div class="col-lg-9 border p-1">

                                       <input type="text" name="slogan" value="<?php echo $result['slogan']?>" class="form-control">

                                   </div>

                               </div>

                           </div>

                           <!-- ************-->



                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Meta Title</div>

                                   <div class="col-lg-9 border p-1">

                                       <input type="text" name="MetaTitle" value="<?php echo $result['MetaTitle']?>" class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Meta Description</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="MetaDesc" value="<?php echo $result['MetaDesc']?>"  class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Meta Keywords</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="MetaKey" value="<?php echo $result['MetaKey']?>"  class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Meta Author</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="MetaAuthor" value="<?php echo $result['MetaAuthor']?>"  class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->



                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Meta Owner</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="MetaOwner" value="<?php echo $result['MetaOwner']?>"  class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Meta Copy</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="MetaCopy" value="<?php echo $result['MetaCopy']?>" class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->



                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Logo Text</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="LogoText" value="<?php echo $result['LogoText']?>" class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Phone Number</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="PhoneNumber" value="<?php echo $result['PhoneNumber']?>" class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Mail</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="Mail" value="<?php echo $result['Mail']?>" class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->



                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Adress</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="Adress" value="<?php echo $result['Adress']?>" class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Facebook</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="facebook" value="<?php echo $result['facebook']?>" class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Twitter</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="twitter" value="<?php echo $result['twitter']?>" class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->
                           <div class="col-lg-7 mx-auto">
                               <div class="row">
                                   <div class="col-lg-3 border p-3 text-left">Instagram</div>
                                   <div class="col-lg-9 border p-1"><input type="text" name="instagram" value="<?php echo $result['instagram']?>" class="form-control"></div>
                               </div>

                           </div>

                           <!-- ************-->

                 <div class="col-lg-7 mx-auto">
                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Values Title</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="values_title" value="<?php echo $result['values_title']?>" class="form-control"></div>

                               </div>

                           </div>
                           <div class="col-lg-7 mx-auto">
                               <div class="row">
                                   <div class="col-lg-3 border p-3 text-left">Partnier Title</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="partnier_title" value="<?php echo $result['partnier_title']?>" class="form-control"></div>
                               </div>
                           </div>
                           <!-- ************-->
                           <div class="col-lg-7 mx-auto">
                               <div class="row">
                                   <div class="col-lg-3 border p-3 text-left">Portfolio Title</div>
                                   <div class="col-lg-9 border p-1"><input type="text" name="portfolio_title" value="<?php echo $result['portfolio_title']?>" class="form-control"></div>
                               </div>
                           </div>
                           <!-- ************-->
                           <div class="col-lg-7 mx-auto">
                               <div class="row">
                                   <div class="col-lg-3 border p-3 text-left">Customer Title</div>
                                   <div class="col-lg-9 border p-1"><input type="text" name="customer_title" value="<?php echo $result['customer_title']?>" class="form-control"></div>
                               </div>
                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto">

                               <div class="row">

                                   <div class="col-lg-3 border p-3 text-left">Contact Title</div>

                                   <div class="col-lg-9 border p-1"><input type="text" name="contact_title" value="<?php echo $result['contact_title']?>" class="form-control"></div>

                               </div>

                           </div>

                           <!-- ************-->

                           <div class="col-lg-7 mx-auto border-bottom">

                               <input type="submit" value="Edit" class="btn btn-info m-1">

                           </div>

                       </div>

                   </form>

               <?php

               endif;  //ayarlari cekme funksiyasi
    }
    //tables start
    function tables($config){
           echo '<a href="control.php?page=table_add"><div class="btn btn-success pull-right" style="background-color: #E91E63!important;">Əlavə et</div></a>';
         echo '<div class="row">
            
';
        $get_tables=$config->prepare("select * from tables");
        $get_tables->execute();
       $get_table=$get_tables->fetchAll(PDO::FETCH_ASSOC);
foreach ($get_table as $gt){
                  echo '<div class="col-md-4">
                            <div class="card card-product" data-count="3">
                              <div class="card-header card-header-image" data-header-animation="true">
                                <a href="#pablo">
                                  <img class="img" src="../img/images.jpg">
                                </a>
                              </div>
                              <div class="card-body">
                                <div class="card-actions text-center">
                                  <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                  </button>
                                  <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="View">
                                    <i class="material-icons">art_track</i>
                                  </button>
                                  <button type="button" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                    <i class="material-icons"><a href="control.php?page=table_edit&id='.$gt['id'].'">edit</a></i>
                                  </button>
                                  <button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="Remove">
                                    <i class="material-icons"><a data-confirm="Silmək istədiyinizə əminmisiniz?" href="control.php?page=table_delete&id='.$gt['id'].'">close</a></i>
                                  </button>
                                </div>
                          <!--       <h4 class="card-title">
                                  <a href="#pablo">Cozy 5 Stars Apartment</a>
                                </h4> -->
                                <div class="card-description">
                             '.$gt['table_name'].'
                                </div>
                              </div>  
                            </div>
                          </div>';
                      }
                          echo '<div>';
                         }
    function table_edit($config)
    {
        $get_id=htmlspecialchars($_GET['id']);
             @$table_name=htmlspecialchars($_POST['table_name']);
          @$table_id=htmlspecialchars($_POST['id']);
       echo '<div class="row">';
        if ($_POST){

           if ($table_name!="" && $table_id!=""){

               $table_edit=$config->prepare("UPDATE tables SET table_name='$table_name' where id=$table_id");
               $table_edit->execute();
               self::warning('success','Masa Dəyişdirildi','control.php?page=tables');


           }else{
               echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=table_edit&id='.$table_id.'');
           }
        }else{
            if ($get_id!=""){
                  $table_select=$config->prepare("SELECT * FROM tables where id='$get_id'");
                  $table_select->execute();
                  $tab_sel=$table_select->fetch();
       echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Masa dəyişdir</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Masanın adı</label>
                      <input type="text" name="table_name" value="'.$tab_sel['table_name'].'" class="form-control" id="exampleEmail">
                      <input type="hidden" class="form-control" name="id" value="'.$get_id.'">
                    </div>
                           <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Güncəllə</button>
                </div>
                  </form>
                </div>
         
              </div>
           </div>';
           }}
            echo '</div>';
    }
    function table_add($config)
        {
             @$table_name=htmlspecialchars($_POST['table_name']);
       echo '<div class="row">';
        if ($_POST){
           if ($table_name!=""){
               $table_insert=$config->prepare("insert into tables (table_name) VALUES ('$table_name')");
               $table_insert->execute();
               self::warning('success','Masa Əlavə edildi','control.php?page=tables');
           }else{
               echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=table_add');
           }
        }else{
       echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Masa Əlavə et</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Masanın adı</label>
                      <input type="text" name="table_name" class="form-control" id="exampleEmail">
                    </div>
                     <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Əlavə et</button>
                </div>
                  </form>
                </div>
              </div>
           </div>';
           }
            echo '</div>';
    }
    function table_delete($config){
  @$tab_id=$_GET['id'];
  if ($tab_id!="" && is_numeric($tab_id)):
    self::db_request($config,"delete  from  tables where  id=$tab_id");
  $this->warning('danger',"Masa Silindi",'control.php?page=tables');
  else:
self::warning('danger',"xƏta oldu",'control.php?page=tables');
  endif;
}
//tables end
//product start
    function products($config){
        $product_select=$this->db_request($config,"select * from products",'2');
        $pr_sel=$product_select->fetchAll(PDO::FETCH_ASSOC);
        //kateqoriya select
        echo '
<a href="control.php?page=product_add">
             <div class="btn btn-success " style="background-color: #4CAF50!important;">
             Əlavə et
             </div>
              </a>';
       echo '
       <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Məhsullar</h4>
                </div>               
                <div class="card-body">
                  <div class="table-responsive">            
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Adı</th>
                          <th>Qiyməti</th>
                          <th>Kateqoriya adı</th>
                          <th class="text-right">Əməliyyat</th>
                        </tr>
                      </thead>
                      <tbody>
                      ';
              $sira=1;
       foreach ($pr_sel as $pr):
       $cat_id=$pr['cat_id'];
       $cat_select=self::db_request($config,"SELECT * FROM category where id=$cat_id",1);
                echo '
                        <tr>
                          <td class="text-center">'.$sira++.'</td>
                          <td>'.$pr['name'].'</td>
                          <td>'.$pr['price'].' Azn</td>
                          <td>'.$cat_select['cat_name'].'</td>
                          <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                              <i class="material-icons">person</i>
                            </button>
                            <a href="control.php?page=product_edit&id='.$pr['id'].'"><button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                            </button>
                            </a>
                           <a href="control.php?page=product_delete&id='.$pr['id'].'" data-confirm="Silmək istədiyinizə əminmisiniz?"><button type="button" rel="tooltip" class="btn btn-danger" data-original-title="" title="">
                              <i class="material-icons">close</i>
                            </button>
                            </a>
                          </td>
                        </tr>
';
       endforeach;
       echo '
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
       ';
}
function product_add($config)
        {
            @$pr_name=htmlspecialchars($_POST['name']);
            @$price=htmlspecialchars($_POST['price']);
            @$cat_id=htmlspecialchars($_POST['cat_id']);
           echo '<div class="row">';
            if ($_POST){
              if ($pr_name!="" && $price!="" && $cat_id!=""){
               $table_insert=$config->prepare("insert into products (name,price,cat_id) VALUES ('$pr_name','$price',$cat_id)");
               $table_insert->execute();
               self::warning('success','Məhsul Əlavə edildi','control.php?page=products');
              }else{
               echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=product_add');
               }
         }else{
           $cat_select=self::db_request($config,"SELECT * FROM category ",2)->fetchAll(PDO::FETCH_ASSOC);
         echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Məhsul Əlavə et</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Məhsulun adı</label>
                      <input type="text" name="name" class="form-control" id="exampleEmail">
                      </div>
                         <div class="form-group bmd-form-group">
                  <label for="exampleEmail" class="bmd-label-floating">Məhsulun qiyməti</label>
                      <input type="text" name="price" class="form-control" id="exampleEmail">
                    </div>
                     <label  class="bmd-label-floating">Məhsulun Kateqoriyası</label>
                  <div class="form-group">
<select class="form-control" name="cat_id" id="exampleFormControlSelect1">';
       foreach ($cat_select as $ct):?>
       <option value="<?php echo $ct['id']?>" ><?php echo $ct['cat_name']; ?></option>
       <?php endforeach;
       echo '
    </select>
  </div> <br>
                     <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Əlavə et</button>
                </div>
                  </form>
                </div>
              </div>
           </div>';
           }
            echo '</div>';
    }
function product_edit($config){
          $get_id=htmlspecialchars($_GET['id']);
          @$prod_name=htmlspecialchars($_POST['name']);
          @$pr_price=htmlspecialchars($_POST['price']);
          @$cat_id=htmlspecialchars($_POST['cat_id']);
          echo '<div class="row">';
          if ($_POST){
           if ($prod_name!="" && $pr_price!="" && $cat_id!=""){
               $pr_edit=$config->prepare("UPDATE products SET name='$prod_name',price='$pr_price',cat_id='$cat_id' where id=$get_id");
               $pr_edit->execute();
               self::warning('success','Məhsul Dəyişdirildi','control.php?page=products');
           }else{
               echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=product_edit&id='.$get_id.'');
           }
           }else{
              if ($get_id!=""){
                  $pr_select=$config->prepare("SELECT * FROM products where id='$get_id'");
                  $pr_select->execute();
                  $pr_sel=$pr_select->fetch();
                   $categ_id=$pr_sel['cat_id'];
                  //Kateqoriya select
                  $cat_select=self::db_request($config,"SELECT * FROM category ",2)->fetchAll(PDO::FETCH_ASSOC);
       echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Məhsul dəyişdir</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Məhsulun  adı</label>
                      <input type="text" name="name" value="'.$pr_sel['name'].'" class="form-control" id="exampleEmail">
                    <label >Məhsulun  qiyməti</label>
                       <input type="text" name="price" class="form-control" value="'.$pr_sel['price'].'">
                         <label >Məhsulun kateqoriyası</label>
                  <div class="form-group">
    <select class="form-control" name="cat_id" id="exampleFormControlSelect1">
    ';
       foreach ($cat_select as $ct):?>
       <option value="<?php echo $ct['id']?>"  <?php if ($ct['id']==$pr_sel['cat_id']): echo 'selected';endif;  ?>  ><?php echo $ct['cat_name']; ?></option>
       <?php endforeach;
       echo '
    </select>
  </div>   
                      <input type="hidden" class="form-control" name="id" value="'.$get_id.'">
                    </div>
                           <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Güncəllə</button>
                </div>
                  </form>
                </div> 
              </div>
           </div>';
           }}
            echo '</div>';
}
function product_delete($config){
        @$get_id=htmlspecialchars($_GET['id']);
        $pr_ord=$config->prepare("select * from orders where product_id=$get_id");
        $pr_ord->execute();
        $pr_sec=$pr_ord->fetchAll();
        if ($pr_ord->rowCount()!=0){
                                            $this->warning('danger',"Bu məhsul masalarda var silə bilməzsiniz!!!",'control.php?page=products');

            foreach ($pr_sec as $pr){
                $tab=$pr['table_id'];
                $sec=$config->prepare("SELECT * FROM tables where id=$tab");
                $sec->execute();
                $s=$sec->fetchAll();
                foreach ($s as $t){
                echo "<div class='alert alert-inverse'>Masanın adı ".$t['table_name']."</div><br>";

}
}
            }else{

        if($get_id!="" && is_numeric($get_id)):
        $pr_delete=self::db_request($config,"DELETE FROM products where id='$get_id'",0);
        $this->warning("danger","Məhsul silindi",'control.php?page=products');
        else:
        $this->warning("danger","Xeta baş verdi",'control.php?page=products');
        endif;
              }

}
//product end
//kateqoriya
function category($config){

        echo '
<a href="control.php?page=category_add">
             <div class="btn btn-success " style="background-color: #4CAF50!important;">
             Əlavə et
             </div>
              </a>';
       echo '
       <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Kateqoriyalar</h4>     
                </div>             
                <div class="card-body">
                  <div class="table-responsive">           
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Kateqoriya Adı</th>
                          <th class="text-right">Əməliyyat</th>
                        </tr>
                      </thead>
                      <tbody>
                      ';
       $cat_select=self::db_request($config,"SELECT * FROM category",2)->fetchAll();
       $sira=1;
       foreach ($cat_select as $pr):
                echo '
                        <tr>
                          <td class="text-center">'.$sira++.'</td>
                          <td>'.$pr['cat_name'].'</td>
                          <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                              <i class="material-icons">person</i>
                            </button>
                            <a href="control.php?page=category_edit&id='.$pr['id'].'"><button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                            </button>
                            </a>
                           <a href="control.php?page=category_delete&id='.$pr['id'].'" data-confirm="Silmək istədiyinizə əminmisiniz?"><button type="button" rel="tooltip" class="btn btn-danger" data-original-title="" title="">
                              <i class="material-icons">close</i>
                            </button>
                            </a>
                          </td>
                        </tr>
';
       endforeach;
       echo '
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
       ';
}
function category_add($config)
        {
            @$cat_name=htmlspecialchars($_POST['cat_name']);

           echo '<div class="row">';
            if ($_POST){
              if ($cat_name!=""){
               $cat_insert=$config->prepare("insert into category (cat_name) VALUES ('$cat_name')");
               $cat_insert->execute();
               self::warning('success','Məhsul Əlavə edildi','control.php?page=categories');
              }else{
               echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=category_add');
               }
         }else{
         echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Məhsul Əlavə et</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Kateqoriyanın adı</label>
                      <input type="text" name="cat_name" class="form-control" id="exampleEmail">
                      </div>
                     <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Əlavə et</button>
                </div>
                  </form>
                </div>
              </div>
           </div>';
           }
            echo '</div>';
    }
    function category_edit($config){
          $get_id=htmlspecialchars($_GET['id']);
          @$cat_name=htmlspecialchars($_POST['cat_name']);
          @$cat_id=htmlspecialchars($_POST['id']);
          echo '<div class="row">';
          if ($_POST){
           if ($cat_name!=""  && $cat_id!=""){
               $pr_edit=$config->prepare("UPDATE category SET cat_name='$cat_name' where id=$get_id");
               $pr_edit->execute();
               self::warning('success','Kateqoriya Dəyişdirildi','control.php?page=categories');
           }else{
               echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=category_edit&id='.$get_id.'');
           }
           }else{
              if ($get_id!=""){
                  $cat_select=$config->prepare("SELECT * FROM category where id='$get_id'");
                  $cat_select->execute();
                  $cat_sel=$cat_select->fetch();

                  //Kateqoriya select
                  $cat_select=self::db_request($config,"SELECT * FROM category ",2)->fetchAll(PDO::FETCH_ASSOC);
       echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Kateqoriya dəyişdir</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Kateqoriya  adı</label>
                      <input type="text" name="cat_name" value="'.$cat_sel['cat_name'].'" class="form-control" id="exampleEmail">
 
                      <input type="hidden" class="form-control" name="id" value="'.$get_id.'">
                    </div>
                           <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Güncəllə</button>
                </div>
                  </form>
                </div> 
              </div>
           </div>';
           }}
            echo '</div>';
}
function category_delete($config){
    $get_id=$_GET['id'];
    if ($get_id!="" && is_numeric($get_id)){
  $pr_sel=self::db_request($config,"SELECT * FROM products where cat_id=$get_id",2);
 if($pr_sel->rowCount()>0){
     $sel=$pr_sel->fetchAll();
 foreach ($sel as $pr){
     $id=$pr['id'];
     $ord_sel=$this->db_request($config,"SELECT * FROM orders where product_id=$id",2)->rowCount();
     }
      if ($ord_sel>0){
         self::warning("danger","Masada bu kateqoriyaya məxsus sifariş vardır silə bilməzsiniz!!!","control.php?page=categories");
     }else{
         self::db_request($config,"DELETE FROM category where id=$get_id",0);
         $this->db_request($config,"DELETE FROM products where cat_id=$get_id",0);
         self::warning("success","Kateqoriya Silindi!!!","control.php?page=categories");
     }
 }

 else{
        self::db_request($config,"DELETE FROM category where id=$get_id",0);
         $this->db_request($config,"DELETE FROM products where cat_id=$get_id",0);
         self::warning("success","Kateqoriya Silindi!!!","control.php?page=categories");
 }
    }else{
        $this->warning("danger","Xeta","control.php?page=categories");
    }
}
//qarsonlar

//adminler

    function admins($config){

        echo '
<a href="control.php?page=admin_add">
             <div class="btn btn-success " style="background-color: #4CAF50!important;">
             Əlavə et
             </div>
              </a>';
        echo '
       <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Adminlər</h4>     
                </div>             
                <div class="card-body">
                  <div class="table-responsive">           
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Admin Adı</th>
                          <th class="text-right">Əməliyyat</th>
                        </tr>
                      </thead>
                      <tbody>
                      ';
        $cat_select=self::db_request($config,"SELECT * FROM admin",2)->fetchAll();
        $sira=1;
        foreach ($cat_select as $pr):
            echo '
                        <tr>
                          <td class="text-center">'.$sira++.'</td>
                          <td>'.$pr['login'].'</td>
                          <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                              <i class="material-icons">person</i>
                            </button>
                            <a href="control.php?page=admin_edit&id='.$pr['id'].'"><button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                            </button>
                            </a>
                           <a href="control.php?page=admin_delete&id='.$pr['id'].'" data-confirm="Silmək istədiyinizə əminmisiniz?">
                           <button type="button" rel="tooltip" class="btn btn-danger" data-original-title="" title="">
                              <i class="material-icons">close</i>
                            </button>
                            </a>
                          </td>
                        </tr>
';
        endforeach;
        echo '
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
       ';
    }
    function admin_add($config)
    {
        @$login=htmlspecialchars($_POST['login']);
        @$pass=htmlspecialchars($_POST['password']);

        @$password=md5(sha1(md5($pass)));


        echo '<div class="row">';
        if ($_POST){
            if ($login!="" && $password!=""){
                $admin_insert=$config->prepare("insert into admin (login,password) VALUES ('$login','$password')");
                $admin_insert->execute();
                self::warning('success','Admin Əlavə edildi','control.php?page=admin');
            }else{
                echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=admin_add');
            }
        }else{
            echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Admin Əlavə et</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Adminin adı</label>
                      <input type="text" name="login" class="form-control" id="exampleEmail">
                      <input type="password" name="password" class="form-control" id="exampleEmail">
                      </div>
                     <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Əlavə et</button>
                </div>
                  </form>
                </div>
              </div>
           </div>';
        }
        echo '</div>';
    }
    function admin_edit($config){
        $get_id=htmlspecialchars($_GET['id']);
        @$login=htmlspecialchars($_POST['login']);
        @$pass=htmlspecialchars($_POST['password']);
        @$post_id=htmlspecialchars($_POST['id']);
        @$password=md5(sha1(md5($pass)));

        echo '<div class="row">';
        if ($_POST){
            if ($login!=""  && $pass!=""){
                $pr_edit=$config->prepare("UPDATE admin SET login='$login',password='$password' where id=$post_id");
                $pr_edit->execute();
                self::warning('success','Admin Dəyişdirildi','control.php?page=admins');
            }else{
                echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=admin_edit&id='.$get_id.'');
            }
        }else{
            if ($get_id!=""){
                $cat_select=$config->prepare("SELECT * FROM admin where id='$get_id'");
                $cat_select->execute();
                $cat_sel=$cat_select->fetch();

                echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Admin dəyişdir</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Admin  adı</label>
                      <input type="text" name="login" value="'.$cat_sel['login'].'" class="form-control" id="exampleEmail">
                      <input type="hidden" class="form-control" name="id" value="'.$get_id.'">
                    </div>
                    
                      <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Admin  Parolu</label>
                      <input type="password" name="password" value="'.$cat_sel['password'].'" class="form-control" id="exampleEmail">
       
                    </div>
                    
                <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Güncəllə</button>
                </div>
                  </form>
                </div> 
              </div>
           </div>';
            }}
        echo '</div>';
    }
    function admin_delete($config){
        $get_id=$_GET['id'];
        if ($get_id!="" && is_numeric($get_id)) {
            self::db_request($config, "DELETE FROM admin where id=$get_id", 0);
            self::warning("success", "Admin Silindi!!!", "control.php?page=admins");
        }
        else{
            $this->warning("danger","Xeta","control.php?page=admins");
        }
    }

//adminler

    function qarsons($config){
        echo '
<a href="control.php?page=qarson_add">
             <div class="btn btn-success " style="background-color: #4CAF50!important;">
             Əlavə et
             </div>
              </a>';
        echo '
       <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Qarsonlar</h4>     
                </div>             
                <div class="card-body">
                  <div class="table-responsive">           
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Qarson Adı</th>
                          <th class="text-right">Əməliyyat</th>
                        </tr>
                      </thead>
                      <tbody>
                      ';
        $cat_select=self::db_request($config,"SELECT * FROM qarson",2)->fetchAll();
        $sira=1;
        foreach ($cat_select as $pr):
            echo '
                        <tr>
                          <td class="text-center">'.$sira++.'</td>
                          <td>'.$pr['ad'].'</td>
                          <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                              <i class="material-icons">person</i>
                            </button>
                            <a href="control.php?page=qarson_edit&id='.$pr['id'].'"><button type="button" rel="tooltip" class="btn btn-success" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                            </button>
                            </a>
                           <a id="a" href="control.php?page=qarson_delete&id='.$pr['id'].'" data-confirm="Silmək istədiyinizə əminmisiniz?" >
                           <button type="button" rel="tooltip"   class="btn btn-danger" data-original-title="" title="">
                              <i class="material-icons">close</i>       
                            </button>
                            </a>
                          </td>
                        </tr>
';
        endforeach;
        echo '
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
       ';
    }
    function qarson_add($config)
    {
        @$name=htmlspecialchars($_POST['ad']);
        @$sifre=htmlspecialchars($_POST['sifre']);

        echo '<div class="row">';
        if ($_POST){
            if ($name!=""){
                $qar_insert=$config->prepare("insert into qarson (ad,sifre) VALUES ('$name','$sifre')");
                $qar_insert->execute();
                self::warning('success','Qarson Əlavə edildi','control.php?page=qarsons');
            }else{
                echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=qarson_add');
            }
        }else{
            echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Qarson Əlavə et</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                          <label for="exampleEmail" class="bmd-label-floating">Qarsonun adı</label>
                      <input type="text" name="ad" class="form-control" id="exampleEmail">
                      </div>
                           <div class="form-group bmd-form-group">
                          <label for="exampleEmail" class="bmd-label-floating">Qarsonun şifrəsi</label>
                      <input type="text" name="sifre" class="form-control" id="exampleEmail">
                      </div>
                     <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Əlavə et</button>
                </div>
                  </form>
                </div>
              </div>
           </div>';
        }
        echo '</div>';
    }
    function qarson_edit($config){
        $get_id=htmlspecialchars($_GET['id']);
        @$ad=htmlspecialchars($_POST['ad']);
        @$sifre=htmlspecialchars($_POST['sifre']);
        @$qarson_id=htmlspecialchars($_POST['id']);
        echo '<div class="row">';
        if ($_POST){
            if ($ad!=""  && $qarson_id!=""){
                $pr_edit=$config->prepare("UPDATE qarson SET ad='$ad',sifre='$sifre' where id=$get_id");
                $pr_edit->execute();
                self::warning('success','Qarson Dəyişdirildi','control.php?page=qarsons');
            }else{
                echo '<div class="alert alert-danger btn-block">Boş buraxmayın</div>';
                header('refresh:1,url="control.php?page=qarson_edit&id='.$get_id.'');
            }
        }else{
            if ($get_id!=""){
                $cat_select=$config->prepare("SELECT * FROM qarson where id='$get_id'");
                $cat_select->execute();
                $cat_sel=$cat_select->fetch();

                //Kateqoriya select
                $cat_select=self::db_request($config,"SELECT * FROM qarson ",2)->fetchAll(PDO::FETCH_ASSOC);
                echo '
<div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Qarson dəyişdir</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="">
                    <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Qarson  adı</label>
                      <input type="text" name="ad" value="'.$cat_sel['ad'].'" class="form-control" id="exampleEmail">
 
                      <input type="hidden" class="form-control" name="id" value="'.$get_id.'">
                    </div>
                               <div class="form-group bmd-form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Şifrə</label>
                      <input type="text" name="sifre" value="'.$cat_sel['sifre'].'" class="form-control" id="exampleEmail">
                    </div>
     
                           <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Güncəllə</button>
                </div>
                  </form>
                </div> 
              </div>
           </div>';
            }}
        echo '</div>';
    }
    function qarson_delete($config){
        $get_id=$_GET['id'];
        if ($get_id!="" && is_numeric($get_id)) {
            self::db_request($config, "DELETE FROM qarson where id=$get_id", 0);
            self::warning("success", "Qarson Silindi!!!", "control.php?page=qarsons");
        }
        else{
            $this->warning("danger","Xeta","control.php?page=qarsons");
        }
    }

//table_report
    function reports($config)
{
    @$date=$_GET['action'];
    switch ($date):
    case 'dunen':
   //dunen report datasi cekildi
   $this->db_request($config,'Truncate temp_table',2);
    $data=$config->prepare("SELECT * FROM report where report_date=DATE_SUB(CURRENT_DATE(),INTERVAL 1 day)");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //dunen report datasi cekildi
        break;
        case 'bugun':
                    //bugun report datasi cekildi
                      $this->db_request($config,'Truncate temp_table',2);//table bosaldir
    $data=$config->prepare("SELECT * FROM report where report_date=CURRENT_DATE()");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //bugun report datasi cekildi
        break;
             case 'buhefte':
        //heftelik report datasi cekildi
     $this->db_request($config,'Truncate temp_table',2);
    $data=$config->prepare("SELECT * FROM report where YEARWEEK(report_date) = YEARWEEK(CURRENT_DATE)");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //heftelik report datasi cekildi
        break;
    case 'buay':
   //ayliq report datasi cekildi
    $data=$config->prepare("SELECT * FROM report where report_date >= DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH )");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //ayliq report datasi cekildi
        break;
        case 'butunzaman':
                    //heftelik report datasi cekildi
    $this->db_request($config,'Truncate temp_table',2);//table bosaldir
    $data=$config->prepare("SELECT * FROM report");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //heftelik report datasi cekildi
        break;
   default:
        //heftelik report datasi cekildi
     $this->db_request($config,'Truncate temp_table',2);//table bosaldir
    $data=$config->prepare("SELECT * FROM report where YEARWEEK(report_date) = YEARWEEK(CURRENT_DATE)");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //heftelik report datasi cekildi
    break;
    endswitch;

    if (@$_POST['report']){
        $date1=$_POST['tarix1'];
        $date2=$_POST['tarix2'];
        $this->db_request($config,'Truncate temp_table',2);
    $data=$config->prepare("SELECT * FROM report where DATE(report_date) BETWEEN '$date1' and '$date2'");
    $data->execute();
    if ($data->rowCount()==0){
        $this->warning('danger',"Heçbir məlumat tapılmadı",'control.php?page=reports');

        exit();
    }else{
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
    }
    }
           echo '<div class="col-md-9">
                  <div class="card-body">
                   <a href="control.php?page=reports&action=dunen"><button class="btn">Dünən</button></a>
                   <a href="control.php?page=reports&action=bugun"><button class="btn btn-primary">Bugün</button></a>
                   <a href="control.php?page=reports&action=buhefte"><button class="btn btn-info">Bu həftə</button></a>
                   <a href="control.php?page=reports&action=buay"><button class="btn btn-warning">Bu ay</button></a>
                   <a href="control.php?page=reports&action=butunzaman"><button class="btn btn-success">Bütün Zamanlar</button></a>
                   ';
    if (@$date1!="" && @$date2!="")
    {
        echo '

<!-- Button trigger modal --><br>
<button id="btnExport" onClick="fnExcelReport()">Export to xls</button>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Report Çıxarış
</button>

<script>

function fnExcelReport() {
  var table = document.getElementById("theTable"); // id of table
  var tableHTML = table.outerHTML;
  var fileName = "download.xls";

  var msie = window.navigator.userAgent.indexOf("MSIE ");

  // If Internet Explorer
  if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
    dummyFrame.document.open("txt/html", "replace");
    dummyFrame.document.write(tableHTML);
    dummyFrame.document.close();
    dummyFrame.focus();
    return dummyFrame.document.execCommand("SaveAs", true, fileName);
  }
  //other browsers
  else {
    var a = document.createElement("a");
    tableHTML = tableHTML.replace(/  /g, "").replace(/ /g, "%20"); // replaces spaces
    a.href = "data:application/vnd.ms-excel," + tableHTML;
    a.setAttribute("download", fileName);
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  }
}

</script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 ';

         $date1=$_POST['tarix1'];
        $date2=$_POST['tarix2'];
    $data=$config->prepare("SELECT * FROM report where DATE(report_date) BETWEEN '$date1' and '$date2'");
    $data->execute();
    if ($data->rowCount()==0){
        $this->warning('danger',"Heçbir məlumat tapılmadı",'control.php?page=reports');

        exit();
    }else{
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
    }

  $tab_ins=$config->prepare("select * from temp_table");
    $tab_ins->execute();
    if ($tab_ins->rowCount()==0){
        foreach ($sec as $s){
            //tab-name cekmek ucun
            $id=$s['table_id'];
            $tab=$config->prepare("SELECT * FROM tables where id='$id'");
            $tab->execute();
            $tab_sec=$tab->fetch();
             $tab_name=$tab_sec['table_name'];
                //tab-name cekmek ucun

            $temp_tab=$config->prepare("SELECT * FROM temp_table where table_id=$id");
            $temp_tab->execute();
           if($temp_tab->rowCount()==0){
               //insert
                $has=$s['quantity']*$s['product_price'];
                $eded=$s['quantity'];
/*                $ins_has=$config->prepare("INSERT INTO temp_table(table_id,)");*/
                $temp_ins=$this->db_request($config,"INSERT INTO temp_table(table_id,table_name,hasilat,quantity) VALUES ($id,'$tab_name',$has,$eded)",0);

           }else{
               //update
               $last_upd=$temp_tab->fetch();
               $last_has=$last_upd['hasilat']+($s['quantity']*$s['product_price']);
               $last_eded=$last_upd['quantity']+$eded;
               $last_name=$last_upd['table_name'];
               $last_upd=$this->db_request($config,"UPDATE temp_table set table_name='$last_name',hasilat=$last_has,quantity=$last_eded where table_id=$id",0);

           }
        }
    }
    $last_week_sec=self::db_request($config,"SELECT * FROM temp_table order by hasilat desc",2);
    $la=$last_week_sec->fetchAll(PDO::FETCH_ASSOC);
echo '

<button id="btnExport" onClick="fnExcelReport()">Export to xls</button>
<br />
<br />




<table id="theTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ad</th>
      <th scope="col">Ədəd</th>
      <th scope="col">Hasilat</th>
    </tr>
  </thead>
  <tbody>';
$say=1;
$toplam_eded=0;
$toplam_hasil=0;
      foreach ($la as $ls){ ?>
    <tr>
      <th scope="row"><?php echo $say++;?></th>
      <td><?php echo $ls['table_name'];?></td>
      <td><?php echo $ls['quantity'];?> Ədəd</td>
      <td><?php echo $ls['hasilat'];?> Azn</td>
    </tr>
    <?php $toplam_eded+=$ls['quantity']; ?>
    <?php $toplam_hasil+=$ls['hasilat'];?>
  <?php }echo ' 

  </tbody>
</table>

    <div class="col-md-12">
                  <div class="card-body">
                <button style="width: 216px" class="btn">Toplam ədəd - '.$toplam_eded.' Ədəd</button>
                <button class="btn btn-primary">Toplam Hasilat - '.number_format($toplam_hasil,'2','.','.').'AZN</button>
        
                  </div>
                </div>
         
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
        <button type="button" onclick="printData();" class="btn btn-primary">Yaddaşda saxla</button>
      </div>
    </div>
  </div>
</div>
';
    }

                     echo '           
                   <form action="" method="post" 
                           <div class="col-md-3">                 
                   <input type="date" name="tarix1" class="form-control" >
                   <input type="date" name="tarix2" class="form-control" >
                   <input type="submit" class="btn btn-primary" name="report" value="Report" >
                   </div>
                   </form>       
                   </div>
                  </div>
                </div>';
    $tab_ins=$config->prepare("select * from temp_table");
    $tab_ins->execute();
    if ($tab_ins->rowCount()==0){
        foreach ($sec as $s){
            //tab-name cekmek ucun
            $id=$s['table_id'];
            $tab=$config->prepare("SELECT * FROM tables where id='$id'");
            $tab->execute();
            $tab_sec=$tab->fetch();
             $tab_name=$tab_sec['table_name'];
                //tab-name cekmek ucun

            $temp_tab=$config->prepare("SELECT * FROM temp_table where table_id=$id");
            $temp_tab->execute();
           if($temp_tab->rowCount()==0){
               //insert
                $has=$s['quantity']*$s['product_price'];
                $eded=$s['quantity'];
/*                $ins_has=$config->prepare("INSERT INTO temp_table(table_id,)");*/
                $temp_ins=$this->db_request($config,"INSERT INTO temp_table(table_id,table_name,hasilat,quantity) VALUES ($id,'$tab_name',$has,$eded)",0);

           }else{
               //update
               $last_upd=$temp_tab->fetch();
               $last_has=$last_upd['hasilat']+($s['quantity']*$s['product_price']);
               $last_eded=$last_upd['quantity']+$eded;
               $last_name=$last_upd['table_name'];
               $last_upd=$this->db_request($config,"UPDATE temp_table set table_name='$last_name',hasilat=$last_has,quantity=$last_eded where table_id=$id",0);

           }
        }
    }
    $last_week_sec=self::db_request($config,"SELECT * FROM temp_table order by hasilat desc",2);
    $la=$last_week_sec->fetchAll(PDO::FETCH_ASSOC);
echo '<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ad</th>
      <th scope="col">Ədəd</th>
      <th scope="col">Hasilat</th>
    </tr>
  </thead>
  <tbody>';
$say=1;
$toplam_eded=0;
$toplam_hasil=0;
      foreach ($la as $ls){ ?>
    <tr>
      <th scope="row"><?php echo $say++;?></th>
      <td><?php echo $ls['table_name'];?></td>
      <td><?php echo $ls['quantity'];?> Ədəd</td>
      <td><?php echo $ls['hasilat'];?> Azn</td>
    </tr>
    <?php $toplam_eded+=$ls['quantity']; ?>
    <?php $toplam_hasil+=$ls['hasilat'];?>
  <?php }echo ' 

  </tbody>
</table>
    <div class="col-md-8">
                  <div class="card-body">
                <button class="btn">Toplam ədəd - '.$toplam_eded.' Ədəd</button>
                <button class="btn btn-primary">Toplam Hasilat - '.$toplam_hasil.' AZN</button>
        
                  </div>
                </div>';
}
//table_report
//product report
    function product_reports($config)
{
    @$date=$_GET['action_prod'];
    switch ($date):
    case 'dunen':
   //dunen report datasi cekildi
   $this->db_request($config,'Truncate temp_product',2);
    $data=$config->prepare("SELECT * FROM report where report_date=DATE_SUB(CURRENT_DATE(),INTERVAL 1 day)");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //dunen report datasi cekildi
        break;
        case 'bugun':
                    //bugun report datasi cekildi
     $this->db_request($config,'Truncate temp_product',2);//table bosaldir
    $data=$config->prepare("SELECT * FROM report where report_date=CURRENT_DATE()");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //bugun report datasi cekildi
        break;
             case 'buhefte':
        //heftelik report datasi cekildi
     $this->db_request($config,'Truncate temp_product',2);
    $data=$config->prepare("SELECT * FROM report where YEARWEEK(report_date) = YEARWEEK(CURRENT_DATE)");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //heftelik report datasi cekildi
        break;
    case 'buay':
   //ayliq report datasi cekildi
    $data=$config->prepare("SELECT * FROM report where report_date >= DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH )");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //ayliq report datasi cekildi
        break;
        case 'butunzaman':
                    //heftelik report datasi cekildi
    $this->db_request($config,'Truncate temp_product',2);//table bosaldir
    $data=$config->prepare("SELECT * FROM report");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //heftelik report datasi cekildi
        break;
   default:
        //heftelik report datasi cekildi
     $this->db_request($config,'Truncate temp_product',2);//table bosaldir
    $data=$config->prepare("SELECT * FROM report where YEARWEEK(report_date) = YEARWEEK(CURRENT_DATE)");
    $data->execute();
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
  //heftelik report datasi cekildi
    break;
    endswitch;
        if (@$_POST['report']){
        $date1=$_POST['tarix1'];
        $date2=$_POST['tarix2'];
        $this->db_request($config,'Truncate temp_product',2);
    $data=$config->prepare("SELECT * FROM report where DATE(report_date) BETWEEN '$date1' and '$date2'");
    $data->execute();
    if ($data->rowCount()==0){
        $this->warning('danger',"Heçbir məlumat tapılmadı",'control.php?page=product_reports');

        exit();
    }else{
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
    }
    }
           echo '<div class="col-md-8">
                  <div class="card-body">
                   <a href="control.php?page=product_reports&action_prod=dunen"><button class="btn">Dünən</button></a>
                   <a href="control.php?page=product_reports&action_prod=bugun"><button class="btn btn-primary">Bugün</button></a>
                   <a href="control.php?page=product_reports&action_prod=buhefte"><button class="btn btn-info">Bu həftə</button></a>
                   <a href="control.php?page=product_reports&action_prod=buay"><button class="btn btn-warning">Bu ay</button></a>
                   <a href="control.php?page=product_reports&action_prod=butunzaman"><button class="btn btn-success">Bütün Zamanlar</button></a>
                   
                      ';
    if (@$date1!="" && @$date2!="")
    {
        echo '
<!-- Button trigger modal --><br>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Report Çıxarış
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 ';

         $date1=$_POST['tarix1'];
        $date2=$_POST['tarix2'];
    $data=$config->prepare("SELECT * FROM report where DATE(report_date) BETWEEN '$date1' and '$date2'");
    $data->execute();
    if ($data->rowCount()==0){
        $this->warning('danger',"Heçbir məlumat tapılmadı",'control.php?page=product_reports');
        exit();
    }else{
    $sec=$data->fetchAll(PDO::FETCH_ASSOC);
    }
  $tab_ins=$config->prepare("select * from temp_product");
    $tab_ins->execute();
    if ($tab_ins->rowCount()==0){
        foreach ($sec as $s){
            //tab-name cekmek ucun
            $id=$s['product_id'];
            $tab=$config->prepare("SELECT * FROM products where id='$id'");
            $tab->execute();
            $tab_sec=$tab->fetch();
             $tab_name=$tab_sec['name'];
                //tab-name cekmek ucun

            $temp_tab=$config->prepare("SELECT * FROM temp_product where product_id=$id");
            $temp_tab->execute();
           if($temp_tab->rowCount()==0){
               //insert
                $has=$s['quantity']*$s['product_price'];
                $eded=$s['quantity'];
/*                $ins_has=$config->prepare("INSERT INTO temp_table(table_id,)");*/
                $temp_ins=$this->db_request($config,"INSERT INTO temp_product(product_id,product_name,hasilat,quantity) VALUES ($id,'$tab_name',$has,$eded)",0);

           }else{
               //update
               $last_upd=$temp_tab->fetch();
               $last_has=$last_upd['hasilat']+($s['quantity']*$s['product_price']);
               $last_eded=$last_upd['quantity']+$eded;
               $last_name=$last_upd['product_name'];
               $last_upd=$this->db_request($config,"UPDATE temp_product set product_name='$last_name',hasilat=$last_has,quantity=$last_eded where product_id=$id",0);
           }
        }
    }
    $last_week_sec=self::db_request($config,"SELECT * FROM temp_product order by hasilat desc",2);
    $la=$last_week_sec->fetchAll(PDO::FETCH_ASSOC);
echo '<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ad</th>
      <th scope="col">Ədəd</th>
      <th scope="col">Hasilat</th>
    </tr>
  </thead>
  <tbody>';
$say=1;
$toplam_eded=0;
$toplam_hasil=0;
      foreach ($la as $ls){ ?>
    <tr>
      <th scope="row"><?php echo $say++;?></th>
      <td><?php echo $ls['product_name'];?></td>
      <td><?php echo $ls['quantity'];?> Ədəd</td>
      <td><?php echo $ls['hasilat'];?> Azn</td>
    </tr>
    <?php $toplam_eded+=$ls['quantity']; ?>
    <?php $toplam_hasil+=$ls['hasilat'];?>
  <?php }echo ' 

  </tbody>
</table>
    <div class="col-md-12">
                  <div class="card-body">
                <button style="width: 216px" class="btn">Toplam ədəd - '.$toplam_eded.' Ədəd</button>
                <button class="btn btn-primary">Toplam Hasilat - '.number_format($toplam_hasil,'2','.','.').'AZN</button>
        
                  </div>
                </div>
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
        <button type="button" onclick="printData();" class="btn btn-primary">Yaddaşda saxla</button>
      </div>
    </div>
  </div>
</div>
';
    }

                     echo '   
                   
                                  
                                      <form action="" method="post" 
                           <div class="col-md-3">                 
                   <input type="date" name="tarix1" class="form-control" >
                   <input type="date" name="tarix2" class="form-control" >
                   <input type="submit" class="btn btn-primary" name="report" value="Report" >
                   </div>
                   </form>  
                   
                   
                   
                   
                  </div>
                </div>';
    $tab_ins=$config->prepare("select * from temp_product");
    $tab_ins->execute();
    if ($tab_ins->rowCount()==0){
        foreach ($sec as $s){
            //tab-name cekmek ucun
            $id=$s['product_id'];
            $tab=$config->prepare("SELECT * FROM products where id='$id'");
            $tab->execute();
            $tab_sec=$tab->fetch();
            $tab_name=$tab_sec['name'];
                //tab-name cekmek ucun
            $temp_tab=$config->prepare("SELECT * FROM temp_product where product_id=$id");
            $temp_tab->execute();
           if($temp_tab->rowCount()==0){
               //insert
                $has=$s['quantity']*$s['product_price'];
                $eded=$s['quantity'];
/*                $ins_has=$config->prepare("INSERT INTO temp_table(table_id,)");*/
                $temp_ins=$this->db_request($config,"INSERT INTO temp_product(product_id,product_name,hasilat,quantity) VALUES ($id,'$tab_name',$has,$eded)",0);

           }else{
               //update
               $last_upd=$temp_tab->fetch();
               $last_has=$last_upd['hasilat']+($s['quantity']*$s['product_price']);
               $last_eded=$last_upd['quantity']+$eded;
               $last_name=$last_upd['product_name'];
               $last_upd=$this->db_request($config,"UPDATE temp_product set product_name='$last_name',hasilat=$last_has,quantity=$last_eded where product_id=$id",0);
           }
        }
    }
    $last_week_sec=self::db_request($config,"SELECT * FROM temp_product order by hasilat desc",2);
    $la=$last_week_sec->fetchAll(PDO::FETCH_ASSOC);
echo '<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ad</th>
      <th scope="col">Ədəd</th>
      <th scope="col">Hasilat</th>
    </tr>
  </thead>
  <tbody>';
$say=1;
$toplam_eded=0;
$toplam_hasil=0;
      foreach ($la as $ls){ ?>
    <tr>
      <th scope="row"><?php echo $say++;?></th>
      <td><?php echo $ls['product_name'];?></td>
      <td><?php echo $ls['quantity'];?> Ədəd</td>
      <td><?php echo $ls['hasilat'];?> Azn</td>
    </tr>
    <?php $toplam_eded+=$ls['quantity']; ?>
    <?php $toplam_hasil+=$ls['hasilat'];?>
  <?php }echo ' 
  </tbody>
</table>
    <div class="col-md-8">
                  <div class="card-body">
                <button class="btn">Toplam ədəd - '.$toplam_eded.' Ədəd</button>
                <button class="btn btn-primary">Toplam Hasilat - '.$toplam_hasil.' AZN</button>
                  </div>
                </div>';
}
//product_report
//qarson performance
    function qarson_performance($config)
    {
        @$date=$_GET['action'];
        switch ($date):
            case 'buay':
                //ayliq report datasi cekildi
                $this->db_request($config,'Truncate temp_qarson',2);//table bosaldir
                $data=$config->prepare("SELECT * FROM report where report_date >= DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH )");
                $data->execute();
                $sec=$data->fetchAll(PDO::FETCH_ASSOC);
                //ayliq report datasi cekildi
                break;
            default:
                //ayliq report datasi cekildi
                $this->db_request($config,'Truncate temp_qarson',2);//table bosaldir
                $data=$config->prepare("SELECT * FROM report where report_date >= DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH )");
                $data->execute();
                $sec=$data->fetchAll(PDO::FETCH_ASSOC);
                //ayliq report datasi cekildi
                break;

        endswitch;

        if (@$_POST['report']){
            $date1=$_POST['tarix1'];
            $date2=$_POST['tarix2'];
            $this->db_request($config,'Truncate temp_qarson',2);//table bosaldir
            $data=$config->prepare("SELECT * FROM report where DATE(report_date) BETWEEN '$date1' and '$date2'");
            $data->execute();
            if ($data->rowCount()==0){
                $this->warning('danger',"Heçbir məlumat tapılmadı",'control.php?page=qarson_performance');

                exit();
            }else{
                $sec=$data->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        echo '<div class="col-md-9">
                  <div class="card-body">
       
                   <a href="control.php?page=qarson_performance&action=buay"><button class="btn btn-warning">Bu ay</button></a>
             
                   ';
        if (@$date1!="" && @$date2!="")
        {
            echo '

<!-- Button trigger modal --><br>
<button id="btnExport" onClick="fnExcelReport()">Export to xls</button>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Report Çıxarış
</button>

<script>

function fnExcelReport() {
  var table = document.getElementById("theTable"); // id of table
  var tableHTML = table.outerHTML;
  var fileName = "download.xls";

  var msie = window.navigator.userAgent.indexOf("MSIE ");

  // If Internet Explorer
  if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
    dummyFrame.document.open("txt/html", "replace");
    dummyFrame.document.write(tableHTML);
    dummyFrame.document.close();
    dummyFrame.focus();
    return dummyFrame.document.execCommand("SaveAs", true, fileName);
  }
  //other browsers
  else {
    var a = document.createElement("a");
    tableHTML = tableHTML.replace(/  /g, "").replace(/ /g, "%20"); // replaces spaces
    a.href = "data:application/vnd.ms-excel," + tableHTML;
    a.setAttribute("download", fileName);
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  }
}

</script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 ';

            $date1=$_POST['tarix1'];
            $date2=$_POST['tarix2'];
            $data=$config->prepare("SELECT * FROM report where DATE(report_date) BETWEEN '$date1' and '$date2'");
            $data->execute();
            if ($data->rowCount()==0){
                $this->warning('danger',"Heçbir məlumat tapılmadı",'control.php?page=qarson_performance');

                exit();
            }else{
                $sec=$data->fetchAll(PDO::FETCH_ASSOC);
            }

            $tab_ins=$config->prepare("select * from temp_qarson");
            $tab_ins->execute();
            if ($tab_ins->rowCount()==0){
                foreach ($sec as $s){
                    //qar-name cekmek ucun
                    $id=$s['qarson_id'];
                    $tab=$config->prepare("SELECT * FROM qarson where id='$id'");
                    $tab->execute();
                    $tab_sec=$tab->fetch();
                    $tab_name=$tab_sec['ad'];
                    //qar-name cekmek ucun

                    $temp_tab=$config->prepare("SELECT * FROM temp_qarson where qarson_id=$id");
                    $temp_tab->execute();
                    if($temp_tab->rowCount()==0){
                        //insert

                        $eded=$s['quantity'];
                        /*                $ins_has=$config->prepare("INSERT INTO temp_table(table_id,)");*/
                        $temp_ins=$this->db_request($config,"INSERT INTO temp_qarson(qarson_id,qarson_name,quantity) VALUES ($id,'$tab_name',$eded)",0);

                    }else{
                        //update
                        $last_upd=$temp_tab->fetch();
                        $last_eded=$last_upd['quantity']+$eded;
                        $last_name=$last_upd['qarson_name'];
                        $last_upd=$this->db_request($config,"UPDATE temp_qarson set qarson_name='$last_name',quantity=$last_eded where qarson_id=$id",0);
                    }
                }
            }
            $last_week_sec=self::db_request($config,"SELECT * FROM temp_qarson order by quantity desc",2);
            $la=$last_week_sec->fetchAll(PDO::FETCH_ASSOC);
            echo '

<button id="btnExport" onClick="fnExcelReport()">Export to xls</button>
<br />
<br />




<table id="theTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ad</th>
      <th scope="col">Ədəd</th>

    </tr>
  </thead>
  <tbody>';
            $say=1;
            $toplam_eded=0;

            foreach ($la as $ls){ ?>
                <tr>
                    <th scope="row"><?php echo $say++;?></th>
                    <td><?php echo $ls['qarson_name'];?></td>
                    <td><?php echo $ls['quantity'];?> Ədəd</td>
                </tr>
                <?php $toplam_eded+=$ls['quantity']; ?>
            <?php }echo ' 

  </tbody>
</table>

    <div class="col-md-12">
                  <div class="card-body">
                <button style="width: 216px" class="btn">Toplam ədəd - '.$toplam_eded.' Ədəd</button>
        
                  </div>
                </div>
         
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
        <button type="button" onclick="printData();" class="btn btn-primary">Yaddaşda saxla</button>
      </div>
    </div>
  </div>
</div>
';
        }

        echo '           
                   <form action="" method="post" 
                           <div class="col-md-3">                 
                   <input type="date" name="tarix1" class="form-control" >
                   <input type="date" name="tarix2" class="form-control" >
                   <input type="submit" class="btn btn-primary" name="report" value="Report" >
                   </div>
                   </form>       
                   </div>
                  </div>
                </div>';
        $tab_ins=$config->prepare("select * from temp_qarson");
        $tab_ins->execute();
        if ($tab_ins->rowCount()==0){
            foreach ($sec as $s){
                //tab-name cekmek ucun
                $id=$s['qarson_id'];
                $tab=$config->prepare("SELECT * FROM qarson where id='$id'");
                $tab->execute();
                $tab_sec=$tab->fetch();
                $tab_name=$tab_sec['ad'];
                //tab-name cekmek ucun

                $temp_tab=$config->prepare("SELECT * FROM temp_qarson where qarson_id=$id");
                $temp_tab->execute();
                if($temp_tab->rowCount()==0){
                    //insert
                    $eded=$s['quantity'];
                    /*                $ins_has=$config->prepare("INSERT INTO temp_table(table_id,)");*/
                    $temp_ins=$this->db_request($config,"INSERT INTO temp_qarson(qarson_id,qarson_name,quantity) VALUES ($id,'$tab_name',$eded)",0);

                }else{
                    //update
                    $last_upd=$temp_tab->fetch();
                    $last_eded=$last_upd['quantity']+$eded;
                    $last_name=$last_upd['qarson_name'];
                    $last_upd=$this->db_request($config,"UPDATE temp_qarson set qarson_name='$last_name',quantity=$last_eded where qarson_id=$id",0);
                }
            }
        }
        $last_week_sec=self::db_request($config,"SELECT * FROM temp_qarson order by quantity desc",2);
        $la=$last_week_sec->fetchAll(PDO::FETCH_ASSOC);
        echo '<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ad</th>
      <th scope="col">Ədəd</th>
    </tr>
  </thead>
  <tbody>';
        $say=1;
        $toplam_eded=0;
        $toplam_hasil=0;
        foreach ($la as $ls){ ?>
            <tr>
                <th scope="row"><?php echo $say++;?></th>
                <td><?php echo $ls['qarson_name'];?></td>
                <td><?php echo $ls['quantity'];?> Ədəd</td>
            </tr>
            <?php $toplam_eded+=$ls['quantity']; ?>
        <?php }echo ' 

  </tbody>
</table>
    <div class="col-md-8">
                  <div class="card-body">
                <button class="btn">Toplam ədəd - '.$toplam_eded.' Ədəd</button>
        
                  </div>
                </div>';
    }
//qarson performance



    function user_profile($config){

        $user=$this->unlock($_COOKIE['user_id']);


        $user_prof=$this->db_request($config,"SELECT * FROM admin where id='$user' and status=1",1);
        if ($_POST){
            $login=$_POST['login'];
            $old_pass=md5(sha1(md5($_POST['old_pass'])));
            $new_pass1=$_POST['new_pass1'];
            $new_pass2=$_POST['new_pass2'];
            $new_pass_hash=md5(sha1(md5($new_pass1)));
            $user_cont=$this->db_request($config,"SELECT * FROM admin where login='$login' and password='$old_pass'",2)->rowCount();
              if ($user_cont!=0 && $user_cont!=""){
                  if ($new_pass1==$new_pass2 && $new_pass1!="" && $new_pass2!=""){
                      $this->db_request($config,"UPDATE admin set login='$login',password='$new_pass_hash',active=1",0);
                      $this->warning('success',"Şifrə dəyişdirildi",'control.php?page=user_profile');
                  }else{
                      $this->warning('danger',"Yeni Şifrələr uyğunlaşmır",'control.php?page=user_profile');
                  }
                   }else{
                      $this->warning('danger',"Köhnə  Şifrə yanlışdır",'control.php?page=user_profile');
              }
                 }
        echo '<div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">Edit Profile -
                    <small class="category">Complete your profile</small>
                  </h4>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="row">
             
                      <div class="col-md-3">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Username </label>
                          <input type="text" name="login" value="'.$user_prof['login'].'" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Old Password</label>
                          <input type="text" name="old_pass" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">New password</label>
                          <input type="text" name="new_pass1" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Confirm Password</label>
                          <input type="text" name="new_pass2" class="form-control">
                        </div>
                      </div>
                    </div>
       <!--             <div class="row">
                      <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Adress</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                    </div>-->
<!--                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">City</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Country</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Postal Code</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                    </div>-->
<!--                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>About Me</label>
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> Lamborghini Mer</label>
                            <textarea class="form-control" rows="5"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>-->
                    <button type="submit" class="btn btn-rose pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="assets/back/assets/img/faces/marc.jpg">
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">CEO / Co-Founder</h6>
                  <h4 class="card-title">Alec Thompson</h4>
                  <p class="card-description">
                    Dont be scared of the truth because we need to restart the human 
                  </p>
                  <a href="#pablo" class="btn btn-rose btn-round">Follow</a>
                </div>
              </div>
            </div>
          </div>';
}
// sifreleme funskiyasi
    function lock($data){  //
          return base64_encode(gzdeflate(gzcompress(serialize($data))));    
     }
     //sifreni cozme funksiyasi
    function unlock($data){
      return unserialize(gzuncompress(gzinflate(base64_decode($data))));
     }
//useri  cekmek
    function get_user($db){
      $cookie_user_id=$_COOKIE['user_id'];
      $user_id=self::unlock($cookie_user_id);
      $get_user=self::db_request($db,"select * from admin where id=$user_id",1);
      return $get_user['login'];
     }
//user ve admin control funksiyasi
    function user_control($login,$password,$db){
        $pass=md5(sha1(md5($password)));
      $result=$db->prepare("select * from admin where login='$login' and password='$pass'");
      $result->execute();
      if($result->rowCount()==0):
                   echo '<div class="alert alert-danger text-center">Login or password error!!!</div>';
                    header('refresh:1,url=index.php');
                  else:
                    $user_update=$db->prepare("update admin set active=1 where login='$login' and password='$pass'");
                    $user_update->execute();
                     echo '<div class="alert alert-success text-center">Sign in...</div>';
                        header('refresh:1,url=control.php');
                       $var=$result->fetch();
                        $id=self::lock($var['id']);
                        setcookie('user_id',$id,time()+ 60*60*24 );
                               endif;
    }
    //user_exit istifadeci cixisi funksiyasi3
    function user_exit($db){
        $cookie_user_id=$_COOKIE['user_id'];
        $user_id=self::unlock($cookie_user_id);
        $get_user=self::db_request($db,"update admin set active=0 where id='$user_id'",0);
        setcookie('user_id',$cookie_user_id,time()-5);
        $this->warning("danger","Çıxış edilir...",'index.php');
    }
    function cookie_control($page){
        if(isset($_COOKIE['user_id'])):
          if($page=='index'):header('Location:control.php');endif;
        else:
          if($page=="control"):header('Location:index.php');endif;
        endif;
    }
     }
?>