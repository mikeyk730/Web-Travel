<h1>Locations</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
      <th></th>
	</tr>

	<?php foreach ($locations as $location): ?>
	<tr>
		<td><?php echo $location['Location']['city_id']; ?></td>
		<td><?php echo $location['Location']['display_name']; ?></td>
	</tr>
   <?php endforeach; ?>

</table>
