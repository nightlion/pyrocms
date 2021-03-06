<?=form_open('admin/products/delete');?>

<table border="0" class="listTable">
  <thead>
	<tr>
		<th class="first"><div></div></th>
		<th><a href="#">Product</a></th>
		<th><a href="#">Supplier</a></th>
		<th><a href="#">Price</a></th>
		<th><a href="#">Updated</a></th>
		<th class="last"><span>Actions</span></th>
	</tr>
  </thead>
  <tfoot>
  	<tr>
  		<td colspan="6">
  			<div class="inner"></div>
  		</td>
  	</tr>
  </tfoot>
	  
	<tbody>
	<? if ($products): ?>
	
		<? foreach ($products as $product): ?>
		<tr>
			<td><input type="checkbox" name="delete" value="<?= $product->id; ?>" /></td>
			<td><?= anchor('admin/products/edit/' . $product->id, $product->title);?></td>
			<td>
			<? if($product->supplier_title): ?>
				<?= anchor('admin/suppliers/edit/' . $product->supplier_slug, $product->supplier_title); ?>
			<? endif; ?>
			</td>
			<td><?= $this->settings->item('currency') . number_format($product->price, 2, '.', ','); ?></td>
			<td><?= date('M d, Y', $product->updated_on); ?></td>
			<td>
				<?= anchor('products/' . $product->id, 'View', 'target="_blank"'); ?> | 
				<?= anchor('admin/products/photo/' . $product->id, 'Add Photo'); ?> | 
				<?= anchor('admin/products/edit/' . $product->id, 'Edit'); ?>
			</td>
		</tr>
		<? endforeach; ?>
	
	<? else: ?>
		<tr>
			<td colspan="6">There are no Products.</td>
		</tr>
	<? endif; ?>
	</tbody>
	
</table>

<? $this->load->view('admin/layout_fragments/table_buttons', array('buttons' => array('delete') )); ?>
<?=form_close();?>