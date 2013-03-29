<h1>Cities</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
      <th></th>
	</tr>

	<?php foreach ($cities as $city): ?>
	<tr>
		<td><?php echo $city['City']['id']; ?></td>
		<td><?php echo $city['City']['name']; ?></td>
	</tr>
   <?php endforeach; ?>

</table>
