<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title><?= $title ?></title>
   <link rel="stylesheet" href="<?= base_url('assets/AdminLTE.min.css') ?>">
   <link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <link rel="shortcut icon" href="../images/logo.png" />
   <style type="text/css">
      body {
         margin: 30px;
         margin-top: 70px;
         margin-left: 50px;
         margin-right: 50px;
         font-family: Arial, sans-serif;
      }
      .header-container {
         display: flex;
         align-items: center; /* Menyelaraskan elemen secara vertikal */
         justify-content: space-between; /* Memberikan jarak antara logo dan teks */
         margin-bottom: 20px;
         margin-top: 50px;
      }
      .header-logo {
         height: 120px; /* Tinggi logo */
         margin-left: 10px; /* Geser logo ke kanan dengan jarak 50px */
      }
      .header-text {
         text-align: center; /* Teks berada di tengah */
         margin: 0 auto; /* Menjaga agar teks tetap di tengah */
         width: 100%; /* Pastikan teks tidak melewati batas */
         margin-right: 20px; /* Menggeser teks ke kiri dengan mengurangi margin kanan */
      }
      .in {
         margin-top: -12px;
      }
      .mytable {
         width: 100%;
         border: none;
      }
   </style>
</head>
<body class="sidebar-mini skin-blue fixed sidebar">
   <div class="row" style="text-align: justify; text-justify: inter-word;">
      <div class="col-xs-1"></div>
      <div class="col-xs-10">
         <div class="box">
            <!-- Header Section -->
            <div class="box-header">
               <div class="box-body">
                  <div class="header-container">
                     <!-- Logo -->
                     <div>
                        <img src="<?= base_url('assets/images/loading.png') ?>" class="header-logo">
                     </div>
                     <!-- Teks Program Studi -->
                     <div class="header-text">
                        <h4><b>INSPEKTORAT DAERAH <br>
                              KABUPATEN KUDUS<br>
                              JAWA TENGAH</b>
                        </h4>
                        <p class="in">Alamat: Komplek Perkantoran Kudus, Jl. Mejobo No.35, Area Sawah, Mlati Lor, 
                           Kec. Kota Kudus, Kabupaten Kudus, Jawa Tengah 59319 <br>
                           Telepon: (0291) 437127
                        </p>
                     </div>
                  </div>
                  <hr style="border: 1px solid; margin-bottom: -17px;">
                  <hr style="border: 2px solid #000000; border-radius: 2px;">
               </div>
            </div>
            <br>

            <!-- Surat Content -->
            <div class="box-body scrollmenu">
               <div style="float: right; text-align: center;">
                  Kudus, <?= do_formal_date($surat->tgl_kirim) ?>
               </div>
               <table class="mytable">
                  <colgroup>
                     <col width="20%">
                     <col width="70%">
                  </colgroup>
                  <tbody>
                     <tr>
                        <td>No</td>
                        <td>: <?= $surat->id_surat_keluar ?></td>
                     </tr>
                     <tr>
                        <td>Lamp</td>
                        <td>: -</td>
                     </tr>
                     <tr>
                        <td>Hal</td>
                        <td>: <?= $surat->perihal ?></td>
                     </tr>
                     <tr>
                        <td>Tujuan</td>
                        <td>: <?= $surat->tujuan ?></td>
                     </tr>
                  </tbody>
               </table>
               <br>
               <?= $surat->isi_surat ?>
            </div>
            <br>

            <!-- Signature Section -->
            <div class="row">
               <div class="col-md-4">
                  <div style="float: right; text-align: center;">
                     KEPALA INSPEKTORAT <br><br><br><br><br>
                     <b><u><?= $surat->pengirim ?></u></b>
                     <p>NIP. <?= $surat->id_user ?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script type="text/javascript">
      window.print();
   </script>
</body>
</html>
