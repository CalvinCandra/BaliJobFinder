<?php $this->load->view('perusahaan/template/meta');?>
<div class="wrapper">
    <?php $this->load->view('perusahaan/template/header');?>
    <div style="height: 55px;"></div>
    <?php $this->load->view('perusahaan/template/sidebar');?>
    <?php echo $contents; ?>
    <?php $this->load->view('perusahaan/template/footer');?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('perusahaan/template/script');?>