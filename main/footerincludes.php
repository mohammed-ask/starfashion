<!-- Search Begin -->
<div class="search-model">
  <div class="h-100 d-flex align-items-center justify-content-center">
    <div class="search-close-switch">+</div>
    <form class="search-model-form">
      <input type="text" id="search-input" placeholder="Search here.....">
    </form>
  </div>
</div>
<!-- Search End -->

<!-- Shoubham Templte -->
<script src="main/dist/userjs/jquery-3.3.1.min.js"></script>
<script src="main/dist/userjs/bootstrap.min.js"></script>
<script src="main/dist/userjs/jquery.nice-select.min.js"></script>
<script src="main/dist/userjs/jquery.nicescroll.min.js"></script>
<script src="main/dist/userjs/jquery.magnific-popup.min.js"></script>
<script src="main/dist/userjs/jquery.countdown.min.js"></script>
<script src="main/dist/userjs/jquery.slicknav.js"></script>
<script src="main/dist/userjs/mixitup.min.js"></script>
<script src="main/dist/userjs/owl.carousel.min.js"></script>
<script src="main/dist/userjs/main.js?ver=<?php echo date('His'); ?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="main/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- <script src="main/dist/userjs/selectr.min.js"></script> -->
<!-- <script src="main/dist/plugins/apex-chart/apexcharts.min.js"></script>
<script src="main/dist/pages/market.init.js"></script> -->
<!-- App js -->
<!-- <script src="main/dist/userjs/app.js"></script> -->
<!-- <script>
  new Selectr('#Watchlist', {
    searchable: false,
  });

  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
  });
</script> -->

<!-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> -->
<!-- <script src="main/dist/js/init-alpine.js"></script> -->

<style>
  .stickyframe {
    position: sticky;
    top: 0;
  }
</style>
<!-- jQuery -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<!-- <script src="main/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- DataTables  & Plugins -->
<script src="main/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="main/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="main/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="main/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Select2 -->
<!-- <script src="main/plugins/select2/js/select2.full.min.js"></script> -->

<!-- JQVMap -->
<script src="main/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="main/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<!-- daterangepicker -->
<script src="main/plugins/moment/moment.min.js"></script>
<script src="main/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="main/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<!-- <script src="main/plugins/summernote/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<script src="main/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="main/dist/js/jquery-ui-timepicker-addon.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="main/dist/js/adminlte.js"></script> -->
<script src="main/dist/js/customfunction.js?ver=<?php echo time(); ?>"></script>
<script src="main/dist/js/del.js?ver=<?php echo time(); ?>"></script>
<script src="main/dist/js/functions.js?ver=<?php echo date('His'); ?>"></script>
<script src="main/dist/js/view1.js?ver=<?php echo date('His'); ?>"></script>
<script src="main/dist/js/search.js"></script>
<script src="main/dist/js/jquery.bvalidator-yc.js"></script>
<!--<script src="main/dist/js/bs3form.min.js"></script>-->
<script src="main/dist/js/b3form.js"></script>
<script>
  const addmail = () => {
    mail = $("#customermail").val()
    $.post({
      url: "main/insertmail.php",
      data: {
        mail: mail,
      },
      success: function(response) {
        console.log(response)
        if (response === 'Success') {
          alertify.success('You are subscribed to out newsletter successfully');
        } else if (response === 'Failed') {
          alertify.error('Please enter proper mail ');
        } else if (response === 'Empty') {
          alertify.error('Oops! looks like you forgot to enter the mail ');
        } else if (response === 'Found') {
          alertify.error('Don\'t worry! you are already subscribed. ');
        }
      },
    });
  }
</script>
<?php
if (isset($extrajs)) {
  echo $extrajs;
} ?>
<script>
  <?php
  if (isset($onpagejs)) {
    echo $onpagejs;
  } ?>
</script>