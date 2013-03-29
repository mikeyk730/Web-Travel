<h1>Airports</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
      <th></th>
	</tr>

	<?php foreach ($airports as $airport): ?>
	<tr>
		<td><?php echo $airport['Airport']['id']; ?></td>
		<td><?php echo $airport['Airport']['name']; ?></td>
	</tr>
   <?php endforeach; ?>

</table>
