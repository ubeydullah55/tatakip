<?= $this->include('include/header') ?>
<?= $this->include('include/leftmenu') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hizmet İzni Listesi</h1>
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
                
                <form action="<?= base_url('home/carsi_Analiz'); ?>" method="post">
                
                  <div class="col-4">
                <input type="date"   name="tarih1">
                <input type="date" name="tarih2">
               
                <button type="submit" class="btn-btn-sm btn-info btn "><i class="fa fa-calendar"></i> Tarih Arası</button>
                </div>             
                </form>
                <br>
                <table id="example1" class="table table-bordered table-striped">
                
                  <thead>
                  <tr class="row2"> 
          
                    <th style=" text-align:center;" class="col-1">Öğrenci No</th>
                    <th style=" text-align:center;" class="col-2">Ad</th>
                    <th style=" text-align:center;" class="col-2">Soyad</th>
                    <th style="color:red; text-align:center;" class="col-1">Çıkış Tarih</th>
                    <th style="color:green; text-align:center;" class="col-1">GirişTarih</th>
                    <th style="color:#E65100; text-align:center;" class="col-1">Süre</th>
                    <th style="color:purple; text-align:center;" class="col-1">Adet</th>
                    <th style="color:brown; text-align:center;" class="col-1">Görev</th>
                    <th style="color:blue; text-align:center;" class="col-2">İncele</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  <?php foreach ($tumdizi as $item) : ?>
                  <tr>
   
                    <td style="text-align:center; font-size=12px;"><?= $item['ogrenci_no'] ?></td>
                    <td style=" text-align:center;"><b><?= $item['ad']['ad'] ?></b></td>
                    <td style=" text-align:center;"><b><?= $item['soyad']['soyad'] ?></b></td>
                    <td style="color:red; text-align:center;"><b><?= $item['escDate'] ?></b></td>
                    <td style="color:green; text-align:center;"><b><?= $item['openDate'] ?></b></td>
                    <td style="color:#E65100; text-align:center;"><b><?php 
                     echo  $item['saat']."saat".$item['dakika']."dk";
                      ?></b></td>
                    <td style="color:purple; text-align:center;"><b><?= $item['izinsayisi'] ?></b></td>
                    <td style="color:brown; text-align:center;"><b><?= $item['aciklama'] ?></b></td>
                    <td><a href="<?= base_url('home/kisisel_Analiz/'.$item['ogrenci_no']) ?>"><button type="submit" class="btn btn-block btn-outline-primary btn-sm" ><i class="fa fa-save"></i> Kişisel Analiz</button></a></td>
                  </tr>
                  <!--
                  <php $i++; >
                  başlarında ? işareti eklencek sonunada
                  -->              
                  
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