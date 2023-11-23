<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
     <!-- link css-->
     <link rel="stylesheet" href="<?php echo base_url('assets/css/auth/regipil.css')?>">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="kiri">
            <p>Register Sebagai Pelamar</p>
            <h2>Temukan pekerjaaan impianmu</h2>
            
            <div class="btn-arah">
                <a href="<?php echo base_url("Auth/nampil_registerPelamar")?>">REGISTER NOW</a>
            </div>

        </div>

        <div class="kanan">
            <p>Register Sebagai Perusahaan</p>
            <h2>Temukan Kandidat profesional</h2>
            <div class="btn-arah">
                <a href="<?php echo base_url("Auth/nampil_registerPerusahaan")?>">REGISTER NOW</a>
            </div>

        </div>
    </div>
    
</body>
</html>