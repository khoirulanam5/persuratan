<!-- Sidebar -->
<div class="iq-sidebar rtl-iq-sidebar sidebar-default">
        <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
            <a href="<?= base_url('dashboard') ?>" class="header-logo">
                <img src="<?= base_url('assets/images/loading.png') ?>" class="img-fluid rounded-normal light-logo" alt="logo">
                <img src="<?= base_url('assets/images/loading.png') ?>" class="img-fluid rounded-normal darkmode-logo" alt="logo">
            </a>
            <div class="ml-3 logo-text">
                <p class="mt-2 mb-0 font-weight-bold">Inspektorat</p>
                <p class="text-muted small">Kabupaten Kudus</p>
            </div>
            <div class="iq-menu-bt-sidebar">
                <i class="las la-bars wrapper-menu"></i>
            </div>
        </div>
        <div class="data-scrollbar" data-scroll="1">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="<?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard') ?>"><i class="las la-home"></i><span>Dashboard</span></a>
                    </li>

                    <?php if ($this->session->userdata('level') == 'ADMIN'): ?>
                        <li class="<?= $this->uri->segment(2) == 'jenis_surat' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/jenis_surat') ?>"><i class="las la-archive"></i><span>Jenis Surat</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'surat_masuk' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/surat_masuk') ?>"><i class="las la-envelope-open-text"></i><span>Surat Masuk</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'surat_keluar' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/surat_keluar') ?>"><i class="las la-envelope-open"></i><span>Surat Keluar</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'rekap_surat' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/rekap_surat') ?>"><i class="las la-archive"></i><span>Rekap Surat</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'pegawai' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/pegawai') ?>"><i class="las la-users"></i><span>Data Pegawai</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'user' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/user') ?>"><i class="las la-user"></i><span>Data User</span></a>
                        </li>
                    <?php endif; ?>

                    <?php if ($this->session->userdata('level') == 'PEGAWAI'): ?>
                        <li class="<?= $this->uri->segment(2) == 'surat_masuk' ? 'active' : '' ?>">
                            <a href="<?= base_url('pegawai/surat_masuk') ?>"><i class="las la-envelope-open-text"></i><span>Surat Masuk</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'surat_keluar' ? 'active' : '' ?>">
                            <a href="<?= base_url('pegawai/surat_keluar') ?>"><i class="fas fa-envelope-open"></i><span> Proses Surat Keluar</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'user' ? 'active' : '' ?>">
                            <a href="<?= base_url('pegawai/user') ?>"><i class="las la-user"></i><span>Data User</span></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>