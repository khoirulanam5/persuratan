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
                                <form action="<?= base_url('admin/surat_masuk/add') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Nomor Surat:</label>
                                        <input type="text" name="nomor" class="form-control" placeholder="Nomor surat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Perihal:</label>
                                        <select name="id_jenis_surat" class="form-control" required>
                                            <option value="">Perihal</option>
                                            <?php foreach($jenis as $val): ?>
                                                <option value="<?= $val->id_jenis_surat ?>"><?= $val->jenis ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Disposisi:</label>
                                        <select name="disposisi" class="form-control" required>
                                            <option value="">Disposisi ke:</option>
                                            <option value="Inspektur">Inspektur</option>
                                            <option value="Sekretariat">Sekretariat</option>
                                            <option value="Administrasi">Administrasi</option>
                                            <option value="Irban 1">Irban 1</option>
                                            <option value="Irban 2">Irban 2</option>
                                            <option value="Irban 3">Irban 3</option>
                                            <option value="Irban 4">Irban 4</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>File:</label>
                                        <input type="file" name="file" class="form-control" accept=".doc,.docx,.pdf" required>
                                        <small class="form-text text-muted">Hanya file dengan format .doc, .docx, atau .pdf yang diperbolehkan.</small>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('admin/surat_masuk') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
