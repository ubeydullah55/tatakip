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

    <?php if(session()->get('warning')) : ?>             
    <div class="alert alert-warning" role="alert">
       <?php echo session()->getFlashdata('warning'); ?>
    </div>
     <?php endif; ?>      
    
     <?php if(session()->get('success')) : ?>             
    <div class="alert alert-success" role="alert">
       <?php echo session()->getFlashdata('success'); ?>
    </div>
     <?php endif; ?>   
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Çarşı İzini Yoklama Sayfası</h3>

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
           
             <div class="row">  
                
            

            
            <div class="col-lg-5 col-xl-5 col-md-12 col-12">
            <section class="content pb-3">
             <div class="container-fluid h-100">
          <div class="card card-row card-info ">
          <div class="card-header">
            <h3 class="card-title">
              Talebeler
            </h3>
          </div>
          <div class="card-body">

          <?php foreach($yurtta as $row ): ?>
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"><?php echo $row['ad']." ".$row['soyad'] ?></h5>
                <div style="text-align:right;"><form action="<?= base_url("home/carsi_insert/".$row['ogrenci_no']."/1"."/escinsert"); ?>" method="get">
                 <input type="text"  name="aciklama" style="width: 35%;">           
                <button type="submit" class="btn btn-tool btn-link"> <i class="fas fa-play"></i></button>
              </form>
            </div> 
                <div class="card-tools">
                  
                </div>
              </div>
            </div>
            <?php endforeach; ?>        
          <!-- Card bitişi -->
          </div>

      </div>
    </section>
</div>

            <div class="col-lg-4 col-xl-4 col-md-12 col-12">
            <section class="content pb-3">
      <div class="container-fluid h-100">
      
        <div class="card card-row card-danger ">
          <div class="card-header">
            <h3 class="card-title">
             Çarşıdaki Talebeler
            </h3>
          </div>
          <div class="card-body">

          <?php foreach($izinde as $row ): ?>
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="card-title"><?php echo $row['ad']." ".$row['soyad'] ?></h5>
                <div class="card-tools">
                  <a href="<?= base_url("home/carsi_insert/".$row['ogrenci_no']."/2"."/openinsert"); ?>" class="btn btn-tool btn-link"><i class="fas fa-play"></i></a>
                  <a href="<?= base_url("home/carsi_insert/".$row['ogrenci_no']."/0"."/escupdate"); ?>" class="btn btn-tool btn-link"><i class="fas fa-undo"></i></a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>         
          <!-- Card bitişi -->
          </div>

      </div>
    </section>
            </div>


            <div class="col-lg-3 col-xl-3 col-md-12 col-12">
            <section class="content pb-3">
      <div class="container-fluid h-100">
      
        <div class="card card-row card-success ">
          <div class="card-header">
            <h3 class="card-title">
             İzinden Dönen Talebeler
            </h3>
          </div>
          <div class="card-body">

          <?php foreach($gelmis as $row ): ?>
            <div class="card card-success card-outline">
              <div class="card-header">
                <h5 class="card-title"><?php echo $row['ad']." ".$row['soyad'] ?></h5>              
                <div class="card-tools">
                  <a href="<?= base_url("home/carsi_insert/".$row['ogrenci_no']."/1"."/openupdate"); ?>" class="btn btn-tool btn-link"><i class="fas fa-undo"></i></a>
                  <a href="<?= base_url("home/carsi_insert/".$row['ogrenci_no']."/0"."/openfinish"); ?>" onclick="return confirm('Oğrenci girişi kesinleştirilecektir eminmisiniz?')" class="btn btn-tool btn-link"><i class="fas fa-stop"></i></a>
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
        <b>Not:</b>Çarşı izinine çıkacak öğrencileri sol tablodan seçip yan kısımdaki butona basınız.Çarşıdan gelen öğrenciler içinse sağ taraftaki tablodan seçip yanındaki butona basınız...
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  <?= $this->include('include/footer') ?>