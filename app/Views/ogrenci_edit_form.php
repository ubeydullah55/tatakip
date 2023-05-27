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

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Öğrenci Düzenleme Sayfası</h3>

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
             
             <form action="<?= base_url('home/ogrenci_update/'.$no) ?>" method="post">
             <div class="row"> 
               <div class="col-2"></div>
             <div class="card card-warning col-8">
            
              <div class="card-header">

                <h3 class="card-title">Öğrenci Düzenle</h3>
              </div>
              <div class="card-body">
                <div class="row">
                             
               <?php foreach ($viewdata as $item) : ?>
                 
                <div class="col-6">
                    <label for="">Öğrenci No</label>
                    <input type="number" name="ogrenci_no" class="form-control" value="<?php echo $item['ogrenci_no']; ?>" disabled>
                  </div>
                  <div class="col-6">
                  <label for="">Grup No</label>
                  <input type="number" name="grup" class="form-control" value="<?= $item['grup']; ?>">
                  </div>
                  <div class="col-6">
                  <label for="">Ad</label>
                    <input type="text" name="ad" class="form-control" value="<?php echo $item['ad']; ?>">
                  </div>
                  
                  <div class="col-6">
                  <label for="">Soyad</label>
                    <input type="text" name="soyad" class="form-control" value="<?php echo $item['soyad']; ?>">
                  </div>
                 
                  <div class="col-6">
                  <label for="">Telefon No</label>
                    <input type="tel" name="tel" class="form-control" value="<?php echo $item['tel']; ?>">
                  </div>
                  <div class="col-6">
                  <label for="">Veli Telefon No</label>
                    <input type="tel" name="v_tel" class="form-control" value="<?php echo $item['v_tel']; ?>">
                  </div>


               <?php endforeach ?>
                 
                
            

                <!-- rowun bitiş kısmı-->  
                </div>
                <br>
                <div>
                <button type="submit" class="btn btn-warning">Güncelle</button>
                </div>
              </div>

              <!-- /.card-body -->
            </div>
            </form>




          <!-- right col -->
        </div>
     

        <!-- /.card-body -->
        <div class="card-footer">
          Burası  öğrenci güncelleme sayfasıdır.
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?= $this->include('include/footer') ?>
  