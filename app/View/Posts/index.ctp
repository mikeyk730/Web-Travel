<h1>Blog posts</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
      <th></th>
	</tr>

	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($post['Post']['title'], 
			      array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
		</td>
      <td>
         <?php echo $this->Html->link('Edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])); ?>
         <?php echo $this->Html->link('Delete', array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?') ); ?>
      </td>
	</tr>
   <?php endforeach; ?>

</table>

<?php echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' => 'add')); ?>
