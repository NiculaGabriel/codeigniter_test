<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>
    Contracte
<?= $this->endSection() ?>

<?= $this->section("content") ?>
    <div class="container text-center mt-5">   
        <a class="btn btn-primary" href="<?= site_url('/contracte/') ?>"> Anuleaza </a> 
        <h1>Contract Nou</h1>
        <?= form_open("/contracte/save", array('id' => "new-contract")) ?>        
            <?= $this->include('Contracte/form') ?>
        </form>
    </div>
<?= $this->endSection() ?>
