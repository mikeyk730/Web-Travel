<div class="trips view">
<h2><?php  echo __('Trip');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($trip['Trip']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($trip['Trip']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($trip['Trip']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Trip'), array('action' => 'edit', $trip['Trip']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Trip'), array('action' => 'delete', $trip['Trip']['id']), null, __('Are you sure you want to delete # %s?', $trip['Trip']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Trips'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trip'), array('action' => 'add')); ?> </li>
	</ul>
</div>
