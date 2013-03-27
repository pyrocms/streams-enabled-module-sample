<section class="title">
	<h4><?php echo lang('faq:faqs'); ?></h4>
</section>

<section class="item">
<div class="content">

	<?php if ($faqs['total'] > 0): ?>
	
		<table class="table" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?php echo lang('faq:question'); ?></th>
					<th><?php echo lang('faq:answer'); ?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($faqs['entries'] as $faq): ?>
				<tr>
					<td><?php echo $faq['question']; ?></td>
					<td><?php echo $faq['answer']; ?></td>
					<td class="actions"><?php echo anchor('admin/faq/edit/' . $faq['id'], lang('global:edit'), 'class="button edit"'); ?>
                                            <?php echo anchor('admin/faq/delete/' . $faq['id'], lang('global:delete'), array('class' => 'confirm button delete')); ?>
                                        </td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php echo $faqs['pagination']; ?>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('faq:no_faqs'); ?></div>
	<?php endif;?>
	
</div>
</section>