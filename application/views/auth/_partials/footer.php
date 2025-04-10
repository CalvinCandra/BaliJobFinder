    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  
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