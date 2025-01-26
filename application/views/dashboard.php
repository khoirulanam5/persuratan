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
            <!-- Dashboard Widgets -->
            <?php if($this->session->userdata('level') !== 'TAMU'): ?>
            <div class="row">
               <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-1">
                              <i class="fas fa-envelope"></i>
                           </span>
                           <div class="dash-count">
                               <div class="dash-title">Jumlah Surat Masuk</div>
                              <div class="dash-counts">
                                  <p><?= $surat_masuk ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-1">
                                <i class="fas fa-envelope-open"></i>
                           </span>
                           <div class="dash-count">
                               <div class="dash-title">Jumlah Surat Keluar</div>
                              <div class="dash-counts">
                                  <p><?= $surat_keluar ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-2">
                              <i class="fas fa-archive"></i>
                           </span>
                           <div class="dash-count">
                              <div class="dash-title">Arsip Surat</div>
                              <div class="dash-counts">
                                 <p><?= $arsip ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-3">
                              <i class="fas fa-users"></i>
                           </span>
                           <div class="dash-count">
                              <div class="dash-title">Jumlah Pegawai</div>
                              <div class="dash-counts">
                                 <p><?= $user ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <!-- /Dashboard Widgets -->

            <!-- Welcome Message -->
            <div class="col-xl-12 col-sm-12 col-12">
               <div class="card">
                  <div class="card-body">
                     <?= $this->session->flashdata('pesan'); ?>
                     <center>
                        <h4 class="header-title">Selamat Datang <?= $this->session->userdata('nm_pengguna'); ?> di Sistem Persuratan Inspektorat Daerah Kab. Kudus.</h4>
                        <?php if($this->session->userdata('level') !== 'TAMU'): ?>
                        <p class="text-muted">Anda dapat melakukan pekerjaan anda sesuai dengan jabatan <?= $this->session->userdata('level'); ?> </p>
                        <?php endif; ?>
                        <img height="550px" src="<?= base_url('assets/images/login/01.png'); ?>">
                     </center>
                  </div>
               </div>
            </div>
            <!-- /Welcome Message -->
        </div>
    </div>