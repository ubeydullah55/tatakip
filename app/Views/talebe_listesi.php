<?= $this->include('include/header') ?>
<?= $this->include('include/leftmenu') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper kanban">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
        <div class="col-4">
            
          </div>
          
          <div class="col-4">
          <?php if(session()->get('success')) : ?>             
              <div class="alert alert-success" role="alert">
                 <?php echo session()->getFlashdata('success'); ?>
              </div>
              <?php endif; ?>
    
      <?php if(session()->get('danger')) : ?>             
              <div class="alert alert-danger" role="alert">
                 <?php echo session()->getFlashdata('danger'); ?>
              </div>
              <?php endif; ?>  
          </div>
         
          <div class="col-4">
           
          </div>
        </div>
      </div>
    </section>

    <section class="content pb-3">
      <div class="container-fluid h-100">
        
        <div class="card card-row card-warning ">
          <div class="card-header">
            <h3 class="card-title" style="color:white;">
              Talebe Düzenleme Listesi
            </h3>
          </div>
                  
            <div class="card-body">
            <?php foreach ($viewdata as $item) : ?>
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h5 class="card-title"><?= $item['ad']." ".$item['soyad'] ?></h5>
                <div class="card-tools">
               
                  <a href="<?= base_url('home/update_view_ogrenci/'.$item['ogrenci_no']); ?>"  class="btn btn-tool">
                    <i class="fas fa-pen"></i>
                  </a>
            
                  <a href="<?= base_url('home/ogrenci_delete/'.$item['ogrenci_no']); ?>" onclick="return confirm('Silmek istediğinize eminmisiniz?')" class="btn btn-tool">
                    <i class="fas fa-trash"></i>
                  </a>
                </div>
              </div>
              </div>
          <?php endforeach ?>
          
            </div>
            
          <!-- Card bitişi -->
          
         
        
        
    
        
      </div>
    </section>
  </div>

  <?= $this->include('include/footer') ?>