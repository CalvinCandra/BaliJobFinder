<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    // function mencari Data User berdasarkan email
    public function getUser($email){
        // ambil data users yang emailnya sama
        return $this->db->get_where('users', ['email' => $email]);
    }
    
    // function untuk config dan mengirim email verifikasi atau change password
    public function config($email, $token, $type){

        // config ketentuan email
        $config['useragent'] = "Codeigniter";
        $config['mailpath'] = "usr/bin/sendmail";
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "smtp.gmail.com";
        $config['smtp_port'] = 465;
        $config['smtp_user'] = "balijobfinder@gmail.com";
        $config['smtp_pass'] = "fsgu qxmy hlqn ayqj";
        $config['smtp_crypto'] = "ssl";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['smtp_timeout'] = 30;
        $config['wordwrap'] = TRUE;

        // mail traps
        // $config = Array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'sandbox.smtp.mailtrap.io',
        //     'smtp_port' => 2525,
        //     'smtp_user' => '5c005f9c357c7e',
        //     'smtp_pass' => '11cf2bc8fcae1f',
        //     'mailtype' => 'html',
        //     'crlf' => "\r\n",
        //     'newline' => "\r\n"
        // );

        // panggil library
        $this->load->library('email');

        // initialize config email
        $this->email->initialize($config);
        // host emailnya
        $this->email->from('balijobfinder@gmail.com','Bali Job Finder');
        // dikirim ke email users
        $this->email->to($email);

        // pengecekan jika type verify
        if($type == 'verify'){
            // jika typenya adalah verify, maka akan mengirim pesan berikut pada email users
            $this->email->subject('Account Verification');
            
            $this->email->message(

                '<html lang="en">
                <head>
                  <style>
                    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");
                    
                    body{
                        font-family: "Poppins", sans-serif;
                    }
                    
                    .container{
                        margin: 5px auto;
                        width :80vh;
                        padding: 2% 3%;
                    }
                    
                    .judul{
                        margin-top: 30px;
                        font-weight: 600;
                        text-align: center;
                        color: #0d6efd;
                    }
                    
                    .sapa{
                        font-weight: 600;
                        margin-bottom: 25px;
                        font-size: 30px;
                    }
                    
                    .button{
                        margin: 30px auto;
                    }
                    
                    .button .link{
                        background-color: #0d6efd;
                        padding: 10px 20px;
                        border: 1px solid #0d6efd;
                        border-radius: 5px;
                        color: #ffffff;
                        text-decoration: none;
                        font-weight: 600;
                        text-align :center;
                    }
                    
                    .button .link:hover{
                        background-color: #ffffff;
                        font-weight: 600;
                        color: #0d6efd;
                        border: 1px solid #0d6efd;
                        transition: background-color 0.5s ease-in-out;
                    }
                    
                    .pembatas{
                        margin: 7px 0px;
                    }
                    
                    .link-alt{
                        color: #0d6efd;
                    }
                </style>
                
                </head>

                <body>
                  <h1 class="judul">Bali Job Finder</h1>
                  <div class="container">
                
                      <p class="sapa">Hello!</p>
                      <p>Please click the button below to verify your email</p>
                
                      <div class="button">
                        <a href="'.base_url(). 'Auth/verify?email=' . $email . '&token='. $token .'" class="link">Verify Now</a>
                      </div>
                
                      <p>Regards, <br>
                        Bali Job Finder
                      </p>
                
                      <hr class="pembatas">
                
                      <p class="alt">
                        if you having trouble clicking the <span>"Verify Now"</span>  button, copy and paste the URL below into your web browser:
                        <a href="'.base_url(). 'Auth/verify?email=' . $email . '&token='. $token .'" class="link-alt">'.base_url(). 'Auth/verify?email=' . $email . '&token='. $token .'</a>
                      </p>
                  </div>
                </body>
                </html>'
            );

        //jika typenya change, akan mengirim email berikut
        }else if($type == 'change'){
            $this->email->subject('Change Password');
            $this->email->message('
            <html lang="en">
            <head>
              <style>
                @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");
                
                body{
                    font-family: "Poppins", sans-serif;
                }
                
                .container{
                    margin: 5px auto;
                    width :80vh;
                    padding: 2% 3%;
                }
                
                .judul{
                    margin-top: 30px;
                    font-weight: 600;
                    text-align: center;
                    color: #0d6efd;
                }
                
                .sapa{
                    font-weight: 600;
                    margin-bottom: 25px;
                    font-size: 30px;
                }
                
                .button{
                    margin: 30px auto;
                }
                
                .button .link{
                    background-color: #0d6efd;
                    padding: 10px 20px;
                    border: 1px solid #0d6efd;
                    border-radius: 5px;
                    color: #ffffff;
                    text-decoration: none;
                    font-weight: 600;
                    text-align :center;
                }
                
                .button .link:hover{
                    background-color: #ffffff;
                    font-weight: 600;
                    color: #0d6efd;
                    border: 1px solid #0d6efd;
                    transition: background-color 0.5s ease-in-out;
                }
                
                .pembatas{
                    margin: 7px 0px;
                }
                
                .link-alt{
                    color: #0d6efd;
                }
            </style>
            
            </head>

            <body>
              <h1 class="judul">Bali Job Finder</h1>
              <div class="container">
            
                  <p class="sapa">Hello!</p>
                  <p>Please click the button below to change your password</p>
            
                  <div class="button">
                    <a href="'.base_url(). 'Auth/ForgetPassword?email=' . $email . '&token='. $token .'" class="link">Change Now</a>
                  </div>
            
                  <p>Regards, <br>
                    Bali Job Finder
                  </p>
            
                  <hr class="pembatas">
            
                  <p class="alt">
                    if you having trouble clicking the <span>"Change Now"</span>  button, copy and paste the URL below into your web browser:
                    <a href="'.base_url(). 'Auth/ForgetPassword?email=' . $email . '&token='. $token .'" class="link-alt">'.base_url(). 'Auth/ForgetPassword?email=' . $email . '&token='. $token .'</a>
                  </p>
              </div>
            </body>
            </html>
            ');
        }

        // kirim email
        $this->email->send();
        
    }

    // function untuk register pelamar dan mengirim email verifikasi
    public function regisPelamar($email, $pass, $name){
        // // membuat token random
        $token = base64_encode(random_bytes(10));

        // deklarasi untuk memasukan data pada table users
        $datausers = array(
            'email' => $email,
            'password' => $pass,
            'name' => $name,
            'email_verified' => NULL,
            'token' => $token,
            'role' => "pelamar",
        );

        // db transision start
        $this->db->trans_start();

        // insert ke table users
        $this->db->insert('users', $datausers);

        // mengambil last id yang baru saja di insert
        $last_id_users = $this->db->insert_id();

        // deklarasi untuk memasukan data pada table data_pelamar
        $dataPelamar = array(
            'nama_lengkap' => $name,
            'fk_id_users' => $last_id_users,
        );

        // deklarasi untuk memasukan data pda table data_pelamar
        $this->db->insert('data_pelamar', $dataPelamar);
        
        // db transision end
        $this->db->trans_complete();

        // ngecek jika tidak berhasil
        if ($this->db->trans_status() === FALSE)
        {
            // maka akan dikembalikanb seperti sebelumnya
            $this->db->trans_rollback();
        }
        // jika berhasil
        else
        {
            // maka akan di comit
            $this->db->trans_commit();
        }

        // memanggil function config
        $this->config($email, $token, 'verify');

    }

    // function untuk register perusahaan dan mengirim email verifikasi
    public function regisPerusahaan($email, $pass, $name){
        // membuat token
        $token = base64_encode(random_bytes(10));

        // deklarasi untuk memasukan data pada table users
        $datausers = array(
            'email' => $email,
            'password' => $pass,
            'name' => $name,
            'email_verified' => NULL,
            'token' => $token,
            'role' => "perusahaan",
        );

        // db transision start
        $this->db->trans_start();

        // insert ke table users
        $this->db->insert('users', $datausers);
        // mengambil last id
        $last_id_users = $this->db->insert_id();

        // deklarasi untuk memasukan data pda table data_perusahaan
        $dataPerusahaan = array(
            'nama_perusahaan' => $name,
            'fk_id_users' => $last_id_users,
        );

        // insert ke table data_perusahaan
        $this->db->insert('data_perusahaan', $dataPerusahaan);

        // db transision end
        $this->db->trans_complete();

         // ngecek jika tidak berhasil
         if ($this->db->trans_status() === FALSE)
         {
             // maka akan dikembalikanb seperti sebelumnya
             $this->db->trans_rollback();
         }
         // jika berhasil
         else
         {
             // maka akan di comit
             $this->db->trans_commit();
         }

        // memanggil function config
        $this->config($email, $token, 'verify');
    }

    // function untuk verifikasi email
    public function email_verified($id_users){
        // membuat data-data untuk di update pada table users
        $data = array(
            'email_verified' => date('Y-m-d'),
            'token' => NULL,
        );

        $this->db->where('id_users', $id_users);

        // update
        $this->db->update('users', $data);
    }


    //function untuk mengirimkan link ganti password ke email
    public function kirimChangeForget($email, $id_users){

        // membuat token
        $token = base64_encode(random_bytes(16));

        // membuat data-data untuk di update pada table users
        $data = array(
            'token' => $token,
        );

        $this->db->where('id_users', $id_users);
        // update
        $this->db->update('users', $data);

        // memanggil function config
        $this->config($email, $token, 'change');
    }

    // function untuk menganti password yang sudah di input
    public function forget($pass, $id_users){
        // membuat data-data untuk di update pada table users
        $data = array(
            'password' => $pass,
            'token' => NULL,
        );

        //update
        $this->db->where(['id_users '=> $id_users]);
        $this->db->update('users', $data);
    }
}

/* End of file M_auth.php */
