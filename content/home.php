		<table style="margin:auto">
			<thead>
				<tr>
					<th>Studio Code</th>
					<th>Videos</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach($rows as $r) {
?>
				<tr>
					<td><?php echo htmlspecialchars($r['code']); ?></td>
					<td><?php echo htmlspecialchars($r['videos']); ?></td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
