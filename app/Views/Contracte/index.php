<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>
    Contracte
<?= $this->endSection() ?>

<?= $this->section("content") ?>
    <div class="container-fluid text-center mt-5">   
        <a class="btn btn-primary" href="<?= site_url('/contracte/create/') ?>"> Adauga Contract </a>      
        <h1>Listare Contracte</h1>
        <?= $this->include('Contracte/table') ?>
    </div>
<?= $this->endSection() ?>