<!-- app/Views/pages/dashboard_v.php (Setelah diubah) -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= (isset($title)) ? esc($title) : 'Dashboard' ?> - TugasKuliah</title> <!-- Judul dinamis -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <!-- Gunakan / di awal untuk path absolut -->
    <!-- Custom CSS -->
    <link href="/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?= view('layouts/topbar_v') ?>
        <?= view('layouts/sidebar_v') ?>

        <!-- ============================================================== -->
        <!--     PERUBAHAN UTAMA ADA DI BAWAH INI                       -->
        <!-- ============================================================== -->
        <?php if (isset($this) && method_exists($this, 'renderSection') && $this->renderSection('konten', true)): ?>
            <?= $this->renderSection('konten') ?>
        <?php else: ?>
            <?php // Jika tidak ada section 'konten', muat konten dashboard default 
            ?>
            <?= view('pages/kontent_v') ?>
        <?php endif; ?>
        <!-- ============================================================== -->
        <!--     AKHIR PERUBAHAN                                          -->
        <!-- ============================================================== -->

    </div>

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="/dist/js/app-style-switcher.js"></script>
    <script src="/dist/js/feather.min.js"></script>
    <script src="/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="/assets/extra-libs/c3/d3.min.js"></script>
    <script src="/assets/extra-libs/c3/c3.min.js"></script>
    <script src="/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/dist/js/pages/dashboards/dashboard1.min.js"></script>

    <!-- Panggil feather.replace() untuk render ikon di semua halaman -->
    <script>
        feather.replace();
    </script>
</body>

</html>