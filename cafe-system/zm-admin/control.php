<?php 
include('functions/functions.php');
$admin=new admin;
$admin->cookie_control('control');
?>
<?php require ('layouts/style.php');?>
    <script>
        $(document).ready(function (){
            $('a[data-confirm]').click(function (e){
                var href=$(this).attr('href');
                if (!$('#dataConfirmModal').length){

                    $('.x').append('<div class="modal fade" style="bottom: 29%!important;left: 13%!important;" id="dataConfirmModal" ' +
                        'tabindex="" role="dialog" ' +
                        'aria-labelledby="exampleModalCenterTitle" ' +
                        'aria-hidden="true">' +
                        '<div class="modal-dialog modal-dialog-centered" role="document">' +
                        '<div class="modal-content"><div class="modal-header">' +
                        '<h5 class="modal-title" id="exampleModalLongTitle">Silinsin?</h5>' +
                        '</div><div class="modal-body"></div>  ' +
                        ' <div class="modal-footer">' +
                        '<button class="btn" data-dismiss="modal" aria-hidden="true">Geri</button>' +
                        '<a class="btn btn-primary" id="dataConfirmOK">Bəli</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>');
                    $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
                    $('#dataConfirmOK').attr('href',href);
                    $('#dataConfirmModal').modal({show:true});
                    return false;
                }
            });
        });
    </script>


<script>
    $(document).ready(function (){
        $(".table_exc").click(function(){
            $(".table").table({
                exclude: ".noExl",
                name: "Worksheet Name",
                filename: "SomeFile",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });

    });

</script>



    <body class="x">
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
    <script>
        function printData()
        {
            var divToPrint=document.getElementById("exampleModal");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo">
        <a href="http://www.creative-tim.com/" class="simple-text logo-mini">
        </a>
        <a href="http://www.creative-tim.com/" class="simple-text logo-normal">
          Ferrum Capital
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span style="font-size: 18px">
                <?php  echo $admin->get_user($config);?>
              </span>
            </a>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item active ">
            <a class="nav-link" href="control.php?page=dashboard">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="control.php?page=tables">
                    <i class="material-icons">message</i>
                    <p> Masalar </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="control.php?page=products">
                    <i class="material-icons">message</i>
                    <p> Məhsullar </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="control.php?page=categories">
                    <i class="material-icons">message</i>
                    <p> Kateqoriyalar </p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#pagesqarson">
                    <i class="material-icons">image</i>
                    <p>Qarsonlar
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesqarson">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="control.php?page=qarsons">
                                <span class="sidebar-mini"> M</span>
                                <span class="sidebar-normal"> Qarsonlar </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="control.php?page=qarson_performance">
                                <span class="sidebar-mini"> M </span>
                                <span class="sidebar-normal">Qarson performansı </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>



            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
                    <i class="material-icons">image</i>
                    <p>Reportlar
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="control.php?page=reports">
                                <span class="sidebar-mini"> M</span>
                                <span class="sidebar-normal"> Masalar </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="control.php?page=product_reports">
                                <span class="sidebar-mini"> M </span>
                                <span class="sidebar-normal">Məhsullar </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com/" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="control.php?page=user_profile">Profil</a>
             <?php
             if ($admin->db_request($config,"SELECT * FROM admin where active=1 and status=1",2)->rowCount()!=0){?>
                 <a class="dropdown-item" href="control.php?page=admins">Adminlər</a>

     <?php } ?>



<div class="dropdown-divider"></div>
                  <a class="dropdown-item" data-confirm="Çıxmaq istədiyinizə əminmisiniz?"href="control.php?page=user_exit">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="content">
                   <div class="container-fluid">
                    <?php
                    @$page=$_GET['page'];
                    switch ($page):
                        case "tables":
                    $admin->tables($config);
                            break;

                            case 'products':
                                $admin->products($config);
                                break;
                        case "product_add" :
                            $admin->product_add($config);
                            break;
                        case 'product_edit':
                            $admin->product_edit($config);
                            break;
                            case 'product_delete';
                            $admin->product_delete($config);
                            break;
                        case 'categories':
                            $admin->category($config);
                            break;
                        case 'category_add' :
                            $admin->category_add($config);
                            break;
                            case 'category_edit';
                            $admin->category_edit($config);
                            break;
                        case 'category_delete':
                            $admin->category_delete($config);
                            break;
                        case "qarsons":
                            $admin->qarsons($config);
                            break;
                        case "qarson_add":
                            $admin->qarson_add($config);
                            break;
                        case "qarson_edit":
                            $admin->qarson_edit($config);

                            break;
                        case "qarson_delete":
                            $admin->qarson_delete($config);
                            break;
                            case "admins":
                            $admin->admins($config);
                            break;
                            case "admin_add";
                            $admin->admin_add($config);
                            break;
                        case "admin_edit";
                            $admin->admin_edit($config);
                            break;
                        case "admin_delete":
                            $admin->admin_delete($config);
                            break;
                        case "qarson_performance":
                            $admin->qarson_performance($config);
                            break;
                        case 'reports':
                            $admin->reports($config);
                            break;
                        case 'product_reports':
                            $admin->product_reports($config);
                            break;
                        case 'user_profile':
                            $admin->user_profile($config);
                            break;

                        case "user_exit":
                            $admin->user_exit($config);
                            break;
                        case 'table_edit':
                            $admin->table_edit($config);
                            break;
                        case 'table_add':
                            $admin->table_add($config);
                            break;
                        case 'table_delete':
                            $admin->table_delete($config);
                            break;
                        default:
                           $admin->statistics($config);
                    endswitch;
                    ?>
                      </div>
                    </div>
                  </div>
                 <?php  require "layouts/footer.php"; ?>