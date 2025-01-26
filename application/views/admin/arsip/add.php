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
                                <form action="<?= base_url('admin/arsip/add') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                            <label>Pilih Surat:</label>
                                            <select class="form-control" name="id_surat" required>
                                                <option value="">Pilih Surat</option>
                                                <?php foreach ($surat as $val): ?>
                                                    <option value="<?= $val->id_surat ?>">
                                                        <?= $val->id_surat ?> - <?= $val->jenis_surat ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <div class="form-group">
                                        <label>Jenis Surat:</label>
                                        <input type="text" name="jenis_surat" class="form-control" placeholder="Masukan jenis surat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi Pengarsipan:</label>
                                        <select name="lokasi_arsip" class="form-control" required>
                                            <option value="">Pilih Lokasi Pengarsipan</option>
                                            <option value="Umum dan Kepegawaian">Umum dan Kepegawaian</option>
                                            <option value="Perencanaan dan Keuangan">Perencanaan dan Keuangan</option>
                                            <option value="Pengawasan Bidang Pemerintahan">Pengawasan Bidang Pemerintahan</option>
                                            <option value="Pengawasan Bidang Pembangunan">Pengawasan Bidang Pembangunan</option>
                                            <option value="Pengawasan Bidang Kemasyarakatan">Pengawasan Bidang Kemasyarakatan</option>
                                            <option value="Pengawasan Keuangan">Pengawasan Keuangan</option>
                                            <option value="Pengawasan Kinerja">Pengawasan Kinerja</option>
                                            <option value="Pemeriksaan Khusus">Pemeriksaan Khusus</option>
                                            <option value="Tindak Lanjut Hasil Pemeriksaan">Tindak Lanjut Hasil Pemeriksaan</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Arsipkan</button>
                                    <a href="<?= base_url('admin/arsip') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
