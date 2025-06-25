<?= $this->extend('pages/dashboard_v') ?>

<?= $this->section('konten') ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Tambah Tugas</h4>
                        <p class="card-subtitle mb-4">Isi detail tugas yang akan ditambahkan.</p>

                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <p><?= esc($error) ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <form action="/tugas/store" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="nama_tugas" class="form-label">Nama Tugas</label>
                                <input type="text" class="form-control" id="nama_tugas" name="nama_tugas"
                                    value="<?= old('nama_tugas') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="date" class="form-control" id="deadline" name="deadline"
                                    value="<?= old('deadline') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"
                                    rows="3"><?= old('keterangan') ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Tugas</button>
                            <a href="/tugas" class="btn btn-secondary">Batal</a>
                        </form>
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