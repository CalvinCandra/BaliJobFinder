<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CDN Fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  

    <title>CV</title>

    </head>

    <style>
        
        *{
            margin: 0;
            padding: 0;
            box-sizing: none;
            font-family: 'Times New Roman', Times, serif;
        }

    </style>

    <body style="background-color: #0d6efd;">
    <div class="container-fuild">

        <div class="position-relative" style="float:left; margin-top:15%; width:55%;">
            <div class="position-relative" style="left:25%; top:5%;">     
                <div class="w-50 h-50">
                    <img src="<?= base_url("assets/img/profile/perusahaan/bintang_benggong.jpg")?>" alt="" class="w-100">
                </div>

            </div>

            <div class="position-relative" style="top:-21%;">
                <h1 class="text-center fs-1 fw-bold" style="color:#ffffff;"><?= $nama_pelamar?></h1>
            </div>

            <div class="position-relative" style="top:-21%;"> 
                <div class="mb-2 px-2 mx-auto" style="width:90%;">
                    <p class="text-justify fs-5" style="color:#ffffff;"><?= $deskripsi_pelamar?></p>
                </div>
            </div>

            <div class="position-relative py-3" style="top:-21%;">
                <div class="w-50" style="border-bottom-right-radius: 50px; border-top-right-radius: 50px; background-color: #ffffff;">
                    <h2 class="text-center fw-bold text-uppercase" style="color: #0d6efd; margin-left:20px; font-size:30px; font-weight:600;">Kontak</h2>
                </div>
                <div class="p-3 position-relative" style="width:90%;">

                    <div class="w-50">
                        <div class="position-absolute" style="left:1%; width:30px;">
                            <img src="<?= base_url("assets/img/CV/location.png")?>" alt="" class="w-100">
                        </div>
                        <div class="position-absolute" style="right:0; top:3%; width:80%;">
                            <p class="fw-bold text-justify position-relative" style="right:0; color:#ffffff;"><?= $alamat?></p>
                        </div>   
                    </div>

                    <div class="w-50">
                        <div class="position-absolute" style="left:2%; width:25px; top:20%;">
                            <img src="<?= base_url("assets/img/CV/wa.png")?>" alt="" class="w-100">
                        </div>
                        <div class="position-absolute" style="right:0; width:80%; top:21%;">
                            <p class="fw-bold"  style="color:#ffffff;"><?= $no_hp?></p>                        
                        </div>
                    </div>

                    <div class="w-50">
                        <div class="position-absolute" style="left:2%; width:28px; top:34%;">
                            <img src="<?= base_url("assets/img/CV/mail.png")?>" alt="" class="w-100">
                        </div>
                        <div class="position-absolute" style="right:0; width:80%; top:35%;">
                            <p class="fw-bold"  style="color:#ffffff;"><?= $email_pelamar?></p>  
                        </div>
                    </div>

                </div>
            </div>
        </div>

       

        <div class="position-relative" style="float:right; background-color: #ffffff; height:100%; width:45%; border:none; outline:none;">
            <div class="position-relative">
                <div class="mt-5">
                    <div class="w-75" style="border-bottom-right-radius: 50px; border-top-right-radius: 50px; background-color: #0d6efd;">
                        <h2 class="text-center fw-bold text-uppercase" style="color: #ffffff; margin-left:20px; font-size:30px; font-weight:600;">Pendidikan</h2>
                    </div>
        
                    <div class="position-relative" style="width:100%;">
                        <?php
                            foreach($pendidikan as $Datapendidikan):
                        ?>
                            <ul style="margin-top:-15px;">
                                <li>
                                    <div class="ms-3 me-5 p-2">
                                        <p class="fw-bold text-black" style="font-size:15px;"><?= $Datapendidikan['bulan_awal']?> <?= $Datapendidikan['tahun_mulai']?> - <?= $Datapendidikan['bulan_akhir']?> <?= $Datapendidikan['tahun_akhir']?></p>
                
                                        <h2 class="fw-bold" style="margin-top:-10px; font-size:20px;"><?= $Datapendidikan['nama_sekolah']?> (<?= $Datapendidikan['jenjang_pendidikan']?>)</h2>
                
                                        <h5 class="mt-2 italic" style="font-size:18px;"><?= $Datapendidikan['bidang_studi']?> </h5>
                                            
                                            
                                        <h5 class="mt-2" style="font-size:18px;">Nilai Akhir <?= $Datapendidikan['nilai_akhir']?></h5>
                                    </div>
                                </li>
                            </ul>

                        <?php
                            endforeach;
                        ?>
    
                    </div>
                </div>
        
                <div class="">
                    <div class="w-75" style="border-bottom-right-radius: 50px; border-top-right-radius: 50px; background-color: #0d6efd;">
                        <h2 class="text-center text-uppercase" style="color: #ffffff; margin-left:20px; font-size:30px; font-weight:600;">Pengalaman</h2>
                    </div>
        
                    <div class="position-relative" style="width:100%;">
                        <?php
                            foreach($pengalaman as $Datapengalaman):
                        ?>  
                            <div class="">
                                <ul style="margin-top:-15px;">
                                    <li>
                                        <div class="ms-2 me-5 p-2">
                                            <p class="fw-bold text-black" style="font-size:15px;"><?= $Datapengalaman['tahun_mulai_kerja']?> - <?= $Datapengalaman['tahun_terakhir_kerja']?></p>
                                           
                                            <h2 class="fw-bold" style="margin-top:-10px; font-size:20px;"><?= $Datapengalaman['jabatan']?></h2>
    
                                            <h4 class="fw-bold" style="margin-top:0;"><?= $Datapengalaman['nama_perusahaan']?> (<?= $Datapengalaman['lokasi_perusahaan']?>)</h4>
                    
                    
                                            <h5 class="mt-2 italic text-capitalize" style="font-size:18px;"><?= $Datapengalaman['status_pekerja']?> <span class="fst-italic fw-bold">(<?= $Datapengalaman['sistem_kerja']?>)</span></h5>
                                        </div>
                                    </li>
                                </ul>
                                    
                            </div>
        
                        <?php
                            endforeach;
                        ?>      
                    </div>
                </div>
        
                <div class="">
                    <div class="w-75" style="border-bottom-right-radius: 50px; border-top-right-radius: 50px; background-color: #0d6efd;">
                        <h2 class="text-center text-uppercase" style="color: #ffffff; margin-left:20px; font-size:30px; font-weight:600;">Skill</h2>
                    </div>
        
                    <div class="mx-2">
    
                        <div class="w-100" style="width:100%;">
                            <?php
                                foreach ($skill as $dataSkill) {
                                    echo "
                                        <div class='my-2'>
                                            <h5 class='fs-3 fw-bold'>{$dataSkill['nama_skill']}</h5>
                                            <div class='progress w-100'>
                                                <div class='progress-bar fw-bold text-center' role='progressbar' style='width: {$dataSkill['value']}%;' aria-valuenow='{$dataSkill['value']}' aria-valuemin='0' aria-valuemax='100'>{$dataSkill['value']}%</div>
                                            </div>
                                        </div>
                                    ";
                                }
                            ?>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>









    </div>
    
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>