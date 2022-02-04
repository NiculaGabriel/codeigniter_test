<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title><?= $this->renderSection("title") ?></title>
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/libraries/css/bootstrap/css/bootstrap.min.css')?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/libraries/css/jquery-ui/jquery-ui.min.css')?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/libraries/css/jquery-ui/jquery-ui.structure.min.css')?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/libraries/css/jquery-ui/jquery-ui.theme.min.css')?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/main.css')?>">
<head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?= base_url('/')?>">App</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">           
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/contracte')?>">Contracte</a>
          </li>
        </ul>
      </div>
    </nav> 
 
    <?php 
        if( session()->has('success') || session()->has('info') )
        {
    ?>
        <div class="alert alert-<?= (session()->has('success') ? 'success' : 'primary' ) ?>" role="alert">
        <?=  ( session('success') ? session('success') : session('info') ) ?>
        </div>
    <?php 
        }
    ?>     
     
    <?= $this->renderSection("content") ?>
    <footer>
        <script src="<?= base_url('assets/libraries/js/jquery/jquery.min.js')?>"></script>
        <script src="<?= base_url('assets/libraries/js/jquery-ui/jquery-ui.min.js')?>"></script>
        <script src="<?= base_url('assets/libraries/js/popper/js/popper.min.js')?>"></script>
        <script src="<?= base_url('assets/libraries/js/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?= base_url('assets/js/main.js').'?'.strtotime('now')?>"></script>
    </footer>
</body>
<html>