<section class="title">
	<h4><?php echo lang('sample:item_list'); ?></h4>
</section>

<section class="item">
	<?php echo form_open('admin/sample/delete');?>
	
	<?php if ($dogs['total'] > 0 ): ?>
	
		<table>
			<thead>
				<tr>
					<th><?php echo lang('global:name'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach($dogs['entries'] as $dog ): ?>
				<tr>
					<td><?php echo $dog['name']; ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php echo $dogs['pagination']; ?>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('streams_sample:no_dogs'); ?></div>
	<?php endif;?>
	
	<?php echo form_close(); ?>
</section>