<!doctype html>
<html lang="en" style="
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');
    margin: 0;
    padding: 0;
">
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

    <body style="background-color:#E6E6E6; font-family: 'Times New Roman', Times, serif;">


        <div class="position-relative" style="float:left; width:50%;">

            <div class="position-relative" style="left:25%; top:9%;">     
                <div class="" style="height:200px; width:200px;">
                    <img src="<?= base_url("assets/img/profile/pelamar/".$foto)?>" alt="" class="w-100 rounded-circle">
                </div>
            </div>
            
            <div class="position-relative" style="top:11.5%;">
                <h2 class="text-center" style="font-size:25px; font-weight:700;"><?= $nama_pelamar?></h2>
            </div>

            <div class="position-relative" style="left:10%; top:12%; width:330px;">
                <h2 style="font-size:16px; font-weight:400; color:#333; text-align:justify;"><?= $deskripsi_pelamar?></h2>
            </div>

            <div class="position-relative" style="left:10%; top:13%; margin-bottom:5%;">
                <h2 class="" style="font-size:25px;  font-weight:700;">Contac Person</h2>
            </div>

            <div class="position-relative" style="left:15%; top:12.5%; color:#333;">
                <img src="<?= base_url('assets/img/CV/location.webp')?>" class="" style="width:20px;">
                <h2 class="position-relative" style="left:8%; top:-3.4%; font-size:16px; font-weight:400; width:70%;"><?= $alamat?></h2>
            </div>

            <div class="position-relative" style="left:15%; top:11%;color:#333;">
                <img src="<?= base_url('assets/img/CV/email.webp')?>" class="" style="width:20px;">
                <h2 class="position-relative" style="left:8%; top:-3.6%; font-size:16px; font-weight:400; width:70%;"><?= $email_pelamar?></h2>
            </div>

            <div class="position-relative" style="left:15%; top:10%;color:#333;">
                <img src="<?= base_url('assets/img/CV/wa.webp')?>" class="" style="width:20px;">
                <h2 class="position-relative" style="left:8%; top:-3.5%; font-size:16px; font-weight:400; width:70%;"><?= $no_hp?></h2>
            </div>
        </div>
        
        <div class="position-relative" style="float:right; background-color: #ffffff; height:100%; width:50%;">

            <!-- pendidikan -->
            <div class="position-relative" style="top:9%">
            
                <div style="border-bottom-right-radius: 50px; border-top-right-radius: 50px; background-color: #0d6efd; width:50%;">
                    <h2 class="" style="color: #ffffff; font-size:25px; padding: 5px 0 5px 20px; font-weight:700;">Pendidikan</h2>
                </div>

                <div style="width:100%;">
                    <?php
                        foreach($pendidikan as $Datapendidikan):
                    ?>
                        <ul>
                            <li style="font-size:25px;">
                                <div class="p-0 m-0">
                                    <h2 style="font-size:16px; font-weight:400; margin-top:-7px; color:#5b5b5b;"><?= $Datapendidikan['bulan_mulai']?> <?= $Datapendidikan['tahun_mulai']?> - <?= $Datapendidikan['bulan_akhir']?> <?= $Datapendidikan['tahun_akhir']?></h2>
            
                                    <h2 style="font-size:16px; font-weight:700;  margin-top:-9px;"><?= $Datapendidikan['nama_sekolah']?> (<?= $Datapendidikan['jenjang_pendidikan']?>)</h2>
            
                                    <h2 style="font-size:16px; font-weight:400;  margin-top:-9px;"><?= $Datapendidikan['bidang_studi']?> </h2>
                                        
                                    <h2 style="font-size:16px; font-weight:400;  margin-top:-9px;">Nilai Akhir <?= $Datapendidikan['nilai_akhir']?></h2>
                                </div>
                            </li>
                        </ul>

                    <?php
                        endforeach;
                    ?>
                </div>


            </div>

            <!-- pengalaman -->
            <div class="position-relative" style="top:9%">
                <div style="border-bottom-right-radius: 50px; border-top-right-radius: 50px; background-color: #0d6efd; width:50%;">
                    <h2 class="" style="color: #ffffff; font-size:25px; padding:5px 0 5px 20px; font-weight:700;">Pengalaman</h2>
                </div>
    
                <div style="width:100%;">
                    <?php
                        foreach($pengalaman as $Datapengalaman):
                    ?>  
                        <div class="">
                            <ul style="font-size:25px;">
                                <li>
                                    <div class="">
                                    <?php if($Datapengalaman['status_kerja']  == 0 ):?>
                                        <h2 style="font-size:16px; font-weight:400; margin-top:-7px; color:#5b5b5b;"><?= $Datapengalaman['bulan_mulai_kerja']?> <?= $Datapengalaman['tahun_mulai_kerja']?> - <?= $Datapengalaman['bulan_akhir_kerja']?> <?= $Datapengalaman['tahun_akhir_kerja']?></h2>
                                    <?php else:?>
                                        <h2 style="font-size:16px; font-weight:400; margin-top:-7px; color:#5b5b5b;"><?= $Datapengalaman['bulan_mulai_kerja']?> <?= $Datapengalaman['tahun_mulai_kerja']?> - Sekarang</h2>
                                    <?php endif;?>
                                        <h2 style="font-size:16px; font-weight:700; margin-top:-9px;"><?= $Datapengalaman['jabatan']?></h2>

                                        <h2 style="font-size:16px; font-weight:400; margin-top:-9px;"><?= $Datapengalaman['nama_perusahaan']?> (<?= $Datapengalaman['lokasi_perusahaan']?>)</h2>
                
                                        <h2 style="font-size:16px; font-weight:400; margin-top:-9px;"><?= $Datapengalaman['status_pekerja']?> <span>(<?= $Datapengalaman['sistem_kerja']?>)</span></h2>
                                    </div>
                                </li>
                            </ul>
                                
                        </div>
    
                    <?php
                        endforeach;
                    ?>      
                </div>
            </div>

            <!-- skill -->
            <div class="position-relative" style="top:9%">
                <div style="border-bottom-right-radius: 50px; border-top-right-radius: 50px; background-color: #0d6efd; width:50%;">
                    <h2 class="" style="color: #ffffff; font-size:25px; padding: 5px 0 5px 20px; font-weight:700;">Skill</h2>
                </div>
    
                <div class="mx-2">
                    <div style="width:90%; ">
                        <?php
                            foreach ($skill as $dataSkill) {
                                echo "
                                <div class='my-2'>
                                    <h2 style='font-size:16px; font-weight:400;'>{$dataSkill['nama_skill']}</h2>
                                    <div class='progress w-100'>
                                        <div class='progress-bar fw-bold text-center h-100' role='progressbar' style='width: {$dataSkill['value']}%;' aria-valuenow='{$dataSkill['value']}' aria-valuemin='0' aria-valuemax='100'>{$dataSkill['value']}%</div>
                                    </div>
                                </div>
                                ";
                            }
                        ?>    
                    </div>
                </div>
            </div>
        </div>
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>