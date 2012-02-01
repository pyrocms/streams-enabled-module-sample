<section class="title">
	<h4><?php echo lang('streams_sample:faqs'); ?></h4>
</section>

<section class="item">
	
	<?php if ($faqs['total'] > 0 ): ?>
	
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
				<?php foreach($faqs['question'] as $faq ): ?>
				<tr>
					<td><?php echo $faq['question']; ?></td>
					<td><?php echo $faq['answer']; ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php echo $faqs['pagination']; ?>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('streams_sample:no_faqs'); ?></div>
	<?php endif;?>
	
</section>