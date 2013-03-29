<h1>Countries</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
      <th></th>
	</tr>

	<?php foreach ($countries as $country): ?>
	<tr>
		<td><?php echo $country['Country']['id']; ?></td>
		<td><?php echo $country['Country']['name']; ?></td>
	</tr>
   <?php endforeach; ?>

</table>
