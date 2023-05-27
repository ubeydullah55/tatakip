
<?php $session =session(); ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="<?= base_url(''); ?>/assets/dist/img/title-logo-catalca-white.png" alt="AdminLTE Logo" class="brand-image  elevation-3" style="opacity: .6">
      <span class="brand-text font-weight-light">Çatalca Ferhatlar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url(''); ?>/assets/dist/img/yurtsistemimg.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $session->get('ad')." ".$session->get('soyad');  ?></a>
          <a href="#" class="d-block" style="text-align:center"><small>(<?php echo $session->get('unvan')  ?>)</small></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header">ANALİZ</li>
          <li class="nav-item">
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/index');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
              <i class="nav-icon fas fa-th text-primary"></i>
              <p> 
                Günlük Analiz
                <span class="right badge badge-danger">
                     <?php if(isset($toplamgelmeyen)){
                          echo $toplamgelmeyen;
                     }else echo "?";
                     ?>
                </span>
                <span class="right badge badge-warning">
                        <?php if(isset($toplamgeckalan)){
                          echo $toplamgeckalan;
                     }else echo "?";
                     ?>
                </span>
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/tekDers_Analiz');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
            <i class="nav-icon fa fa-book text-brown" aria-hidden="true"></i>
              <p>
                Tek Ders Analiz
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/toplu_Analiz');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
            <i class="nav-icon fa fa-university text-red" aria-hidden="true"></i>
              <p>
                Genel Analiz
              </p>
            </a>
          </li>
     
          <li class="nav-item">
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/carsi_Analiz');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
            <i class="nav-icon fa fa-bus text-purple" aria-hidden="true"></i>
              <p>
                Çarşı İzni Analiz
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/hizmet_Analiz');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
            <i class="nav-icon fa fa-tag text-orange" aria-hidden="true"></i>
              <p>
                Hizmet İzni Analiz
              </p>
            </a>
          </li>
       
          <li class="nav-header">YOKLAMA</li>
          <li class="nav-item" >
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/yoklama_view');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Genel</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/muzakere_yoklama_view');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
              <i class="nav-icon far fa-circle text-olive"></i>
              <p>Müzakere</p>
            </a>
          </li>
          
          <li class="nav-item">          
            <a href="<?= base_url('home/carsi_view'); ?>" class="nav-link">
              <i class="nav-icon far fa-circle text-purple"></i>
              <p>Çarşı İzni</p>
            </a>
          </li>
          <li class="nav-item">          
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/hizmet_view');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
              <i class="nav-icon far fa-circle text-orange"></i>
              <p>Hizmet İzni</p>
            </a>
          </li>
          
          <li class="nav-header">ÖĞRENCİ</li>
          <li class="nav-item">
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/ogrenci_ekle_view');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
              <i class="nav-icon fas fa-plus text-olive"></i>
              <p>
                Öğrenci Ekleme
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/ogrenci_edit_view');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
              <i class="nav-icon fas fa-pen text-warning"></i>
              <p>
                Öğrenci Düzenleme
              </p>
            </a>
          </li>
          <li class="nav-header">PROGRAM İŞLEMLERİ</li>
          <li class="nav-item">
            <a href="<?php if($session->get('yetki') != 5){
              
              echo base_url('home/programgoster');            
             }
             else{
               echo base_url('home/carsi_view');
             } ?>" class="nav-link">
            <i class="nav-icon fa fa-book text-olive" aria-hidden="true"></i>
              <p>
                Program Ekleme
              </p>
            </a>
          </li>
          
              <li class="nav-header">DÖKÜMANTASYON BELGESİ</li>
             <li class="nav-item">
             <a href="http://catalcaferhatlartatakip.online/tatakipDocuments.pdf" download class="nav-link">
            <i class='nav-icon fa fa-file text-white' aria-hidden="true"></i>
              <p>
                Documents
              </p>
            </a>
          </li>

          <li class="nav-header">PROFİL İŞLEMLERİ</li>
    
          <li class="nav-item">
            <a href="<?= base_url('home/logout'); ?>" class="nav-link">
            <i class='fas fa-sign-out-alt text-red'></i>
              <p>
                Çıkış
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>