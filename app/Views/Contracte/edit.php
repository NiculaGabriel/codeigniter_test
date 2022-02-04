<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>
    Contracte
<?= $this->endSection() ?>

<?= $this->section("content") ?>
    <div class="container text-center mt-5">   
        <a class="btn btn-primary" href="<?= site_url('/contracte/') ?>"> Anuleaza </a> 
        <h1>Modifica Contract</h1>
            <?= form_open("/contracte/update/" . $result->id, array('id' => "new-contract")) ?>        
            <?= $this->include('Contracte/form') ?>
        </form>
    </div>
<?= $this->endSection() ?>
