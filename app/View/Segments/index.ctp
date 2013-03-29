<h1>Segments</h1>
<table>
	<tr>
		<th>Id</th>
		<th>From</th>
		<th>To</th>
      <th></th>
	</tr>

	<?php foreach ($segments as $segment): ?>
	<tr>
		<td><?php echo $segment['Segment']['id']; ?></td>
		<td><?php echo $segment['Segment']['airport1']; ?></td>
		<td><?php echo $segment['Segment']['airport2']; ?></td>
	</tr>
   <?php endforeach; ?>

</table>
