<h1>Continents</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
      <th></th>
	</tr>

	<?php foreach ($continents as $continent): ?>
	<tr>
		<td><?php echo $continent['Continent']['id']; ?></td>
		<td><?php echo $continent['Continent']['name']; ?></td>
	</tr>
   <?php endforeach; ?>

</table>
