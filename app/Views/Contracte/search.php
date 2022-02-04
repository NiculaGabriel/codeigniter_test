	    <div class="dropdown choose-type">
		  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">		  	 
		    <?= (!empty($_filter['type']) ? ( $_filter['type'] == 'tel' ? 'TELEFON' : ( $_filter['type'] == 'data'? 'DATA DE NASTERE' : strtoupper($_filter['type'])) ) : 'Filtreaza' ) ?> </a>   
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
		    <a class="dropdown-item <?= ( !empty($_filter['type']) && $_filter['type'] == 'id'    ? 'd-none' : '') ?>" data-value="id"    href="javascript:void(0)">ID</a>
		    <a class="dropdown-item <?= ( !empty($_filter['type']) && $_filter['type'] == 'nume'  ? 'd-none' : '') ?>" data-value="nume"  href="javascript:void(0)">NUME</a>
		    <a class="dropdown-item <?= ( !empty($_filter['type']) && $_filter['type'] == 'sex'   ? 'd-none' : '') ?>" data-value="sex"   href="javascript:void(0)">SEX</a>
		    <a class="dropdown-item <?= ( !empty($_filter['type']) && $_filter['type'] == 'cnp'   ? 'd-none' : '') ?>" data-value="cnp"   href="javascript:void(0)">CNP</a>
		    <a class="dropdown-item <?= ( !empty($_filter['type']) && $_filter['type'] == 'email' ? 'd-none' : '') ?>" data-value="email" href="javascript:void(0)">EMAIL</a>
		    <a class="dropdown-item <?= ( !empty($_filter['type']) && $_filter['type'] == 'tel'   ? 'd-none' : '') ?>" data-value="tel"   href="javascript:void(0)">TELEFON</a>
		    <a class="dropdown-item <?= ( !empty($_filter['type']) && $_filter['type'] == 'data'  ? 'd-none' : '') ?>" data-value="data"  href="javascript:void(0)">DATA DE NASTERE</a>
			<?php if( !empty($_filter['type']) && !empty($_filter['search']) ) { ?>
		    	<a href="javascript:void(0)" class="dropdown-item cancel-filters">ANULEAZA FILTRELE</a>
		    <?php } ?>
		  </div>
		</div>

	  	<input type="hidden" name="type" value="<?= (!empty($_filter) && !empty($_filter['type']) ? $_filter['type'] : '' ) ?>">
	    <input class="form-control mr-sm-2" type="search" name="search" value="<?= (!empty($_filter) && !empty($_filter['search']) ? $_filter['search'] : '' ) ?>" placeholder="Search" aria-label="Search">
	      
	    <?php if( !empty($_filter['rows']) && is_numeric((int)$_filter['rows']) ){ ?>
	      	<input type="hidden" name="rows" value="<?= $_filter['rows'] ?>">
	  	<?php } ?>

	  	<?php if( !empty($_filter['sortby']) ){ ?>
	      	<input type="hidden" name="sortby" value="<?= $_filter['sortby'] ?>">
	  	<?php } ?>

	    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
