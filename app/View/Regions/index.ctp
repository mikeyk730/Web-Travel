<h1>Regions</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
      <th></th>
	</tr>

	<?php foreach ($regions as $region): ?>
	<tr>
		<td><?php echo $region['Region']['id']; ?></td>
		<td><?php echo $region['Region']['name']; ?></td>
	</tr>
   <?php endforeach; ?>

</table>
