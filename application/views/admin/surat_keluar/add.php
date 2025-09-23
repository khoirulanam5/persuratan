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
                                <form action="<?= base_url('admin/surat_keluar/add') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Jenis Surat:</label>
                                        <select name="id_jenis_surat" class="form-control" required>
                                            <option value="">Jenis Surat</option>
                                            <?php foreach($jenis as $val): ?>
                                                <option value="<?= $val->id_jenis_surat ?>"><?= $val->jenis ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kepada:</label>
                                        <input type="text" name="kepada" class="form-control" placeholder="Pilih penerima" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Perihal:</label>
                                        <input type="text" name="perihal" class="form-control" placeholder="Pilih surat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor surat:</label>
                                        <select name="nomor" class="form-control" required>
                                            <option value="">Perihal</option>
                                            <?php foreach($nomor as $val): ?>
                                                <option value="<?= $val->kode ?>/<?= $val->nomor ?>"><?= $val->kode ?>/<?= $val->nomor ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>File:</label>
                                        <input type="file" name="file" class="form-control" accept=".doc,.docx,.pdf" required>
                                        <small class="form-text text-muted">Hanya file dengan format .doc, .docx, atau .pdf yang diperbolehkan.</small>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('admin/surat_keluar') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
