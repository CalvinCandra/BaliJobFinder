<!-- jQuery -->
<script src="<?= base_url()?>assets/temp/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url()?>assets/temp/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url()?>assets/temp/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url()?>assets/temp/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url()?>assets/temp/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url()?>assets/temp/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url()?>assets/temp/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url()?>assets/temp/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url()?>assets/temp/plugins/moment/moment.min.js"></script>
<script src="<?= base_url()?>assets/temp/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url()?>assets/temp/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url()?>assets/temp/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url()?>assets/temp/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/temp/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url()?>assets/temp/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url()?>assets/temp/dist/js/demo.js"></script>

<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    <?php if($this->session->flashdata('swal_icon')):?>

        Swal.fire({
            title: "<?= $this->session->flashdata('swal_title')?>",
            text: "<?= $this->session->flashdata('swal_text')?>",
            icon: "<?= $this->session->flashdata('swal_icon')?>",
            confirmButtonColor: "#0d6efd",
        });

    <?php endif;?> 

</script>
</body>
</html>
