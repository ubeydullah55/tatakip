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
                
                <form action="<?= base_url('home/toplu_Analiz'); ?>" method="post">
                
                  <div class="col-4">
                <input type="date"   name="tarih1">
                <input type="date" name="tarih2">
               
                <button type="submit" class="btn-btn-sm btn-info btn "><i class="fa fa-calendar"></i> Tarih Arası</button>
                <br><br>
                <div class="alert alert-dark" role="alert">
                     İstenilen Tarih Aralığında Toplam<b><u> <?= $programSayisi ?></u></b> kere yoklama alınmıştır....
                    </div>
               
                </div>             
                </form>
                <br>
                <table id="example1" class="table table-bordered table-striped">
                
                  <thead>
                  <tr class="row2"> 
          
                    <th style=" text-align:center;" class="col-1">Öğrenci No</th>
                    <th style=" text-align:center;" class="col-2">Ad</th>
                    <th style=" text-align:center;" class="col-2">Soyad</th>
                    <th style="color:red; text-align:center;" class="col-1">Gelinmeyen</th>
                    <th style="color:orange; text-align:center;" class="col-1">GecKalınan</th>
                    <th style="color:green; text-align:center;" class="col-1">İzinli</th>
                    <th style="color:purple; text-align:center;" class="col-1">Carşı İzni</th>
                    <th style="color:brown; text-align:center;" class="col-1">Hizmet İzni</th>
                    <th style="color:brown; text-align:center;" class="col-1">Yüzde</th>
                    <th style="color:blue; text-align:center;" class="col-1">İncele</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  <?php foreach ($tumdizi as $item) : ?>
                  <tr>
   
                    <td style="text-align:center; font-size=12px;"><?= $item['ogrenci_no'] ?></td>
                    <td style=" text-align:center;"><?= $item['ad'] ?></td>
                    <td style=" text-align:center;"><?= $item['soyad'] ?></td>
                    <td style="color:red; text-align:center;"><?= $item['gelinmeyen'] ?></td>
                    <td style="color:orange; text-align:center;"><?= $item['gec'] ?></td>
                    <td style="color:green; text-align:center;"><?= $item['izinli'] ?></td>
                    <td style="color:purple; text-align:center;"><?= $item['carsi'] ?></td>
                    <td style="color:brown; text-align:center;"><?= $item['hizmet'] ?></td>
                    <td style="color:brown; text-align:center;"><?= "%".($item['yuzde']) ?></td>
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