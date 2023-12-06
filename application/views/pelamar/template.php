<?php $this->load->view('perusahaan/template/meta');?>
<div class="wrapper">
    <?php $this->load->view('perusahaan/template/header');?>
    <?php $this->load->view('perusahaan/template/sidebar');?>
    <?php echo $contents; ?>
    <?php $this->load->view('perusahaan/template/footer');?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('perusahaan/template/script');?>