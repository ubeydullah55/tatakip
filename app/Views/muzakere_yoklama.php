<?= $this->include('include/header') ?>
<?= $this->include('include/leftmenu') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper kanban">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
        <div class="col-sm-5"> 
          </div>
          <div class="col-sm-4">
            
          </div>
          <div class="col-sm-3">
          </div>
        </div>
      </div>
    </section>

    <section class="content pb-3">
      <div class="container-fluid h-100">
        
        <div class="card card-row card-success ">
          <div class="card-header">
            <h3 class="card-title">
              Müzakere Yoklama
            </h3>
          </div>
         <div class="card-body">
         <?php foreach($program as $row ): ?>
          <div class="card card-success card-outline">
              <div class="card-header">
                <h5 class="card-title"><?php echo $row['program_ad'] ?></h5>
                <div class="card-tools">
                  <a href="<?= base_url("home/muzakere_yoklama_liste_view2/".$row['p_id']."/".$row['program_ad']); ?>" class="btn btn-tool btn-link"><i class="fas fa-clock"></i></a>
                  <a href="<?= base_url("home/muzakere_yoklama_liste_view/".$row['p_id']."/".$row['program_ad']); ?>" class="btn btn-tool">
                    <i class="fas fa-pen"></i>
                  </a>
                </div>
              </div>
            </div>
            <br>
            <?php endforeach; ?>  
            <br>
          <!-- Card bitişi -->
          </div> 
      </div>
    </section>
  </div>

  <?= $this->include('include/footer2') ?>