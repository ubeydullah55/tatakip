<?= $this->include('include/header') ?>
<?= $this->include('include/leftmenu') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Talebe Yoklama Listesi</h1>
            <?php
            echo date('d/m/Y H:i:s');
            ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">
                 <?php echo $program_ad ;?></h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Geç Kaldı</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($ogrenciler as $item) : ?>
                  <tr>
                    <form action="<?= base_url('home/gecinsert/'.$item['ogrenci_no']."/".$title."/".$item['ad']."/".$item['soyad'])?>" method="post">
                  <td><?= $item['ogrenci_no'] ?></td>
                    <td><?= $item['ad'] ?></td>
                    <td><?= $item['soyad'] ?></td>
                    <td>
                      <input type="number" name="geckalmasuresi" >
                      <button type="submit" class="btn btn-info  "><i class="fa fa-save"></i> Kaydet</button>
                    </td>
                  </tr>
                  </form>
                  <?php endforeach ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>No</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Geç Kaldı</th>
                  </tr>
                  </tfoot>
                  
                </table>
             
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?= $this->include('include/footer2') ?>