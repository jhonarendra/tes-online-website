<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'include/head.php'
  ?>

  </head>

  <body id="page-top">

    <?php include 'include/navbar.php' ?>

    <div id="wrapper">

      <!-- Sidebar -->
      <?php include 'include/sidebar_dosen.php'?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Tambah Mahasiswa</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Tambah Mahasiswa</div>
            <div class="card-body">
            <form>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIM</label><br>
                    <input type="text" class="form-control" placeholder="NIM">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap</label><br>
                    <input type="text" class="form-control" placeholder="Nama Lengkap">
                  </div>
                </div>
              </div>  
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Angkatan</label><br>
                    <input type="text" class="form-control" placeholder="Angkatan">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Lahir</label><br>
                    <input type="date" class="form-control" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label><br>
                    <input type="text" class="form-control" placeholder="Alamat">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Wali/Orang Tua</label><br>
                    <input type="text" class="form-control" placeholder="Nama wali/orang tua">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <button class='btn btn-primary' type="submit">
                      <i class="fas fa-save"></i> Simpan
                    </button>
                  </div>
                </div>
                <div class="col-sm-4">
                </div>
              </div>                                                         
            </form>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

  <?php include 'include/footer.php'?>

  </body>

</html>
