<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Bali JobFInder</title>
</head>
<body>
    <?php $this->session->flashdata('pesan'); ?>
    
    <a href="<?php echo base_url('Auth/register_pilihan')?>">Register</a>
    <a href="<?php echo base_url('Auth')?>">Login</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
</body>
</html>