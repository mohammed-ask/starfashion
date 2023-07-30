 <title><?php
        if (isset($pagetitle) && (!empty($pagetitle))) {
          echo $pagetitle;
        } else {
          echo $defaultpagetitle;
        }
        ?></title>
 <!-- Shubham Template -->
 <meta charset="UTF-8">
 <meta name="description" content="Male_Fashion Template">
 <meta name="keywords" content="Male_Fashion, unica, creative, html">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Star Fashion</title>

 <!-- App favicon -->
 <link rel="shortcut icon" href="main/images/logo/favicon.svg">



 <link href="main/dist/usercss/selectr.min.css" rel="stylesheet" type="text/css">

 <!-- App css -->
 <!-- Google Font -->
 <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

 <!-- Css Styles -->
 <link rel="stylesheet" href="main/dist/usercss/font-awesome.min.css" type="text/css">
 <link rel="stylesheet" href="main/dist/usercss/elegant-icons.css" type="text/css">
 <link rel="stylesheet" href="main/dist/usercss/magnific-popup.css" type="text/css">
 <link rel="stylesheet" href="main/dist/usercss/nice-select.css" type="text/css">
 <link rel="stylesheet" href="main/dist/usercss/owl.carousel.min.css" type="text/css">
 <link rel="stylesheet" href="main/dist/usercss/slicknav.min.css" type="text/css">
 <link rel="stylesheet" href="main/dist/usercss/style.css?ver=<?php echo time(); ?>" type="text/css">

 <link href="main/dist/usercss/bootstrap.min.css" rel="stylesheet" type="text/css">


 <!-- <link href="main/dist/usercss/icons.min.css" rel="stylesheet" type="text/css"> -->
 <!-- <link href="main/dist/usercss/app.min.css" rel="stylesheet" type="text/css"> -->

 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 <!-- iCheck -->
 <link rel="stylesheet" href="main/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
 <!-- overlayScrollbars -->
 <link rel="stylesheet" href="main/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
 <!-- Theme style -->
 <link rel="stylesheet" href="main/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="main/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
 <link rel="stylesheet" href="main/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 <link rel="stylesheet" href="main/plugins/jquery-ui/jquery-ui.css">
 <!-- Select2 -->
 <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
 <!-- Default theme -->
 <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
 <link rel="stylesheet" href="main/plugins/select2/css/select2.min.css?ver=<?php echo time(); ?>">
 <link rel="stylesheet" href="main/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
 <link rel="stylesheet" href="main/dist/css/bvalidator.css">
 <link rel="stylesheet" href="main/dist/css/jquery-ui-timepicker-addon.css">
 <!-- summernote -->

 <!-- summernote -->
 <link rel="stylesheet" href="main/plugins/summernote/summernote-bs4.min.css">


 <?php
  if (isset($extracss)) {
    echo $extracss;
  } ?>