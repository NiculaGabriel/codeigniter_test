<div class="container-fluid search-bar text-left mt-2 mb-2">
	<div class="dropdown show">
	  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <?= (!empty($_filter['rows']) ? $_filter['rows'] : 'Numar Randuri' ) ?>
	  </a>
	  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	  	<?php
	  		foreach ($rows as $k => $v) {
	  			if(!empty($v['row']))
	  			{
	  	?>	  		  
	  			<a class="dropdown-item <?= (!empty($_filter['rows']) && (int)$_filter['rows'] == $v['row'] ? 'd-none' : '' ) ?>"  
	    	 		 href="<?= site_url('/contracte') . $v['url'] ?>"><?= $v['row'] ?></a>
	  	<?php 
	  		  }
	  		  else{
	  		  	if( !empty($_filter['rows']) && is_numeric($_filter['rows']) ) 
	  		  	{
	  	?>
	  					<a class="dropdown-item" href="
	  					<?= site_url('/contracte') . $v['url'] ?>">	  						
	  					 	 <?= $rows[sizeof($rows) - 1]['cancel'] ?>	  					 
	  					</a>
	  	<?php 
	  				}
	  		  }
	  	?> 
	  	<?php
	  	  }
	  	?>
	  </div>
	</div>

  <?= form_open(site_url('/contracte/filter'), array('class' => "form-inline my-2 my-lg-0", 'method' => 'GET') ) ?>
    	<?= $this->include('Contracte/search') ?>
	</form>
</div>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <?php 
        // dd($_tabel_header[sizeof($_tabel_header) - 1]);
      	foreach($_tabel_header as $k => $v)
      	{
      ?>	
        <?php if( !empty($v['th']) ) 
              { ?>
		      	<th scope="col"><?= $v['th'] ?>
		      	<?php if(!empty($v['url'])) { ?>
		      		<?php 
		      			 $_isAsc = 'ASC';
		      		   if( isset($v['active']) && (bool)$v['active'] ) 
		      		   {      		   	 
		      		   	 $_parts = explode('|', $v['url']);
		      		   	 if(count($_parts) > 1)
		      		   	 {
		      		   	 	 $_isAsc = $_parts[1] = ($_parts[1] == 'ASC' ? 'DESC' : 'ASC' );
		      		   	 	 $v['url'] = implode('|', $_parts);      		   	 	  
		      		   	 }
		      		   }
		      		?>
		      	  <a class="dropdown-toggle <?= (!empty($_isAsc) && $_isAsc == 'DESC' ? 'dropdown-desc' : '' ) ?>" href="<?= site_url('/contracte') . $v['url'] ?>"></a>
		      	  <?php if( isset($v['active']) && 
		      	            (bool)$v['active'] && 
		      	            !empty($_tabel_header[sizeof($_tabel_header) - 1]['cancel']) 
		      	          )  { ?>
										<a   class="close" aria-label="Close" href="<?= site_url('/contracte') . $_tabel_header[sizeof($_tabel_header) - 1]['url'] ?>"><span aria-hidden="true">&times;</span></a>  
							<?php } ?>
		        <?php } ?> 	         
		        </th>
      	<?php } ?>
  <?php } ?>
    </tr>
  </thead>
  <tbody>
  	 
  	<?php 
  	$count = 1;
  	foreach ($result as $key => $value){ ?>
  		<tr>
	      <th scope="row"><?= $count; ?></th>
		      <td><?= $value->id ?></td>
		      <td><?= $value->nume ?></td>
		      <td><?= $value->sex ?></td>
		      <td><?= $value->cnp ?></td>
		      <td><?= $value->email ?></td>
		      <td><?= $value->data ?></td>
		      <td><?= $value->created_at ?></td>
		      <td><?= $value->updated_at ?></td>
		      <td>
		      	<?php foreach ($value->tel as $k => $v) { ?>
		      		<p><?= $v ?></p>
		      	<?php } ?>
		      </td>
		      <td><a class="btn btn-primary" href="<?= site_url('/contracte/edit/' . $value->id) ?>"> Editeaza </a></td>
		      <td><a class="btn btn-primary" href="<?= site_url('/contracte/delete/1') ?>"> Sterge </a></td>
    	</tr>	
  	<?php $count++; } ?>
     
  </tbody>
</table>