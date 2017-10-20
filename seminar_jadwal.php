<?php
  require_once "core/init.php";
  require_once "view/header_jadwal.php";
  error_reporting(0);

  $super_user = $super_admin = $admin = $login = false;
  if($_SESSION['user']){
    $login = true;
    if(cek_status($_SESSION['user']) == 2){
      $super_user = true;
      $super_admin = true;
      $jadwal_seminar_admin  = tampilkan();
    }

    if(cek_status($_SESSION['user']) == 1){
      $admin = true;
    }
  }

  //harusnya bisa di refactor
  $users = $_SESSION['user'];
  $seminar = tampilkan_seminar($users);
  while ($row = mysqli_fetch_assoc($seminar)) {
    $fakultas = $row['fakultas'];
    $prodi    = $row['prodi'];
  }
  $seminar1 = tampilkan_seminar_admin($users);
  while ($row = mysqli_fetch_assoc($seminar1)) {
    $fakultas = $row['fakultas'];
    $prodi    = $row['prodi'];
  }

  $jadwal_seminar = tampilkan_per_fakultas($prodi);
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
            <li><a href="seminar_admin.php">Dashboard</a></li>
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
        <div class="col-sm-6 col-md-6">
          <h1>Jadwal Seminar</h1>
          <p class="text-justify lead">
            silahkan anda pilih tema seminar seperti apa yang anda cari dan inginkan
          </p>

          <?php if($super_user ==  true) : ?>
          <a href="seminar_tambah.php" class="btn btn-default">
            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
            Tambah Jadwal Seminar
          </a>

          <a href="seminar_all_jadwal.php" class="btn btn-default">
            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
            Daftar Jadwal Seminar
          </a>
          <?php elseif ($admin == true) :?>
          <a href="seminar_tambah.php" class="btn btn-default">
            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
            Tambah Jadwal Seminar
          </a>

          <a href="seminar_all_jadwal.php" class="btn btn-default">
            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
            Daftar Jadwal Seminar
          </a>
          <?php else: ?>
          <a href="seminar_all_jadwal.php" class="btn btn-default">
            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
            Daftar Jadwal Seminar
          </a>
          <?php endif; ?>
        </div>

        <div class="col-sm-offset-1 col-sm-4 col-md-offset-2 col-md-4 collapse navbar-collapse">
          <img src="image/image-tableseminar/schedule.png" alt="seminar" class="img-responsive center-block" width="270px" />
        </div>
      </div>

    </div>
  </div>

  <div class="fluid-action">
    <div class="container" style="margin-top:30px;">
      <!--<div class="row">
        <div class="col-md-6">
          <form class="navbar navbar-right">
            <div class="form-group">
              <div class="input-group">
                <input type="search" class="form-control input-lg" name="cari" placeholder="cari judul seminar">
                <span class="input-group-addon">
                  <input type="submit" class="btn btn-primary btn-xs" name="submit" value="Cari">
                </span>
              </div>
            </div>
          </form>
        </div>

        <div class="col-md-6">
          <p class="btn-collapse" data-toggle="collapse" data-target="#collapseBody">
            Filter Tag
          </p>
          <div class="collapse" id="collapseBody">
            <div class="collapse-body">
              <form class="" action="#" method="post">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#">Tampilkan Semua Data</a></li>
                  <li><a href="#">Teknologi</a></li>
                  <li><a href="#">Pendidikan</a></li>
                  <li><a href="#">Budaya</a></li>
                  <li><a href="#">Bebas</a></li>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>-->
    </div>
  </div>

  <div class="fluid-center" id="fluid-center" style="margin-top:-60px;">
    <div class="container">
      <!--Menguji Apakah Yang Login Super Admin ? (Maka Tampilkan Semua Daftar Seminar)-->
    <?php if($super_admin == true) : ?>
      <?php while ($row = mysqli_fetch_assoc($jadwal_seminar_admin)): ?>
      <?php
        $date = date_create($row['tanggal']);
        $new_date = date_format($date, 'd M Y');
        $id_ = $row['id_seminar'];
      ?>
      <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2">
          <p class="text-center"><?= $new_date; ?></p>
        </div>

        <div class="col-xs-10 col-sm-4 col-md-2">
          <a href="#" class="banner" data-toggle="modal" data-target="#myModal_<?=$row['id_seminar'];?>">
            <img src="image/image/<?= $row['gambar']; ?>" class="img-thumbnail img-responsive" alt="seminar" max-width="80%" />
          </a>
        </div>

        <div class="col-xs-offset-2 col-xs-10 col-sm-offset-0 col-sm-6 col-md-8">
          <h3 id="modal-info" data-id="<?= $row['id_seminar']; ?>">
            <a href="#" class="head-title" data-toggle="modal" data-target=".modal-spesifik">
              <?= $row['seminar']; ?>
            </a>
          </h3>

          <div class="row">
          <div class="col-md-5">
            <div class="panel panel-default">
              <div class="panel-body">
                <h5 class="panel-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Lokasi</h5>
                <h5 class="core-lokasi"><?= $row['lokasi']; ?></h5>
              </div>
              <div class="panel-footer">
                <span class="kategori"><strong>Prodi : </strong></span> <span class="label label-danger"><?= $row['prodi']; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <?php if($super_user == true) : ?>
              <a href="seminar_edit.php?id=<?= $row['id_seminar']; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil fa-fw"></i> Ubah</a>
              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".myModal_<?=$row['id_seminar'];?>"><i class="fa fa-trash-o fa-lg"></i> Hapus</a>
            <?php endif; ?>
            <?php if($admin == true) : ?>
              <a href="seminar_edit.php?id=<?= $row['id_seminar']; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil fa-fw"></i> Ubah</a>
              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".myModal_<?=$row['id_seminar'];?>"><i class="fa fa-trash-o fa-lg"></i> Hapus</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div><hr><br>
    <!-- Modal -->
    <div class="modal fade" id="myModal_<?=$row['id_seminar'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <img src="image/image/<?= $row['gambar']; ?>" class="img-thumbnail img-responsive" alt="" max-width="80%"/>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-sm myModal_<?=$row['id_seminar'];?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi Hapus !!</h4>
          </div>
          <div class="modal-body">
            <h5>
              Apakah Anda Yakin Ingin Menghapus Data Ini..?? <br>
              Jika Anda Hapus Data Seminar <span style="color:red;"> <?= $row['seminar']; ?> </span> <br> Maka Data Seluruh Peserta Juga Akan Terhapus..!!
            </h5>
          </div>
          <div class="modal-footer">
            <a href="seminar_hapus.php?id=<?= $row['id_seminar']; ?>" class="btn btn-danger">Ya</a>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  <?php else : ?>
      <?php while ($row = mysqli_fetch_assoc($jadwal_seminar)): ?>
      <?php
        $date = date_create($row['tanggal']);
        $new_date = date_format($date, 'd M Y');
      ?>
      <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2">
          <p class="text-center"><?= $new_date; ?></p>
        </div>

        <div class="col-xs-10 col-sm-4 col-md-2">
          <a href="#" class="banner" data-toggle="modal" data-target="#myModal_<?=$row['id_seminar'];?>">
            <img src="image/image/<?= $row['gambar']; ?>" class="img-thumbnail img-responsive" alt="seminar" max-width="80%" />
          </a>
        </div>

        <div class="col-xs-offset-2 col-xs-10 col-sm-offset-0 col-sm-6 col-md-8">
          <h3 id="modal-info" data-id="<?= $row['id_seminar']; ?>">
            <a href="#" class="head-title" data-toggle="modal" data-target=".modal-spesifik">
              <?= $row['seminar']; ?>
            </a>
          </h3>

          <div class="row">
          <div class="col-md-5">
            <div class="panel panel-default">
              <div class="panel-body">
                <h5 class="panel-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Lokasi</h5>
                <h5 class="core-lokasi"><?= $row['lokasi']; ?></h5>
              </div>
              <div class="panel-footer">
                <span class="kategori"><strong>Prodi : </strong></span> <span class="label label-danger"><?= $row['prodi']; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <?php if($super_user == true) : ?>
              <a href="seminar_edit.php?id=<?= $row['id_seminar']; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil fa-fw"></i> Ubah</a>
              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".myModal_<?=$row['id_seminar'];?>"><i class="fa fa-trash-o fa-lg"></i> Hapus</a>
            <?php endif; ?>
            <?php if($admin == true) : ?>
              <a href="seminar_edit.php?id=<?= $row['id_seminar']; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil fa-fw"></i> Ubah</a>
              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".myModal_<?=$row['id_seminar'];?>"><i class="fa fa-trash-o fa-lg"></i> Hapus</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div><hr><br>
    <!-- Modal -->
    <div class="modal fade" id="myModal_<?=$row['id_seminar'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <img src="image/image/<?= $row['gambar']; ?>" class="img-thumbnail img-responsive" alt="" max-width="80%"/>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-sm myModal_<?=$row['id_seminar'];?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi Hapus !!</h4>
          </div>
          <div class="modal-body">
            <h5>
              Apakah Anda Yakin Ingin Menghapus Data Ini..?? <br>
              Jika Anda Hapus Data Seminar <span style="color:red;"> <?= $row['seminar']; ?> </span> <br> Maka Data Seluruh Peserta Juga Akan Terhapus..!!
            </h5>
          </div>
          <div class="modal-footer">
            <a href="seminar_hapus.php?id=<?= $row['id_seminar']; ?>" class="btn btn-danger">Ya</a>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  <?php endif; ?>
<!--Akhir Pengujian Login Super Admin-->

    <div class="modal fade modal-spesifik"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="total">
          <!--Seminar_modalBox.php-->
        </div>
      </div>
    </div>

    <!--<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
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
            <a href="seminar_hapus.php?id=<?= $id_; ?>" class="btn btn-danger">Ya</a>
          </div>
        </div>
      </div>
    </div>-->

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
