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
                 <?php echo $title ;?></h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr class="row2">                
                    <th  class="col-1">Öğrenci No</th>
                    <th  class="col-5">Ad</th>
                    <th  class="col-4">Soyad</th>
                    <th  class="col-2">İncele</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($ogrencidengelen as $item) : ?>
                  <tr>
                    <td style="text-align:center;"><?= $item[0]->ogrenci_no ?></td>
                    <td><?= $item[0]->ad ?></td>
                    <td><?= $item[0]->soyad ?></td>
                    <td><a href="<?= base_url('home/kisisel_Analiz/'.$item[0]->ogrenci_no) ?>"><button type="submit" class="btn btn-block btn-outline-success btn-sm" ><i class="fa fa-save"></i> Kişisel Analiz</button></a></td>
                  </tr>   
                  <?php endforeach ?>
                  </tbody>
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
  <?= $this->include('include/footer') ?>