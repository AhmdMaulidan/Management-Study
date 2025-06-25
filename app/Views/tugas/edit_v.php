<?= $this->extend('pages/dashboard_v') ?>

<?= $this->section('konten') ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Tugas</h4>
                        <p class="card-subtitle mb-4">Ubah detail tugas dan statusnya.</p>

                        <form action="/tugas/update/<?= $tugas['id'] ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="POST">
                            <div class="mb-3">
                                <label for="nama_tugas" class="form-label">Nama Tugas</label>
                                <input type="text" class="form-control" id="nama_tugas" name="nama_tugas"
                                    value="<?= old('nama_tugas', $tugas['nama_tugas']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="date" class="form-control" id="deadline" name="deadline"
                                    value="<?= old('deadline', $tugas['deadline']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"
                                    rows="3"><?= old('keterangan', $tugas['keterangan']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="Belum Dikerjakan"
                                        <?= $tugas['status'] == 'Belum Dikerjakan' ? 'selected' : '' ?>>Belum Dikerjakan
                                    </option>
                                    <option value="Sedang Dikerjakan"
                                        <?= $tugas['status'] == 'Sedang Dikerjakan' ? 'selected' : '' ?>>Sedang
                                        Dikerjakan</option>
                                    <option value="Selesai" <?= $tugas['status'] == 'Selesai' ? 'selected' : '' ?>>
                                        Selesai</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Tugas</button>
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