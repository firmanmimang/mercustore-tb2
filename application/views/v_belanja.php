  <div class="card card-solid">
    <div class="card-body pb-0">
      <div class="row">
      	<div class="col-sm-12">
      		<?php if ($this->session->flashdata('pesan')) {
                  echo '<div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5><i class="icon fas fa-check"></i>';
                  echo $this->session->flashdata('pesan');
                  echo '</h5></div>'
                  ;} 
            ?>
	      	<?php echo form_open('belanja/update'); ?>

			<table class="table" id="example2">
			<thead>
			<tr>
					<th>#</th>
			        <th>Nama Barang</th>
			        <th>Harga</th>
			        <th>Sub-Total</th>
			        <th>Berat</th>
			        <th>QTY</th>
			        <th class="text-center">Action</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$no = 1;
				$i = 1; 
				$total_berat= 0;
			?>

			<?php foreach ($this->cart->contents() as $items): ?>
			<?php 
				$barang = $this->m_home->detail_barang($items['id']); 
				$berat= $items['qty']*$barang->berat;
				$total_berat += $berat
			?>

			
			<tr>
				 <td><?= $no++ ?></td>
		         <td>
		                 <?php echo $items['name']; ?>

		         </td>
		         <td>Rp. <?php echo number_format($items['price'],0); ?></td>
		         <td>Rp. <?php echo number_format($items['subtotal'],0); ?></td>
		         <td><?= $berat?> G.</td>
		         <td>
			       	<?php 
			        	echo form_input(array(
			        		'name' => $i.'[qty]',
			        		'value' => $items['qty'],
			        		'maxlength' => '3',
			        		'min' => '0',
		         			'size' => '5',
		         			'type' => 'number',
	          				'class' => 'form-control' 
		         		)); 
		         	?>	
		         </td>
		         <td class="text-center">
		         	<a href="<?= base_url('belanja/delete/'.$items['rowid']); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
		         </td>
		 	</tr>

			<?php $i++; ?>

			<?php endforeach; ?>

			
			</tbody>

			</table>

			<h3 class="text-right mt-3"><b>Total Bayar : Rp. <?php echo number_format($this->cart->total(),0); ?></b></h3>
			<h3 class="text-right mt-3"><b>Berat Total : <?= $total_berat; ?> G.</b></h3>

			<div class="row">
				<div class="col-sm-6">
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Cart</button>
					<a href="<?= base_url('belanja/clear') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Clear Cart</a>
					<a href="<?= base_url('belanja/checkout') ?>" class="btn btn-success"><i class="fa fa-check-square"></i> Check Out</a>
				</div>
			</div>

			<?php echo form_close() ?>
			<br>
		</div>
      </div>
  	</div>
  </div>