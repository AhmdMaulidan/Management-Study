<style>
    .task-card-link {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: transform 0.2s ease-in-out;
    }

    .task-card-link:hover {
        transform: translateY(-5px);
        color: inherit;
    }
</style>

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Greetings and Cards -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <!-- Gunakan variabel $nama yang sudah dikirim dari controller -->
                <h2 class="mb-4">Hay! <?= esc($nama) ?></h2>
            </div>
        </div>

        <!-- 3 Cards -->
        <div class="row">
            <!-- Card 1: Input Tugas -->
            <div class="row">
                <!-- Card 1: Input Tugas -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-end h-100" style="border-color: #05AC69 !important">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p> </p>
                                    <i data-feather="plus-circle" class="text-success"
                                        style="width:50px; height:50px;"></i>
                                    <h4 class="card-title mt-2  " style="color: #05AC69;">Input Tugas</h4>
                                </div>
                                <div class="ms-auto">
                                    <i data-feather="briefcase" style="width:50px; height:50px; color: #05AC69;"></i>
                                </div>
                            </div>
                            <a href="/tugas/create"
                                class="btn btn-success w-100 mt-3 d-flex justify-content-between align-items-center">
                                <span>Tambah</span>
                                <i data-feather="arrow-right-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Daftar Tugas -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-end h-100" style="border-color: #8868f1 !important;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <!-- PERUBAHAN ANGKA DINAMIS DI SINI -->
                                    <h1 class="font-weight-bold" style="font-size: 3.5rem; color: #8868f1;">
                                        <?= esc($jumlah_daftar_tugas) ?></h1>
                                    <h4 class="card-title" style="color: #8868f1;">Daftar Tugas</h4>
                                </div>
                                <div class="ms-auto">
                                    <i data-feather="briefcase" style="width:50px; height:50px; color: #8868f1;"></i>
                                </div>
                            </div>
                            <!-- PERUBAHAN LINK DI SINI -->
                            <a href="/tugas" class="btn w-100 mt-3 d-flex justify-content-between align-items-center"
                                style="background-color: #8868f1; color: white;">
                                <span>Lihat</span>
                                <i data-feather="arrow-right-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Tugas Selesai -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-end h-100" style="border-color: #13b3ec !important;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <!-- PERUBAHAN ANGKA DINAMIS DI SINI -->
                                    <h1 class="font-weight-bold" style="font-size: 3.5rem; color: #13b3ec;">
                                        <?= esc($jumlah_tugas_selesai) ?></h1>
                                    <h4 class="card-title" style="color: #13b3ec;">Tugas Selesai</h4>
                                </div>
                                <div class="ms-auto">
                                    <i data-feather="check-circle" style="width:50px; height:50px; color: #13b3ec;"></i>
                                </div>
                            </div>
                            <!-- PERUBAHAN LINK DI SINI -->
                            <a href="/tugas/selesai"
                                class="btn w-100 mt-3 d-flex justify-content-between align-items-center"
                                style="background-color: #13b3ec; color: white;">
                                <span>Lihat</span>
                                <i data-feather="arrow-right-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- Daftar Tugas List (BAGIAN YANG DIPERBARUI) -->
            <!-- ============================================================== -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="mb-0 text-primary">Daftar Tugas</h4>
                        <hr class="flex-grow-1 ms-3" style="border-top: 1px solid #8868f1;">
                    </div>

                    <?php if (empty($daftar_tugas)): ?>
                        <div class="card">
                            <div class="card-body text-center text-muted">
                                <p class="mb-0">Tidak ada tugas aktif saat ini. Selamat! 🎉</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($daftar_tugas as $tugas): ?>
                            <?php
                            // --- (Logika perhitungan deadline Anda biarkan apa adanya) ---
                            $deadline = new \DateTime($tugas['deadline']);
                            $today = new \DateTime('now');
                            $interval = $today->diff($deadline);

                            $deadline_text = '';
                            $deadline_color = 'text-muted';

                            if ($interval->invert) {
                                $deadline_text = 'Telah Lewat ' . $interval->days . ' Hari';
                                $deadline_color = 'text-danger';
                            } elseif ($interval->days == 0) {
                                $deadline_text = 'Deadline Hari Ini!';
                                $deadline_color = 'text-warning';
                            } else {
                                $deadline_text = 'Deadline : ' . $interval->days . ' Hari Lagi';
                            }

                            $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            $tanggal_formatted = $deadline->format('d') . ' ' . $bulan[$deadline->format('n')] . ' ' . $deadline->format('Y');
                            ?>

                            <!-- PERUBAHAN UTAMA ADA DI SINI -->
                            <div class="card task-card-link" data-bs-toggle="modal" data-bs-target="#detailTugasModal"
                                data-nama="<?= esc($tugas['nama_tugas']) ?>"
                                data-deadline="<?= $tanggal_formatted ?> (<?= $deadline_text ?>)"
                                data-status="<?= esc($tugas['status']) ?>"
                                data-keterangan="<?= esc($tugas['keterangan'] ?: 'Tidak ada keterangan.') ?>"
                                data-edit-link="/tugas/edit/<?= $tugas['id'] ?>" style="cursor: pointer;">

                                <div class="card-body">
                                    <h5 class="card-title text-primary"><?= esc($tugas['nama_tugas']) ?></h5>
                                    <div class="d-flex align-items-center mt-3 <?= $deadline_color ?>">
                                        <i data-feather="clock" class="me-2"></i>
                                        <span><?= $deadline_text ?></span>
                                    </div>
                                    <div class="d-flex align-items-center mt-2 text-muted">
                                        <i data-feather="calendar" class="me-2"></i>
                                        <span><?= $tanggal_formatted ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Kerangka Modal untuk Detail Tugas (KODE BARU) -->
            <!-- ============================================================== -->
            <div class="modal fade" id="detailTugasModal" tabindex="-1" aria-labelledby="detailTugasModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailTugasModalLabel">Detail Tugas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Konten akan diisi oleh JavaScript -->
                            <h4 id="modal-nama-tugas" class="text-primary"></h4>
                            <hr>
                            <p><strong>Deadline:</strong> <span id="modal-deadline"></span></p>
                            <p><strong>Status:</strong> <span id="modal-status"></span></p>
                            <p><strong>Keterangan:</strong></p>
                            <p id="modal-keterangan" style="white-space: pre-wrap;"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <a href="#" id="modal-edit-link" class="btn btn-primary">Edit Tugas</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- AKHIR Kerangka Modal -->
            <footer class="footer text-center text-muted">
                All Rights Reserved by Freedash. Designed and Developed by <a
                    href="https://adminmart.com/">Adminmart</a>.
            </footer>
        </div>
        <script>
            // Inisialisasi Feather Icons setelah halaman dimuat
            feather.replace();
            // -- SCRIPT BARU UNTUK MODAL DETAIL TUGAS --
            var detailTugasModal = document.getElementById('detailTugasModal');
            detailTugasModal.addEventListener('show.bs.modal', function(event) {
                // Tombol (atau kartu) yang memicu modal
                var card = event.relatedTarget;

                // Ambil data dari atribut data-* di kartu
                var namaTugas = card.getAttribute('data-nama');
                var deadline = card.getAttribute('data-deadline');
                var status = card.getAttribute('data-status');
                var keterangan = card.getAttribute('data-keterangan');
                var editLink = card.getAttribute('data-edit-link');

                // Cari elemen di dalam modal berdasarkan ID
                var modalNamaTugas = detailTugasModal.querySelector('#modal-nama-tugas');
                var modalDeadline = detailTugasModal.querySelector('#modal-deadline');
                var modalStatus = detailTugasModal.querySelector('#modal-status');
                var modalKeterangan = detailTugasModal.querySelector('#modal-keterangan');
                var modalEditLink = detailTugasModal.querySelector('#modal-edit-link');

                // Isi elemen-elemen modal dengan data yang sudah diambil
                modalNamaTugas.textContent = namaTugas;
                modalDeadline.textContent = deadline;
                modalStatus.textContent = status;
                modalKeterangan.textContent = keterangan;
                modalEditLink.href = editLink;
            });
        </script>