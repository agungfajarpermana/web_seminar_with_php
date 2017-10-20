<?php
  require_once "core/init.php";
  require_once "view/header_peserta.php";
  error_reporting(0);

  if(!$_SESSION['user']){
    header("Location: seminar_jadwal.php");
  }else{

  $super_user = $admin = $login = false;
  if($_SESSION['user']){
    $login = true;
    if(cek_status($_SESSION['user']) == 2){
      $super_user = true;
    }

    if(cek_status($_SESSION['user']) == 1){
      $admin = true;
    }
  }

  $error = '';
  $no = 1;
  //Pagination
  $id      = $_GET['id'];
  $perPage = '5';
  $page    = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
  $start   = ($page > 1) ? ($page * $perPage) - $perPage : 0;

  //folder functions
  $peserta = tampilkan_data_peserta($id,$start,$perPage);
  $all     = tampilkan_semua_data_peserta($id);
  $no      = $page + ($page - 1) * ($perPage - 1);

  $pages   = ceil($all/$perPage);

  //cari
  if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
    if($cari != ''){
      $peserta = hasil_cari($id,$cari);
    }else{
      echo "<script>alert('Masukan Nim Anda');</script>";
    }
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
          <?php if($super_user == true) : ?>
            <li><a href="seminar_admin.php" class="active">Dashboard</a></li>
          <?php endif; ?>
          <li><a href="seminar_jadwal.php" class="active">Jadwal Seminar</a></li>
          <li><a href="index.php #wrap-about" class="">Tentang</a></li>
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
        <div class="col-sm-12 col-md-12">
          <h1 class="text-center">Daftar Peserta Seminar</h1>
          <p class="text-center lead">
            Berkenalan dengan peserta seminar kampus dari seluruh kelas universitas pamulang
          </p>
        </div>
        <div class="text-center">
          <a href="seminar_jadwal.php" class="btn btn-default">Kembali</a>
        </div>
      </div>

    </div>
  </div>

  <div class="fluid-action">
    <div class="container" style="margin-top:80px;">
      <div class="row">
        <div class="col-md-6">
          <form action="#form_tambah" method="post" class="navbar navbar-right">
            <div class="form-group">
              <div class="input-group">
                <input type="search" class="form-control input-lg" name="cari" placeholder="cari nim peserta">
                <span class="input-group-addon">
                <input type="submit" class="btn btn-primary btn-xs" name="submit" value="Cari">
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="fluid-center" id="form_tambah" style="margin-top:-80px;">
    <div class="container">
      <div class="panel panel-success">
        <!-- Default panel contents -->
        <?php if($super_user === true || $admin === true): ?>
          <div class="panel-heading">
            <ul class="list-inline">
              <li>
                <h3 class="panel-title" style="margin-left:10px;">
                  <a href="seminar_peserta_pdf.php?id=<?= $id; ?>" class="btn btn-success" style="color:white !important;"><i class="fa fa-print fa-1x" aria-hidden="true"></i></a>
                  Daftar Peserta
                </h3>
              </li>
            </ul>
          </div>
        <?php endif; ?>

        <div class="table-responsive">
          <?php if($_SESSION['user'] === 2 || $_SESSION['user'] === 1) : ?>
            <a href="seminar_peserta_pdf.php?id=<?=$id;?>" class="btn btn-success"><i class="fa fa-print fa-1x" aria-hidden="true"></i> Cetak Data</a>
          <?php endif; ?>
          <table class="table table-hover">
            <thead>
              <tr class="active">
                <th colspan="1" class="text-center">NO</th>
                <th colspan="1" class="text-center">NIM</th>
                <th colspan="1" class="text-center">NAMA</th>
                <th colspan="1" class="text-center">SEMESTER</th>
                <th colspan="1" class="text-center">KELAS</th>
                <th colspan="1" class="text-center">PHONE</th>
                <th colspan="1" class="text-center">KET</th>
                <th colspan="1" class="text-center">FAKULTAS</th>
                <th colspan="1" class="text-center">PRODI</th>
                <th colspan="1" class="text-center">TEMA</th>
                <th colspan="1" class="text-center">STATUS</th>
                <?php if($super_user == true || $admin === true):?>
                <th colspan="1" class="text-center">AKSI</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($peserta)): ?>
              <?php $judul = $row['seminar']; ?>
              <tr class="success">
                <td class="text-center"><?=$no;?></td>
                <td class="text-center"><?= $row['nim']; ?></td>
                <td class="text-center"><?= $row['nama']; ?></td>
                <td class="text-center"><?= $row['semester']; ?></td>
                <td class="text-center"><?= $row['kelas']; ?></td>
                <td class="text-center"><?= $row['telpon']; ?></td>
                <td class="text-center"><?= $row['keterangan']; ?></td>
                <td class="text-center"><?= $row['fakultas']; ?></td>
                <td class="text-center"><?= $row['prodi']; ?></td>
                <td class="col-md-4 text-center"><?= $row['seminar']; ?></td>
                <td class="col-md-2 text-center"><?= $row['status']; ?></td>
                <?php if($super_user == true || $admin === true):?>
                <td class="col-md-2 text-center">
                  <a href="seminar_edit_daftar_peserta.php?id=<?=$row['id_peserta'];?>" class="btn btn-warning btn-sm"><i class="fa fa-trash-o fa-lg"></i> Ubah</a>
                  <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".myModal_<?=$row['id_peserta'];?>"><i class="fa fa-trash-o fa-lg"></i> Hapus</a>
                </td>
                <?php endif; ?>
              </tr>
              <?php $no++; ?>
              <div class="modal fade bs-example-modal-sm myModal_<?=$row['id_peserta'];?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Konfirmasi Hapus !!</h4>
                    </div>
                    <div class="modal-body">
                      <h5>
                        Apakah Anda Yakin Ingin Menghapus Data Ini..??
                      </h5>
                    </div>
                    <div class="modal-footer">
                      <a href="seminar_hapus_peserta.php?del=<?=$row['id_peserta'];?>" class="btn btn-danger">Ya</a>
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
          <li class=""><a href="?id=<?=$id;?>&halaman=<?=($page-1);?>#form_tambah" aria-label="Previous"><span aria-hidden="true">&larr;</span></a></li>
          <?php else: ?>
          <li class="disabled"><a href="#form_tambah" aria-label="Previous"><span aria-hidden="true">&larr;</span></a></li>
          <?php endif; ?>

          <!--Link Number-->
          <?php for($i=1; $i<=$pages; $i++) : ?>
            <?php if((($i >= $page - 4) && ($i <= $page + 4))) { ?>
              <?php if ($i == $page): ?>
                <li class="active"><a href="#form_tambah"><?= $i; ?></a></li>
              <?php else: ?>
                <li class=""><a href="?id=<?= $id; ?>&halaman=<?=$i;?>#form_tambah"><?= $i; ?></a></li>
              <?php endif; ?>
            <?php } ?>
          <?php endfor; ?>

          <!--tombol selanjutnya-->
          <?php if( $page < $pages) : ?>
          <li class=""><a href="?id=<?=$id;?>&halaman=<?=($page+1);?>#form_tambah" aria-label="Next"><span aria-hidden="true">&rarr;</span></a></li>
          <?php else: ?>
          <li class="disabled"><a href="#form_tambah" aria-label="Previous"><span aria-hidden="true">&rarr;</span></a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>

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
</div>

<?php
  require_once "view/footer.php"
?>

<?php } ?>
