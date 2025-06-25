<!-- app/Views/layouts/topbar_v.php -->
<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-lg">
        <div class="navbar-header" data-logobg="skin6">
            <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i></i></a>
            <div class="navbar-brand">
                <a href="/dashboard">
                    <img src="/assets/images/mgmtfinal.svg" alt="" class="img-fluid">
                </a>
            </div>
            <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"><i></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!--       BAGIAN NOTIFIKASI YANG DIPERBARUI                      -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                <!-- Notification -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)" id="bell"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i data-feather="bell" class="svg-icon"></i></span>
                        <!-- Tampilkan badge hanya jika ada notifikasi -->
                        <?php if (isset($jumlah_notifikasi) && $jumlah_notifikasi > 0): ?>
                            <span class="badge text-bg-primary notify-no rounded-circle"><?= $jumlah_notifikasi ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                        <ul class="list-style-none">
                            <li>
                                <div class="message-center notifications position-relative">

                                    <!-- Looping untuk menampilkan notifikasi tugas -->
                                    <?php if (!empty($notifikasi_tugas)): ?>
                                        <?php foreach ($notifikasi_tugas as $tugas): ?>
                                            <?php
                                            // Hitung waktu sejak tugas dibuat
                                            $time = new \CodeIgniter\I18n\Time($tugas['created_at']);
                                            $waktu_lalu = $time->humanize();
                                            ?>
                                            <a href="/tugas"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-primary text-white rounded-circle btn-circle"><i
                                                        data-feather="file-text" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle ps-2">
                                                    <h6 class="message-title mb-0 mt-1">Tugas Baru:
                                                        <?= esc(word_limiter($tugas['nama_tugas'], 4)) ?></h6>
                                                    <span class="font-12 text-nowrap d-block text-muted text-truncate">Deadline:
                                                        <?= date('d M Y', strtotime($tugas['deadline'])) ?></span>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted"><?= $waktu_lalu ?></span>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <!-- Pesan jika tidak ada notifikasi -->
                                        <div class="text-center p-3 text-muted">
                                            Tidak ada notifikasi baru.
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </li>
                            <?php if (!empty($notifikasi_tugas)): ?>
                                <li>
                                    <a class="nav-link pt-3 text-center text-dark" href="/tugas">
                                        <strong>Lihat Semua Tugas</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
                <!-- End Notification -->
            </ul>

            <!-- ============================================================== -->
            <!--       BAGIAN KANAN (PROFIL PENGGUNA)                         -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="/assets/images/users/profile-pic.jpg" alt="user" class="rounded-circle" width="40">
                        <!-- Tampilkan nama dari session -->
                        <span class="ms-2 d-none d-lg-inline-block">
                            <span class="text-dark"><?= esc(session()->get('nama')) ?></span>
                            <i data-feather="chevron-down" class="svg-icon"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
                        <!-- Link Logout -->
                        <a class="dropdown-item" href="/logout"><i data-feather="power" class="svg-icon me-2 ms-1"></i>
                            Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>