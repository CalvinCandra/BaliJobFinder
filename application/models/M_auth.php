<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
    
// ==================================================== Config Email Verification
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
// =========================================================== Ambil Data User Sesuai Email
    public function getUser($email){
        // ambil data users yang emailnya sama
        $user = $this->db->get_where('users', ['email' => $email])->row();
        return $user;
    }

// ==================================================================================== REGISTER
// ============================================================================ PELAMAR
    public function regisPelamar(){
        // mengambil data inputan user
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $name = $this->input->post('name');

        // membuat token
        $token = base64_encode(random_bytes(16));

        // deklarasi untuk memasukan data pada table users
        $data = array(
            'email' => $email,
            'password' => htmlspecialchars(password_hash($pass, PASSWORD_DEFAULT)),
            'name' => $name,
            'email_verified' => NULL,
            'token' => $token,
            'role' => "pelamar",
        );

        // db transision
        $this->db->trans_start();
        // insert ke table users
        $this->db->insert('users', $data);
        // mengambil last id
        $last_id = $this->db->insert_id();

        // deklarasi untuk memasukan data pda table data_pelamar
        $dataPelamar = array(
            'nama_lengkap' => $name,
            'fk_id_users' => $last_id,
        );

        // deklarasi untuk memasukan data pda table data_pelamar
        $this->db->insert('data_pelamar', $dataPelamar);
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


// ============================================================================ PERUSAHAAN
    public function regisPerusahaan(){
        // mengambil data inputan user
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $name = $this->input->post('name');

        // membuat token
        $token = base64_encode(random_bytes(16));

        // deklarasi untuk memasukan data pada table users
        $data = array(
            'email' => $email,
            'password' => htmlspecialchars(password_hash($pass, PASSWORD_DEFAULT)),
            'name' => $name,
            'email_verified' => NULL,
            'token' => $token,
            'role' => "perusahaan",
        );

        // db transision
        $this->db->trans_start();
        // insert ke table users
        $this->db->insert('users', $data);
        // mengambil last id
        $last_id = $this->db->insert_id();

        // deklarasi untuk memasukan data pda table data_perusahaan
        $dataPerusahaan = array(
            'nama_perusahaan' => $name,
            'fk_id_users' => $last_id,
        );

        // insert ke table data_perusahaan
        $this->db->insert('data_perusahaan', $dataPerusahaan);
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

// ================================================================= update colom email_verified
    public function email_verified(){
        // membuat data-data untuk di update pada table users
        $data = array(
            'email_verified' => time(),
            'token' => NULL,
        );
        // update
        $this->db->update('users', $data);
    }


// ================================================================= update Password

    //memasukan token untuk link dan mengirim link ke email
    public function kirimChange($email){

        // membuat token
        $token = base64_encode(random_bytes(16));

        // membuat data-data untuk di update pada table users
        $data = array(
            'token' => $token,
        );
        // update
        $this->db->update('users', $data);

        // memanggil function config
        $this->config($email, $token, 'change');
    }

    // ===================================================================== update colom password
    public function forget(){
        // ambil data input user
        $pass = $this->input->post('password');

        // membuat data-data untuk di update pada table users
        $data = array(
            'password' => htmlspecialchars(password_hash($pass, PASSWORD_DEFAULT)),
            'token' => NULL,
        );

        //update
        $this->db->update('users', $data);
    }
}

/* End of file M_auth.php */
