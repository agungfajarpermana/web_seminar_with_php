<?php
  require_once "core/init.php";
  require_once "view/header_daftar_admin.php";
  error_reporting(0);

  $super_user = $login = false;
  if($_SESSION['user']){
    $login = true;
    if(cek_status($_SESSION['user']) == 1){
      $super_user = true;
    }
  }

  //Pagination
  $perPage = '3';
  $page    = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
  $start   = ($page > 1) ? ($page * $perPage) - $perPage : 0;

  //folder functions
  $daftar_admin   = tampilkan_admin($start,$perPage);
  $all_data_admin = tampilkan_data_admin();
  $no = $page + ($page - 1) * ($perPage - 1);

  $pages   = ceil($all_data_admin/$perPage);

  //pencarian(search)
  if(isset($_GET['cari'])){
    $cari = $_GET['cari'];

    if($cari != ''){
      $daftar_admin = tampilkan_hasil_cari($cari,$start,$perPage);
      $all_data_admin = tampilkan_total_admin($cari);
    }else{
      $pages   = ceil($all_data_admin/$perPage);
    }

    $pages   = ceil($all_data_admin/$perPage);
  }

  if(isset($_GET['tag'])){
    $tag = $_GET['tag'];
    if($tag != ''){
      $daftar_admin = tampilkan_data_by($tag,$start,$perPage);
      $all_data_admin = tampilkan_data_admin_by($tag);
    }else{
      $pages   = ceil($all_data_admin/$perPage);
    }
    $pages   = ceil($all_data_admin/$perPage);
  }
?>

