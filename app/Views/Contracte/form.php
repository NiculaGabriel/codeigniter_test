  <?php $errors = ( session()->has('errors') ? session('errors') : [] ) ?>
 
  <div class="form-group">
      <label for="nume">Nume si Prenume <span class="required">*</span></label>
      <input type="text" class="form-control" id="nume" name="nume" value="<?= old('nume', $result->nume) ?>" placeholder="Adauga numele si prenumele">
      <?php if(!empty($errors['nume'])){ ?>
      <div class="alert alert-danger mt-2" role="alert">
           <?= $errors['nume'] ?>
      </div>
      <?php } ?>
  </div>
    <div class="form-group">
    <label for="sex">Sex <span class="required">*</span></label>
    <select class="form-control" id="sex">
      <option <?= (old('sex', $result->sex) == '' ?  'selected="selected"' : '') ?> value="">Selecteaza</option>
      <option <?= (old('sex', $result->sex) == 'F' ? 'selected="selected"' : '') ?>>F</option>
      <option <?= (old('sex', $result->sex) == 'M' ? 'selected="selected"' : '') ?>>M</option>
    </select>
    <input type="hidden" name="sex" value="<?= old('sex', $result->sex) ?>">
    <?php if(!empty($errors['sex'])){ ?>
      <div class="alert alert-danger mt-2" role="alert">
           <?= $errors['sex'] ?>
      </div>
    <?php } ?>
  </div>
  <div class="form-group">
      <label for="cnp">CNP <span class="required">*</span></label>
      <input type="text" class="form-control" id="cnp" name="cnp" value="<?= old('cnp', $result->cnp) ?>" placeholder="Adauga CNP" value="">
      <?php if(!empty($errors['cnp'])){ ?>
      <div class="alert alert-danger mt-2" role="alert">
           <?= $errors['cnp'] ?>
      </div>
      <?php } ?>
  </div>
  <div class="form-group">
      <label for="data">Data nasterii</label>
      <input type="text" class="form-control datepicker" id="data" name="data" value="<?= old('data', $result->data) ?>" placeholder="Adauga data nasterii">
  </div>
  <div class="form-group">
      <label for="email">Adresa de e-mail <span class="required">*</span></label>
      <input type="email" class="form-control" id="email"  name="email" value="<?= old('email', $result->email) ?>" placeholder="Adauga adresa de e-mail">
      <?php if(!empty($errors['email'])){ ?>
      <div class="alert alert-danger mt-2" role="alert">
           <?= $errors['email'] ?>
      </div>
      <?php } ?>
  </div>
  <div class="form-group">
      <label for="telefon">Numar telefon</label>
      <div class="group">
       <input type="tel" class="form-control" id="telefon" name="tel[]" value="<?php if( !empty(old('tel', $result->tel)) ){ echo old('tel', $result->tel)[0]; } ?>" placeholder="Adauga telefon">
       <button type="button" class="add-phone btn btn-primary">+</button>
      </div>
  </div> 
  <?php 
       $result = old('tel', $result->tel); 
       if( is_array($result) ) 
       {
   ?>
       <?php foreach ($result as $key => $value) { ?>
              <?php if($key > 0 && !empty($value) ){ ?> 
              <div class="form-group mt-2">
                     <div class="group">
                            <input type="tel" class="form-control" name="tel[]" value="<?= $value ?>">
                            <button type="button" class="remove-phone btn btn-primary">-</button>
                     </div>
              </div>
              <?php } ?> 
       <?php }?>
  <?php } ?>
  <button class="btn submit btn-primary mt-5">Salveaza</button>
 