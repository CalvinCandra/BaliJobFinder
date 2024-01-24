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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="<?php echo base_url("assets/js/Message.js")?>"></script> -->


<!-- Sweet Alert-->
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

<!-- untuk tambabh pengalaman -->
<script>
  const select = document.getElementById("selectStatus");
  const inputan1 = document.getElementById("inputan1");
  const inputan2 = document.getElementById("inputan2");

select.addEventListener("change", () => {

  if (select.value == "0") {
    inputan1.style.display = "block";
    inputan2.style.display = "block";
  } else {
    inputan1.style.display = "none";
    inputan2.style.display = "none";
  }
});
</script>

<!-- untuk update pengalaman -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    <?php foreach ($pengalaman as $key): ?>
        const selectt<?= $key['id_pengalaman'] ?> = document.getElementById("statusUpdate<?= $key['id_pengalaman'] ?>");
        const input1<?= $key['id_pengalaman'] ?> = document.getElementById("InputUpdate1<?= $key['id_pengalaman'] ?>");
        const input2<?= $key['id_pengalaman'] ?> = document.getElementById("InputUpdate2<?= $key['id_pengalaman'] ?>");

        const updateInputVisibility<?= $key['id_pengalaman'] ?> = () => {
            if (selectt<?= $key['id_pengalaman'] ?>.value == "0" || selectt<?= $key['id_pengalaman'] ?>.value == "Sudah Selesai Bekerja") {
                input1<?= $key['id_pengalaman'] ?>.style.display = "block";
                input2<?= $key['id_pengalaman'] ?>.style.display = "block";
            } else {
                input1<?= $key['id_pengalaman'] ?>.style.display = "none";
                input2<?= $key['id_pengalaman'] ?>.style.display = "none";
            }
        };

        // Initial check
        updateInputVisibility<?= $key['id_pengalaman'] ?>();

        selectt<?= $key['id_pengalaman'] ?>.addEventListener("change", updateInputVisibility<?= $key['id_pengalaman'] ?>);
    <?php endforeach; ?>
});
</script>


</body>
</html>
