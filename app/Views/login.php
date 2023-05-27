<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ÇATALCA FERHATLAR | TATAKİP</title>
  <link rel="icon" href="<?= base_url(''); ?>/assets/dist/img/title-logo-catalca.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <img src="<?= base_url(''); ?>/assets/dist/img/title-logo-catalca.png" alt="logo">
    <a href="#"><b>Çatalca</b>Ferhatlar</a>
  </div>
  <?php if(session()->get('danger')) : ?>             
              <div class="alert alert-danger" role="alert">
                 <?php echo session()->getFlashdata('danger'); ?>
              </div>
              <?php endif; ?> 
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Öğrenci Takip Sistemi</p>

      <form action="<?= base_url('login/kontrol'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="tel" class="form-control" name="k_adi" placeholder="Telefon no giriniz...." required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"  name="k_sifre" placeholder="Şifreniz...." required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

          <div class="col-12">
            <button type="submit" class="btn btn-info btn-block">Giriş yap</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    
      <!-- /.social-auth-links -->

  
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url(''); ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(''); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(''); ?>/assets/dist/js/adminlte.min.js"></script>
</body>
</html>
