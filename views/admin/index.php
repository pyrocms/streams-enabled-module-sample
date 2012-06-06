<section class="title">
	<h4><?php echo lang('faq:faqs'); ?></h4>
</section>

<section class="item">
	
	<?php if ($faqs['total'] > 0 ): ?>
	
		<table>
			<thead>
				<tr>
					<th><?php echo lang('faq:question'); ?></th>
					<th><?php echo lang('faq:answer'); ?></th>
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
				<?php foreach($faqs['entries'] as $faq ): ?>
				<tr>
					<td><?php echo $faq['question']; ?></td>
					<td><?php echo $faq['answer']; ?></td>
					<td><?php echo anchor('admin/faq/edit/' . $faq['id'], lang('global:edit'), 'class="btn orange edit"'); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php echo $faqs['pagination']; ?>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('faq:no_faqs'); ?></div>
	<?php endif;?>
	
</section>
