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
      <?php include 'include/sidebar.php'?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Tambah Soal</div>
            <div class="card-body">
            <form action="">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-4">
                    <label for="exampleInputEmail1">Jenis Soal</label>
                    <input type="text" class="form-control" placeholder="Jenis Soal">
                  </div>
                  <div class="col-sm-4">
                    <label for="exampleInputEmail1">Tanggal Berakhir</label>
                    <input type="text" class="form-control" placeholder="Tanggal Berakhir Tugas">
                  </div>
                  <div class="col-sm-4">
                    <label for="exampleInputEmail1">Jumlah Soal</label>
                    <input type="text" class="form-control" placeholder="Jumlah Soal" id="input-soal">
                  </div>                
                </div>           
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-8">
                  <label for="exampleFormControlTextarea1">Deskripsi</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>                
                </div>           
              </div>              
            </form>
            <div class="form-group">
                <button class='btn btn-primary' type="submit" id="btn-tambah-soal">
                <i class="fas fa-plus"></i> Tambah Soal
                </button>           
            </div>
            <div class="soal" id="show-soal">
            </div>
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
