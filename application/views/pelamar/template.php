<?php $this->load->view('pelamar/template/meta');?>
<div class="wrapper">
    <?php $this->load->view('pelamar/template/header');?>
    <?php $this->load->view('pelamar/template/sidebar');?>
    <?php echo $contents; ?>
    <?php $this->load->view('pelamar/template/footer');?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('pelamar/template/script');?>