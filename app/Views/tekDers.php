<?= $this->include('include/header') ?>
<?= $this->include('include/leftmenu') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php if($programad){echo $programad;}
            else{echo "Günlük Talebe Takip";}
             ?></h1>
            <h3><?php
            if($tarih){ echo $tarih;}
            else{ echo date('m-y-d');}
            ?></h3>
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
                 <form action="" method="get">
                 <input type="date"   name="tarih">
                 <select id="programlist" name="programlist">
                  <?php foreach ($programlar as $item) : ?>                
                    <option value="<?= $item['program_ad'] ?>"><?=$item['program_ad'] ?></option>  
                  <?php endforeach ?>  
                </select> 
                <button type="submit" class="btn-btn-sm btn-info btn "><i class="fa fa-play"></i> Listele</button> 
                </form>          
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                
           
               
                <br>
                <h3>Gelmeyenler</h3> 
                <table id="example" class="table table-bordered table-striped">
                
                  <thead>
                  <tr class="row2"> 
          
                    <th style=" text-align:center;" class="col-1">Öğrenci No</th>
                    <th style=" text-align:center;" class="col-2">Ad</th>
                    <th style=" text-align:center;" class="col-2">Soyad</th>
                    
                    <th style="color:blue; text-align:center;" class="col-1">İncele</th>
                  </tr>
                  </thead>
                  <tbody>               
                  <?php foreach ($gelmeyen as $item) : ?>
                  <tr>
                  <td style="text-align:center; font-size=12px;"><?= $item['ogrenci_no'] ?></td>
                  <td style="text-align:center; font-size=12px;"><?= $item['ad']['ad'] ?></td>
                  <td style="text-align:center; font-size=12px;"><?= $item['soyad']['soyad'] ?></td>   
                  <td><a href="<?= base_url('home/kisisel_Analiz/'.$item['ogrenci_no']) ?>"><button type="submit" class="btn btn-block btn-outline-primary btn-sm" ><i class="fa fa-save"></i> Kişisel Analiz</button></a></td>
                  </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
                    <br><br>
                    <h3>Geç Kalanlar</h3>
                <table id="example" class="table table-bordered table-striped">
                
                <thead>
                <tr class="row2"> 
        
                  <th style=" text-align:center;" class="col-1">Öğrenci No</th>
                  <th style=" text-align:center;" class="col-2">Ad</th>
                  <th style=" text-align:center;" class="col-2">Soyad</th>
                  <th style=" text-align:center;" class="col-1">Süre</th>
                  
                  <th style="color:blue; text-align:center;" class="col-1">İncele</th>
                </tr>
                </thead>
                <tbody>               
                <?php foreach ($gecKalan as $item) : ?>
                <tr>
                <td style="text-align:center; font-size=12px;"><?= $item['ogrenci_no'] ?></td>
                <td style="text-align:center; font-size=12px;"><?= $item['ad']['ad'] ?></td>
                <td style="text-align:center; font-size=12px;"><?= $item['soyad']['soyad'] ?></td>  
                <td style="text-align:center; font-size=12px;"><?= $item['sure']."dk" ?></td>
                <td><a href="<?= base_url('home/kisisel_Analiz/'.$item['ogrenci_no']) ?>"><button type="submit" class="btn btn-block btn-outline-primary btn-sm" ><i class="fa fa-save"></i> Kişisel Analiz</button></a></td>
                </tr>
                <?php endforeach ?>
                </tbody>
              </table>
              <br><br>
              <h3>İzinli Olanlar</h3>
                <table id="example" class="table table-bordered table-striped">
                
                <thead>
                <tr class="row2"> 
        
                  <th style=" text-align:center;" class="col-1">Öğrenci No</th>
                  <th style=" text-align:center;" class="col-2">Ad</th>
                  <th style=" text-align:center;" class="col-2">Soyad</th>
                  
                  <th style="color:blue; text-align:center;" class="col-1">İncele</th>
                </tr>
                </thead>
                <tbody>               
                <?php foreach ($izinli as $item) : ?>
                <tr>
                <td style="text-align:center; font-size=12px;"><?= $item['ogrenci_no'] ?></td>
                <td style="text-align:center; font-size=12px;"><?= $item['ad']['ad'] ?></td>
                <td style="text-align:center; font-size=12px;"><?= $item['soyad']['soyad'] ?></td>   
                <td><a href="<?= base_url('home/kisisel_Analiz/'.$item['ogrenci_no']) ?>"><button type="submit" class="btn btn-block btn-outline-primary btn-sm" ><i class="fa fa-save"></i> Kişisel Analiz</button></a></td>
                </tr>
                <?php endforeach ?>
                </tbody>
              </table>
              <br><br>
              <h3>Çarşıda Olanlar</h3>
                <table id="example" class="table table-bordered table-striped">
                
                <thead>
                <tr class="row2"> 
        
                  <th style=" text-align:center;" class="col-1">Öğrenci No</th>
                  <th style=" text-align:center;" class="col-2">Ad</th>
                  <th style=" text-align:center;" class="col-2">Soyad</th>
                  <th style=" text-align:center;" class="col-2">Açıklama</th>
                  <th style="color:blue; text-align:center;" class="col-1">İncele</th>
                </tr>
                </thead>
                <tbody>               
                <?php foreach ($carsi as $item) : ?>
                <tr>
                <td style="text-align:center; font-size=12px;"><?= $item['ogrenci_no'] ?></td>
                <td style="text-align:center; font-size=12px;"><?= $item['ad']['ad'] ?></td>
                <td style="text-align:center; font-size=12px;"><?= $item['soyad']['soyad'] ?></td>    
                <td style="text-align:center; font-size=12px;"><?php if(isset($item['aciklama']['aciklama'])){
                  echo $item['aciklama']['aciklama'];
                }else{
                  echo "----";
                } ?></td> 
                <td><a href="<?= base_url('home/kisisel_Analiz/'.$item['ogrenci_no']) ?>"><button type="submit" class="btn btn-block btn-outline-primary btn-sm" ><i class="fa fa-save"></i> Kişisel Analiz</button></a></td>
                </tr>
                <?php endforeach ?>
                </tbody>
              </table>
              <br><br>
              <h3>Hizmette Olanlar</h3>
                <table id="example" class="table table-bordered table-striped">
                
                <thead>
                <tr class="row2"> 
        
                  <th style=" text-align:center;" class="col-1">Öğrenci No</th>
                  <th style=" text-align:center;" class="col-2">Ad</th>
                  <th style=" text-align:center;" class="col-2">Soyad</th>
                  <th style=" text-align:center;" class="col-2">Açıklama</th>
                  
                  <th style="color:blue; text-align:center;" class="col-1">İncele</th>
                </tr>
                </thead>
                <tbody>               
                <?php foreach ($hizmet as $item) : ?>
                <tr>
                <td style="text-align:center; font-size=12px;"><?= $item['ogrenci_no'] ?></td>
                <td style="text-align:center; font-size=12px;"><?= $item['ad']['ad'] ?></td>
                <td style="text-align:center; font-size=12px;"><?= $item['soyad']['soyad'] ?></td>   
                <td style="text-align:center; font-size=12px;"><?php if(isset($item['aciklama']['aciklama'])){
                  echo $item['aciklama']['aciklama'];
                }else{
                  echo "----";
                } ?></td>  
                <td><a href="<?= base_url('home/kisisel_Analiz/'.$item['ogrenci_no']) ?>"><button type="submit" class="btn btn-block btn-outline-primary btn-sm" ><i class="fa fa-save"></i> Kişisel Analiz</button></a></td>
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