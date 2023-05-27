<?= $this->include('include/header') ?>
<?= $this->include('include/leftmenu') ?>
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
       
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(session()->get('info')) : ?>             
              <div class="alert alert-info" role="alert">
                 <?php echo session()->getFlashdata('info'); ?>
              </div>
              <?php endif; ?>

    <?php if(session()->get('danger')) : ?>             
              <div class="alert alert-danger" role="alert">
                 <?php echo session()->getFlashdata('danger'); ?>
              </div>
              <?php endif; ?>        
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Program Ekleme Sayfası</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
             <!-- Formun başlangıcı  -->
             <form action="<?= base_url('home/program_insert'); ?>" method="post">
             <div class="row">  

             <div class="col-lg-4 col-xl-4 col-12">
            <section class="content pb-3">
      <div class="container-fluid h-100">
      
        <div class="card card-row card-olive ">
          <div class="card-header">
            <h3 class="card-title">
              Program Ekleme
            </h3>
          </div>
          <div class="card-body">
            <label for="">Program Adı</label>
            <input type="text" name="program_ad" class="form-control"  required>                  
            <div>
            
                <br>
            <button type="submit" class="btn btn-outline-success">Program Ekle</button>
            <input type="checkbox"  name="muzakere" value="1">
            <label for="vehicle1">Müzakere ise işaretleyiniz</label><br>
                </div>
                  </div>
                  <br>
              
          <!-- Card bitişi -->
          </div>

      </div>
    </section>
            </div>
            </form>

            
            <div class="col-lg-4 col-xl-4 col-12">
            <section class="content pb-3">
             <div class="container-fluid h-100">
          <div class="card card-row card-info ">
          <div class="card-header">
            <h3 class="card-title">
              Aktif Programlar
            </h3>
          </div>
          <div class="card-body">

          <?php foreach($aktif_program as $row ): ?>
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"><?php echo $row['program_ad'] ?></h5>
                <div class="card-tools">
                  <a href="<?= base_url("home/program_pasif/".$row['p_id']."/".$row['program_ad']); ?>" class="btn btn-tool btn-link"><i class="fa fa-lock" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>         
          <!-- Card bitişi -->
          </div>

      </div>
    </section>
</div>

            
            <div class="col-lg-4 col-xl-4 col-12">
            <section class="content pb-3">
      <div class="container-fluid h-100">
      
        <div class="card card-row card-secondary ">
          <div class="card-header">
            <h3 class="card-title">
              Pasif Programlar
            </h3>
          </div>
          <div class="card-body">

          <?php foreach($pasif_program as $row ): ?>
            <div class="card card-secondary card-outline">
              <div class="card-header">
                <h5 class="card-title"><?php echo $row['program_ad'] ?></h5>
                <div class="card-tools">
                  <a href="<?= base_url("home/program_active/".$row['p_id']."/".$row['program_ad']); ?>" class="btn btn-tool btn-link"><i class="fa fa-unlock-alt" aria-hidden="true"></i></a>
                  <a href="<?= base_url("home/program_delete/".$row['p_id']."/".$row['program_ad']); ?>" onclick="return confirm('Bu dersi silerseniz kaydedilen verileride silinecektir...')" class="btn btn-tool btn-link"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>         
          <!-- Card bitişi -->
          </div>

      </div>
    </section>
            </div>
          <!-- right col -->
        </div>
     

        <!-- /.card-body -->
        <div class="card-footer">       
        <b>Not:</b> Bir dersi pasife aldığınız taktirde günlük yoklamalarda görülmeyecektir.Lakin o derse ait verilerde kaybolmayacaktır.Tekrar aktif ettiğiniz durumda günlük yoklamada gözükmeye devam edecektir.
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?= $this->include('include/footer') ?>
  