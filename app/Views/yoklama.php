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
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Yoklama Sayfası</h3>

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
                
             <div class="col-lg-1 col-xl-1 col-12">
               <!--- boşluk ---->
               </div>

            
            <div class="col-lg-4 col-xl-4 col-md-12 col-12">
            <section class="content pb-3">
             <div class="container-fluid h-100">
          <div class="card card-row card-info ">
          <div class="card-header">
            <h3 class="card-title">
              Yoklaması Alınacak Programlar
            </h3>
          </div>
          <div class="card-body">

          <?php foreach($alinmamis as $row ): ?>
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"><?php echo $row['program_ad'] ?></h5>
                <div class="card-tools">
                  <a href="<?= base_url("home/gunluk_yoklama_liste_view2/".$row['p_id']."/".$row['program_ad']); ?>" class="btn btn-tool btn-link"><i class="fas fa-clock"></i></a>
                  <a href="<?= base_url("home/gunluk_yoklama_liste_view/".$row['p_id']."/".$row['program_ad']); ?>" class="btn btn-tool">
                    <i class="fas fa-pen"></i>
                  </a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>        
          <!-- Card bitişi -->
          </div>

      </div>
    </section>
</div>
<div class="col-lg-1 col-xl-1 col-12">
               <!--- boşluk ---->
               </div>
            
            <div class="col-lg-4 col-xl-4 col-md-12 col-12">
            <section class="content pb-3">
      <div class="container-fluid h-100">
      
        <div class="card card-row card-secondary ">
          <div class="card-header">
            <h3 class="card-title">
             Yoklaması Alınmış programlar
            </h3>
          </div>
          <div class="card-body">

          <?php foreach($alinmis as $row ): ?>
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"><?php echo $row['program_ad'] ?></h5>
                <div class="card-tools">
                  <a href="<?= base_url("home/gunluk_yoklama_liste_view2/".$row['p_id']."/".$row['program_ad']); ?>" class="btn btn-tool btn-link"><i class="fas fa-clock"></i></a>
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
        <b>Not:</b>Yoklaması alınan program pasif hale geçer.Sonradan geç kalan öğrencileri buradan ekleyebilirsiniz.Yanlışlıkla yok yazılan öğrencileri anasayfadan gerekli program adı seçilerek incele buyonuyla giriş yapılıp silebilirsiniz....
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  <?= $this->include('include/footer') ?>