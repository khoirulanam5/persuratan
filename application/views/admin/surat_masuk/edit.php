<!DOCTYPE html>
<html lang="en">

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page rtl-page">
            <!-- Halaman content -->
            <?= $this->session->flashdata('pesan') ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('admin/surat_masuk/edit/' . $surat->id_surat_masuk) ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Nomor Surat:</label>
                                        <input type="text" name="nomor" class="form-control" value="<?= $surat->nomor ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Perihal:</label>
                                        <select name="id_jenis_surat" class="form-control" required>
                                            <option value="">Pilih Perihal</option>
                                            <?php foreach($jenis as $val): ?>
                                                <option value="<?= $val->id_jenis_surat ?>" <?= ($val->id_jenis_surat == $surat->id_jenis_surat) ? 'selected' : '' ?>>
                                                    <?= $val->jenis ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Disposisi:</label>
                                        <select name="disposisi" class="form-control" required>
                                            <option value="">Disposisi ke:</option>
                                            <option value="Inspektur" <?= $surat->disposisi == 'Inspektur' ? 'selected' : '' ?>>Inspektur</option>
                                            <option value="Sekretariat" <?= $surat->disposisi == 'Sekretariat' ? 'selected' : '' ?>>Sekretariat</option>
                                            <option value="Administrasi" <?= $surat->disposisi == 'Administrasi' ? 'selected' : '' ?>>Administrasi</option>
                                            <option value="Irban 1" <?= $surat->disposisi == 'Irban 1' ? 'selected' : '' ?>>Irban 1</option>
                                            <option value="Irban 2" <?= $surat->disposisi == 'Irban 2' ? 'selected' : '' ?>>Irban 2</option>
                                            <option value="Irban 3" <?= $surat->disposisi == 'Irban 3' ? 'selected' : '' ?>>Irban 3</option>
                                            <option value="Irban 4" <?= $surat->disposisi == 'Irban 4' ? 'selected' : '' ?>>Irban 4</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>File Lama:</label>
                                        <p><a href="<?= base_url('assets/img/surat_masuk/' . $surat->file) ?>" target="_blank"><?= $surat->file ?></a></p>
                                    </div>
                                    <div class="form-group">
                                        <label>File Baru (Opsional):</label>
                                        <input type="file" name="file" class="form-control" accept=".doc,.docx,.pdf">
                                        <small class="form-text text-muted">Hanya file dengan format .doc, .docx, atau .pdf yang diperbolehkan.</small>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    <a href="<?= base_url('admin/surat_masuk') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
