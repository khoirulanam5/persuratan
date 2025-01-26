<!DOCTYPE html>
<html lang="en">

<body class="">
    <!-- Loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <!-- Loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page rtl-page">
            <!-- Halaman Content -->
            <?= $this->session->flashdata('pesan') ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-between mb-4">
                                    <div class="col-md-6"></div>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Surat</th>
                                                <th>Tanggal Kirim</th>
                                                <th>Tanggal Terima</th>
                                                <th>Perihal</th>
                                                <th>Isi Surat</th>
                                                <th>Pengirim</th>
                                                <th>Status</th>
                                                <th>File</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($surat as $val): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $val->id_surat_masuk ?></td>
                                                    <td><?= date('d-m-Y', strtotime($val->tgl_kirim)); ?></td>
                                                    <td><?= $val->tgl_terima ?></td>
                                                    <td><?= $val->perihal ?></td>
                                                    <td><?= $val->isi_surat ?></td>
                                                    <td><?= $val->pengirim ?></td>
                                                    <td>
                                                        <?php if ($val->status === NULL): ?>
                                                            <span class="badge badge-warning">Diproses</span>
                                                        <?php elseif ($val->status === 'Diteruskan'): ?>
                                                            <span class="badge badge-primary">Diteruskan</span>
                                                        <?php elseif ($val->status === 'Ditanggapi'): ?>
                                                            <span class="badge badge-success">Ditanggapi</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('assets/img/surat_masuk/' . $val->file) ?>" class="badge badge-primary" target="_blank">
                                                            <?= $val->file ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php if ($val->status === NULL): ?>
                                                        <a href="<?= base_url('pegawai/suratmasuk/teruskan/') . $val->id_surat_masuk ?>" class="btn btn-primary btn-sm">Teruskan</a>
                                                        <?php endif; ?>
                                                        <a href="<?= base_url('pegawai/suratmasuk/delete/') . $val->id_surat_masuk ?>" class="btn btn-danger btn-sm hapus">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.hapus').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah link agar tidak langsung dijalankan
            var url = this.getAttribute('href'); // Ambil URL dari atribut href

            Swal.fire({
                title: "Hapus Data?",
                text: "Data yang sudah dihapus tidak dapat dipulihkan kembali!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, redirect ke URL penghapusan
                    window.location.href = url;
                }
            });
        });
    });
    </script>
</body>

</html>
