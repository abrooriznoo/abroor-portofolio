<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo "
        <div class='toast-container position-fixed top-0 end-0 p-3' style='z-index: 9999;'>
            <div class='toast align-items-center text-bg-success border-0 show' role='alert' aria-live='assertive' aria-atomic='true'>
                <div class='d-flex'>
                    <div class='toast-body'>
                        Pesan berhasil dikirim!
                    </div>
                    <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastElList = [].slice.call(document.querySelectorAll('.toast'));
                toastElList.map(function(toastEl) {
                    var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                    toast.show();
                });
            });
        </script>
        ";
    } elseif ($_GET['status'] === 'error') {
        echo "
        <div class='toast-container position-fixed top-0 end-0 p-3' style='z-index: 9999;'>
            <div class='toast align-items-center text-bg-danger border-0 show' role='alert' aria-live='assertive' aria-atomic='true'>
                <div class='d-flex'>
                    <div class='toast-body'>
                        Pesan gagal dikirim.
                    </div>
                    <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastElList = [].slice.call(document.querySelectorAll('.toast'));
                toastElList.map(function(toastEl) {
                    var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                    toast.show();
                });
            });
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Portofolio - AR</title>
</head>

<body style="background: linear-gradient(to bottom, #fb923c, #ffffff, #3b82f6); min-height: 100vh;">

    <!-- main content - start -->
    <!-- header -->
    <?php include 'components/navbar.php'; ?>

    <!-- content -->
    <div class="container" style="margin-top:30px" data-aos="zoom-in-up" data-aos-duration="1500">
        <section class="section">
            <?php
            if (isset($_GET['page'])) {
                if (file_exists('pages/' . $_GET['page'] . ".php")) {
                    include_once 'pages/' . $_GET['page'] . ".php";
                }
            } else {
                include 'pages/home.php'; // default page
            }
            ?>
            <!-- / Content -->
        </section>
    </div>
    <!-- footer -->
    <?php include 'components/footer.php'; ?>

    <!-- main content - end -->
    <!-- Bootstrap core JavaScript Placed at the end of the document so the pages load faster  -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
        function openGmail(event) {
            event.preventDefault(); // Mencegah submit form

            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const message = document.getElementById("message").value.trim();

            const subject = encodeURIComponent("Pesan dari " + name);
            const body = encodeURIComponent(`Nama: ${name}\nEmail: ${email}\n\n${message}`);

            const mailtoURL = `https://mail.google.com/mail/?view=cm&fs=1&to=your@email.com&su=${subject}&body=${body}`;

            window.open(mailtoURL, '_blank');
        }
    </script>

    <script>
        $(document).ready(function () {
            // Ambil nilai ?page= dari URL
            const urlParams = new URLSearchParams(window.location.search);
            const page = urlParams.get('page') || 'home';

            // Hapus semua class 'active' di navbar
            $('.navbar-nav .nav-link').removeClass('active');

            // Tambahkan class 'active' pada link yang sesuai
            $('.navbar-nav .nav-link').each(function () {
                // Ambil href dan cek apakah mengandung ?page=
                const href = $(this).attr('href');
                if (href && href.includes('?page=')) {
                    const linkPage = href.split('?page=')[1];
                    if (linkPage === page) {
                        $(this).addClass('active');
                    }
                } else if (page === 'home' && (href === '#' || href === 'index.php')) {
                    $(this).addClass('active');
                }
            });
        });
    </script>
</body>

</html>