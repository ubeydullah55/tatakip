<?= $this->include('include/header2_kisisel') ?>
<?= $this->include('include/leftmenu') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kişisel Anliz Sayfası</h1>
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
                  <b>
                 <?php foreach($bilgi as $row){
                   echo $row['ad']." ".$row['soyad'];
                 } ?></b></h2>
              </div>
                 
              <!-- /.card-header -->
              <div class="card-body">
                
                 <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                   <div id="donutchart" style="width: 500px; height: 300px;"></div>

                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                   <div class="alert alert-secondary" role="alert" style="text-align:center">
                      Toplam alınan yoklama sayısı <b><u><?= $toplamProgramSayisi ?></u></b>
                    </div>
                   <div class="alert alert-info" role="alert">
                      Bu öğrenci Toplamda <b><u><?= $katildigiProgramSayisi ?></u></b> kere programa katılmıştır...
                    </div>
                   <div class="alert alert-danger" role="alert">
                      Bu öğrenci Toplamda <b><u><?= $gelinmeyensayisi ?></u></b> kere programa gelmemiştir...
                    </div>
                    <div class="alert alert-warning" role="alert">
                    Bu öğrenci Toplamda <b><u><?= $gecsayisi ?></u></b> kere programa gec kalmıştır...
                    </div>
                    <div class="alert alert-success" role="alert">
                    Bu öğrenci Toplamda <b><u><?= $izinlisayisi ?></u></b> kere izin kullanmıştır...
                    </div>
                    <div class="alert alert-dark" role="alert">
                    Bu öğrenci Toplamda <b><u><?= $carsisayisi ?></u></b> kere <b>Çarşı izini</b> kullanmıştır...
                    </div>
                    <div class="alert alert-secondary" role="alert">
                    Bu öğrenci Toplamda <b><u><?= $hizmetsayisi ?></u></b> kere <b>Hizmet izini</b> kullanmıştır...
                    </div>
                
                </div>
                  
                 </div>





                <table id="example1" class="table table-bordered table-striped">
                  
                  <thead>
                  <tr>                
                    <th>Rapor No</th>
                    <th>Program Adı</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                    <th>İşlem</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($birlesikdizi as $item) : ?>
                  <tr>
                  <td><?= $item['id'] ?></td>
                    <td><?= $item['program_adi'] ?></td>
                    <td><?= $item['tarih'] ?></td>
                    <td><?php if($item['tur_id']==0){
                      echo $item['sure']."dk";
                    } 
                    if($item['tur_id']==1){
                      echo "<p style='color:red'> Gelmedi  </p>";
                    }
                    if($item['tur_id']==2){
                      echo "<p style='color:green'> İzinli </p>";
                    }
                    if($item['tur_id']==3){
                      echo "<p style='color:purple'> Çarşı </p>";
                    }
                    if($item['tur_id']==4){
                      echo "<p style='color:orange'> Hizmet </p>";
                    }
                    ?></td>
                    <td><a href="<?= base_url('home/delete/'.$item['id']."/".$item['tur_id']."/".$item['ogrenci_no']) ?>"><button type="submit" class="btn btn-block btn-outline-danger btn-sm" ><i class="fa fa-trash"></i> Sil</button></a></td>
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