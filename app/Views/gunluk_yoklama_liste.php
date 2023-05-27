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
                <h3 class="card-title"> <?php echo $program_ad ;?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="<?= base_url('home/genelyoklama/'.$title)?>" method="POST">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Gelmedi</th>
                    <th>İzinli</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                  <?php foreach ($ogrenciler as $item) : ?>
                  <tr>
                    <td><?= $item['ogrenci_no'] ?></td>
                    <td><?= $item['ad'] ?></td>
                    <td><?= $item['soyad'] ?></td>
                    <td>       
                      <div class="form-check">                     
                          <input  style="" class="form-check-input" type="checkbox" name="gelmedi[]" value="<?= $item['ogrenci_no'] ?>">                         
                        </div>
                      </td>
                      <td>
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="izinli[]" value="<?= $item['ogrenci_no'] ?>">
                        </div>
                      </td>                       
                  </tr>
                  <?php endforeach ?>
                  </tbody>                 
                </table>    
                <div class="row">
                <div class="col-4"></div>
                <button type="submit" class="btn btn-info btn-block btn-flat col-4"><i class="fa fa-save"></i> Kaydet</button>
              </div>
              <div class="col-4"></div>
              </div>
              </form>
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