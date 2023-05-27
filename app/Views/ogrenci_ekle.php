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
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Öğrenci Ekleme Sayfası</h3>

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
             <form action="<?= base_url('home/ogrenci_insert'); ?>" method="post">
             <div class="row"> 
               <div class="col-2"></div>
             <div class="card card-success col-8">
            
              <div class="card-header">     
                <h3 class="card-title">Öğrenci Ekle</h3>
              </div>
              <div class="card-body">
                <div class="row">
             
                <div class="col-6">
                  <label for="">Öğrenci No</label>
                    <input type="number" name="ogrenci_no" class="form-control" placeholder="Öğrenci No'su diğer öğrencilerle aynı olmamalıdır" required>
                  </div>
                  <div class="col-6">
                  <label for="">Grup No</label>
                  <input type="number" name="grup" class="form-control" placeholder="Öğrenci Müzakerede kaçıncı Grupta" required>
                  </div>
                  <div class="col-6">
                  <label for="">Ad</label>
                    <input type="text" name="ad" class="form-control" placeholder="İsim giriniz...." required>
                  </div>
                  
                  <div class="col-6">
                  <label for="">Soyad</label>
                    <input type="text" name="soyad" class="form-control" placeholder="Soyisim giriniz...." required>
                  </div>
                 
                  <div class="col-6">
                  <label for="">Telefon No</label>
                    <input type="tel" name="tel" class="form-control" placeholder="Öğrencinin kendi telefon numarası">
                  </div>
                  <div class="col-6">
                  <label for="">Veli Telefon No</label>
                    <input type="tel" name="v_tel" class="form-control" placeholder="Acil durumlarda ulaşmak için veli tel no">
                  </div>
                     
                  

            
                  

                  


                <!-- rowun bitiş kısmı-->  
                </div>
                <br>
                <div>
                <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
              </div>

              <!-- /.card-body -->
            </div>
            </form>




          <!-- right col -->
        </div>
     

        <!-- /.card-body -->
        <div class="card-footer">
          Burası yeni öğrenci ekleme sayfasıdır.Lütfen öğrenci no girerken diğer öğrencilerde bulunmayan bir no giriniz!!!
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?= $this->include('include/footer') ?>
  