<?= $this->include('include/header') ?>
<?= $this->include('include/leftmenu') ?>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php if(session()->get('info')) : ?>             
              <div class="alert alert-warning" role="alert">
                 <?php echo session()->getFlashdata('info'); ?>
              </div>
              
              <?php endif; ?>
            <h1>
              <b>Bu günün tarihi</b> <br>
              <?php 
              echo date('d/m/Y H:i:s');
            ?></h1>           
          </div>       
        </div>
      </div><!-- /.container-fluid -->
    </section>




<section class="content">
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Programlara Gelmeyenler</h3>
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
  <section class="content">
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">  
     <!-- ./col -->
     <?php foreach($program as $row ): ?>
     <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h4 style="text-align:center;"><?= $row['program_ad'] ?></h4>
          <h3 style="text-align:center;">
          <?php
          $adi='sGelmeyen'.$row['p_id'];
          //$sGelmeyen.$row['program_ad']
          echo $$adi; //birinci $ile $opereatörünü 2.$ile isimin tamamını çektik
          ?>
          </h3>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php $degiskenurl='home/gunlukanaliz2/'.$row['program_ad']; echo base_url($degiskenurl); ?>" class="small-box-footer">İncele <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <?php endforeach; ?>
    <!-- ./col -->
  </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- right col -->
  </div>
  <!-- /.row (main row) -->

  <!-- /.card-body -->
  <div class="card-footer">
    Bu kısımda bu gün programlara izinli olmayıp gelmeyenler listelenmiştir.....
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

</section>


<!-- .............................Derse Gec Kalanlar.........................-->






    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Günlük Geç Kalanlar</h3>
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
        <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">


             <!-- ./col -->
     <?php foreach( $program as $row ): ?>
     <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h4 style="text-align:center;"><?= $row['program_ad'] ?></h4>
          <h3 style="text-align:center;">
          <?php
          $adi='s'.$row['p_id'];
          //$sGelmeyen.$row['program_ad']
          echo $$adi; //birinci $ile $opereatörünü 2.$ile isimin tamamını çektik
          ?>
          </h3>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php $degiskenurl='home/gunlukanaliz/'.$row['program_ad']; echo base_url($degiskenurl); ?>" class="small-box-footer">İncele <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <?php endforeach; ?>
    <!-- ./col -->
        </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
     
        <!-- /.card-body -->
        <div class="card-footer">
          Bu kısımda bu gün programlara geç kalanlar listelenmiştir.....
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>


    <!-- ..................................İzinliler................................... -->
        
    <!-- Main content -->
    <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Bu Gün İzinli Olanlar</h3>
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
  <section class="content">
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
                  
     <?php foreach( $program as $row ): ?>
     <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-olive">
        <div class="inner">
          <h4 style="text-align:center;"><?= $row['program_ad'] ?></h4>
          <h3 style="text-align:center;">
          <?php
          $adi='sizinli'.$row['p_id'];
          //$sGelmeyen.$row['program_ad']
          echo $$adi; //birinci $ile $opereatörünü 2.$ile isimin tamamını çektik
          ?>
          </h3>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php $degiskenurl='home/gunlukanaliz3/'.$row['program_ad']; echo base_url($degiskenurl); ?>" class="small-box-footer">İncele <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <?php endforeach; ?>
    <!-- ./col -->
  </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- right col -->
  </div>
  <!-- /.row (main row) -->

  <!-- /.card-body -->
  <div class="card-footer">
    Bu kısımda bu gün izinli olanlar listelenmiştir.....
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?= $this->include('include/footer') ?>
  