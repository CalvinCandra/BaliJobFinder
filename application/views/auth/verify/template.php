<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-secondary">
        <div class="h2 text-center mb-5">Bali Job Finder</div>

        <p class="fw-bold">Hallo</p>
        <p>Selamat Datang di Bali Job Finder, silahkan untuk melakukan aktivasi akun anda dengan klik, tombol di bawah ini</p>

        <?php
          foreach($data->result_array() as $key){
        ?>

          <div class="d-flex justify-content-center mb-3">
            <a href="" class="btn btn-danger">Verify Email Address</a>
          </div>

          <hr>
          <p class="d-flex justify-content-center">Or</p>
          <p class="d-flex justify-content-center">Klik link berikut untuk melakukan aktivasi akun</p>
          
          
          <div class="d-flex justify-content-center mb-3">
            <a href=""><?php echo base_url(). 'Auth/verify?email=' . $data->email . '&token='. $data->token ?></a>
          </div>
        
        <?php
          }
        ?>

        <p>Terima Kasih</p>
        <p>Bali Job FInder</p>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>