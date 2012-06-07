<section class="title">
	<!-- We'll use $this->method to switch between faq.create & faq.edit -->
	<h4><?php echo lang('faq:'.$this->method); ?></h4>
</section>

<section class="item">

	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
		
		<div class="form_inputs">
	
		<ul>
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="question"><?php echo lang('faq:question'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('question', set_value('question', $question), 'class="width-15"'); ?></div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="answer"><?php echo lang('faq:answer'); ?> <span>*</span></label>
				<div class="input"><?php echo form_textarea('answer', set_value('answer', $answer), 'class="width-15"'); ?></div>
			</li>
		</ul>
		
		</div>
		
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>

</section>