<?= $this->extend('pages/dashboard_v') ?>

<?= $this->section('konten') ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">Daftar Tugas yang Telah Selesai</h4>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Tugas</th>
                                        <th scope="col">Deadline</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($tugas)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada tugas yang selesai.</td>
                                    </tr>
                                    <?php else: ?>
                                    <?php $no = 1;
                                        foreach ($tugas as $t): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($t['nama_tugas']) ?></td>
                                        <td><?= date('d M Y', strtotime($t['deadline'])) ?></td>
                                        <td><span class="badge bg-success"><?= esc($t['status']) ?></span></td>
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