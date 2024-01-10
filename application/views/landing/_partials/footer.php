<!-- footer -->
<div class="" id="contact" id="lowongan" data-aos="fade-up" data-aos-duration="1000">
    <footer>
    
        <div class="kotak-footer">
            <div class="kotak-logo">
                <img src="<?php echo base_url("assets/img/logo/logo_putih.png")?>" alt="Logo">
            </div>
    
            <div class="kotak-body">
                <div class="about">
                    <h3>About</h3>
                    <p>Bali Job Finder adalah layanan menyediakan Info lowongan pekerjaan yang dipercaya oleh banyak perusahaan dan Bali Job Finder hadir untuk membantu Anda yang sedang mencari pekerjaan yang diimpikan .</p>
                </div>
    
                <div class="kontak">
                    <h3>Kontak</h3>
    
                    <div class="icon-kontak">
                        <a href="" ><i class="fa-solid fa-envelope"></i></a>
                        <p>balijobfinder@gmail.com</p>
                    </div>
    
                    <div class="icon-kontak">
                        <a href=""><i class="fa-brands fa-whatsapp"></i></a>
                        <p>087777777777</p>
                    </div>
    
                </div>
            </div>
    
            <div class="kotak-copy">
                
                <div class="sosmed">
                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                    <a href="" class="sosmed-center"><i class="fa-brands fa-facebook"></i></a>
                    <a href=""><i class="fa-brands fa-x-twitter"></i></a>
                </div>
    
                <div class="copy">
                    <p>© 2023 PT. BALI JOB FINDER</p>
                </div>
            </div>
        </div>
    
    </footer>
</div>
<!-- end footer -->
    

    <script src="<?php echo base_url('assets/js/navbar.js')?>"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>

    <!-- slide js -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script>
        document.addEventListener( 'DOMContentLoaded', function () {
        new Splide('.splide', {
            type: 'loop',
            perPage: 3,
            focus: 'center',
            autoplay: true,
            interval: 3000,
            updateOnMove: true,
            pagination: false,
            breakpoints: {
                640: {
                    perPage: 2
                },
                768: {
                    perPage: 3
                }
            }
        }).mount();
        });
    </script>
    
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // get data 

        <?php if($this->session->flashdata('swal_icon')):?>

            Swal.fire({
                title: "<?= $this->session->flashdata('swal_title')?>",
                text: "<?= $this->session->flashdata('swal_text')?>",
                icon: "<?= $this->session->flashdata('swal_icon')?>",
            });

        <?php endif;?> 

    </script>
</body>
</html>