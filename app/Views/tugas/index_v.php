<?= $this->extend('pages/dashboard_v') ?>

<?= $this->section('konten') ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">Daftar Semua Tugas</h4>
                            <div class="ms-auto">
                                <a href="/tugas/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Tugas
                                    Baru</a>
                            </div>
                        </div>

                        <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Tugas</th>
                                        <th scope="col">Deadline</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($tugas)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada tugas.</td>
                                    </tr>
                                    <?php else: ?>
                                    <?php $no = 1;
                                        foreach ($tugas as $t): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($t['nama_tugas']) ?></td>
                                        <td><?= date('d M Y', strtotime($t['deadline'])) ?></td>
                                        <td>
                                            <?php
                                                    $status_class = 'bg-warning'; // Belum Dikerjakan
                                                    if ($t['status'] == 'Sedang Dikerjakan') $status_class = 'bg-info';
                                                    if ($t['status'] == 'Selesai') $status_class = 'bg-success';
                                                    ?>
                                            <span class="badge <?= $status_class ?>"><?= esc($t['status']) ?></span>
                                        </td>
                                        <td>
                                            <a href="/tugas/edit/<?= $t['id'] ?>"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="/tugas/delete/<?= $t['id'] ?>" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center text-muted">
        All Rights Reserved by Freedash. Designed and Developed by <a href="https://adminmart.com/">Adminmart</a>.
    </footer>
</div>
<?= $this->endSection() ?>