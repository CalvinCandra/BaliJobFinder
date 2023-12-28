<?php $this->load->view('admin/template/meta');?>
<div class="wrapper">
    <?php $this->load->view('admin/template/header');?>
    <?php $this->load->view('admin/template/sidebar');?>
    <?php echo $contents; ?>
    <?php $this->load->view('admin/template/footer');?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('admin/template/script');?>