<div class="menu">

  <nav class="navbar navbar-default">
    <div class="container">

      <div class="navbar-header" style="height:80px","padding:10px">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-hide" style="margin-top:22px">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="index.php" class="navbar-brand btn-home" style="padding:10px">
          <img src="image/image-login/logo.png" class="img-rounded img-responsive" alt="Brand" width="60px"/>
        </a>
      </div>

      <div class="collapse navbar-collapse" id="menu-hide">
        <ul class="nav navbar-right navbar-nav list-menu" style="margin-top:10px">
          <li><a href="seminar_jadwal.php" class="active">Jadwal Seminar</a></li>
          <li><a href="seminar_admin.php" class="active">Tambah Admin</a></li>
          <!--<li><a href="seminar_admin_peserta.php" class="active">Tambah Peserta</a></li>-->
          <li><a href="seminar_daftar_admin.php" class="active">Daftar Admin</a></li>
          <!--<li><a href="seminar_daftar_peserta.php" class="active">Daftar Peserta</a></li>-->
          <?php if($login == true) : ?>
          <li><a href="seminar_logout.php" class="#">Logout</a></li>
          <?php else: ?>
          <li><a href="seminar_login.php" class="#">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="fluid-header">
    <div class="container">
      <div class="row rows">
        <div class="col-sm-6 col-md-6">
          <h1>Halaman Daftar Admin</h1>
        </div>

        <div class="col-sm-offset-1 col-sm-4 col-md-offset-2 col-md-4 collapse navbar-collapse">
          <img src="image/image-tableseminar/schedule.png" alt="seminar" class="img-responsive center-block" width="270px" />
        </div>
      </div>

    </div>
  </div>

  <div class="fluid-action">
    <div class="container" style="margin-top:30px;">

      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
          <form action="#fluid-center" method="get" class="navbar navbar-right">
            <div class="form-group">
              <div class="input-group">
                <input type="search" class="form-control input-lg" name="cari" placeholder="Pencarian Dengan Nama">
                <span class="input-group-addon">
                  <input type="submit" class="btn btn-primary btn-xs" name="submit" value="Cari">
                </span>
              </div>
            </div>
          </form>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
          <p class="btn-collapse" data-toggle="collapse" data-target="#collapseBody">
            Filter By Prodi
          </p>
          <div class="collapse" id="collapseBody">
            <div class="collapse-body">
              <form class="" action="#" method="post">
                <ul class="nav nav-pills nav-stacked" style="height:150px; overflow:auto;">
                  <li><a href="seminar_daftar_admin.php">Tampilkan Semua Data</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=T. Elektro [S1]">T. Elektro [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=T. Mesin [S1]">T. Mesin [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=T. Kimia [S1]">T. Kimia [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=T. Industri [S1]">T. Industri [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=T. Informatika [S1]">T. Informatika [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Akutansi [D3]">Akutansi [D3]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Akutansi [S1]">Akutansi [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Sekretaris [D3]">Sekretaris [D3]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Manajemen [S1]">Manajemen [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Magister Manajemen [S2]">Magister Manajemen [S2]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Ilmu Hukum [S1]">Ilmu Hukum [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Magister Hukum [S2]">Magister Hukum [S2]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Matematika [S1]">Matematika [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Sastra Indonesia [S1]">Sastra Indonesia [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Sastra Inggris [S1]">Sastra Inggris [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Pendidikan Ekonomi [S1]">Pendidikan Ekonomi [S1]</a></li>
                  <li><a href="seminar_daftar_admin.php?tag=Pendidikan Pancasila dan Kewarganegaraan [S1]">Pendidikan Pancasila dan Kewarganegaraan [S1]</a></li>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="fluid-center" id="fluid-center" style="margin-top:-80px;">

    <div class="container">
      <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-heading">
          <ul class="list-inline">
            <li>
              <h3 class="panel-title" style="margin-left:10px;">
                <a href="seminar_daftar_admin_pdf.php" class="btn btn-success" style="color:white !important;"><i class="fa fa-print fa-1x" aria-hidden="true"></i></a>
                Daftar Admin
              </h3>
            </li>
          </ul>
        </div>

        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr class="active">
                <th colspan="1" class="text-center">NO</th>
                <th colspan="1" class="text-center">NAMA</th>
                <th colspan="1" class="text-center">EMAIL</th>
                <th colspan="1" class="text-center">TELEPON</th>
                <th colspan="1" class="text-center">FAKULTAS</th>
                <th colspan="1" class="text-center">PRODI</th>
                <th colspan="1" class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($daftar_admin)) :?>
              <tr class="success">
                <td class="text-center"><?= $no; ?></td>
                <td class="col-md-2 text-center"><?= $row['nama']; ?></td>
                <td class="col-md-1 text-center"><?= $row['email']; ?></td>
                <td class="text-center"><?= $row['telpon']; ?></td>
                <td class="text-center"><?= $row['fakultas']; ?></td>
                <td class="text-center"><?= $row['prodi']; ?></td>
                <td class="col-md-3 text-center">
                  <a href="seminar_edit_admin.php?id=<?= $row['id_admin']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-fw"></i> Ubah</a>
                  <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-trash-o fa-lg"></i> Hapus</a>
                </td>
              </tr>
              <?php $no++; ?>
              <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Konfirmasi Hapus !!</h4>
                    </div>
                    <div class="modal-body">
                      <h5>Apakah Anda Yakin Ingin Menghapus Data Ini.. ??</h5>
                    </div>
                    <div class="modal-footer">
                      <a href="seminar_hapus_admin.php?del=<?= $row['id_admin']; ?>" class="btn btn-danger">Ya</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="text-center">
        <ul class="pagination">
          <!--tombol Sebelum-->
          <?php if( $page > 1) : ?>
            <li class=""><a href="?halaman=<?=($page-1 . '' . '&cari=' . '' . $cari . '' . '&tag=' . '' . $tag);?>#fluid-center" aria-label="Previous"><span aria-hidden="true">&larr;</span></a></li>
          <?php else: ?>
            <li class="disabled"><a href="#fluid-center" aria-label="Previous"><span aria-hidden="true">&larr;</span></a></li>
          <?php endif; ?>

          <!--Link Number-->
          <?php for($i=1; $i<=$pages; $i++) : ?>
            <?php if((($i >= $page - 4) && ($i <= $page + 4))) { ?>
              <?php if ($i == $page): ?>
                <li class="active"><a href="#fluid-center"><?= $i ?></a></li>
              <?php else: ?>
                <li class=""><a href="?halaman=<?= $i . '' . '&cari=' . '' . $cari . '' . '&tag=' . '' . $tag?>#fluid-center"><?= $i ?></a></li>
              <?php endif; ?>
            <?php } ?>
          <?php endfor; ?>

          <!--tombol selanjutnya-->
          <?php if( $page < $pages) : ?>
            <li class=""><a href="?halaman=<?=($page+1 . '' . '&cari=' . '' . $cari . '' . '&tag=' . '' . $tag);?>#fluid-center" aria-label="Next"><span aria-hidden="true">&rarr;</span></a></li>
          <?php else: ?>
            <li class="disabled"><a href="#fluid-center" aria-label="Previous"><span aria-hidden="true">&rarr;</span></a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div><!-- Akhir Container-->

  </div><!-- Akhir Fluid-center-->

  <div class="wrap-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-6">
          <p>
            &copy aldi gunawan 2017
          </p>
        </div>

        <div class="col-sm-6 col-md-6">
          <p class="text-right">
            [ ] dengan <span>❤</span> di tangerang selatan
          </p>
        </div>
      </div>
    </div>
  </div>

</div><!-- Akhir div class Menu-->

<?php
  require_once "view/footer.php"
?>
