<!-- footer -->
<footer id="contact">
    <div class="kotak-body">
        <div class="about">
            <p>Bali Job Finder adalah platform terpercaya yang menyediakan informasi lowongan pekerjaan dari berbagai perusahaan terkemuka. Didesain intuitif, website ini membantu Anda menemukan pekerjaan impian dengan mudah. Fitur pembuatan CV otomatisnya juga mempermudah pengguna untuk membuat profil profesional secara efisien.</p>
        </div>

        <div class="kontak">
            <div class="kotak-logo">
                <img src="<?php echo base_url("assets/img/logo/logo_putih.png")?>" alt="Logo">
            </div>

            <div class="icon-kontak">
                <a href="" ><i class="fa-solid fa-envelope"></i></a>
                <p>balijobfinder@gmail.com</p>
            </div>

            <div class="icon-kontak">
                <a href=""><i class="fa-brands fa-whatsapp"></i></a>
                <p>085739076216</p>
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
</footer>
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
            perPage: 4,
            focus: 'center',
            autoplay: true,
            interval: 3000,
            updateOnMove: true,
            pagination: false,
            breakpoints: {
                500: {
                    perPage: 3
                },
                800: {
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