		<table class="list-table" style="margin:auto">
			<thead>
				<tr>
					<th>Studio</th>
					<th>Serial</th>
					<th>Title</th>
					<th>Added</th>
				</tr>
			</thead>
			<tbody>
<?php
$sql =
"SELECT
	s.code AS code,
	v.serial,
	v.title,
	v.created AS added
FROM video v
JOIN studio s ON ( s.id = v.studio_id )
ORDER BY
	v.created DESC,
	v.title ASC
LIMIT 50";

$rows = $db->query($sql);
foreach($rows as $r) {
?>
				<tr>
					<td class="code-serial"><a href="/studio/<?php echo rawurlencode($r['code']); ?>/" title="View studio <?php echo htmlspecialchars($r['code']); ?>"><?php echo htmlspecialchars($r['code']); ?></a></td>
					<td class="code-serial"><?php echo htmlspecialchars($r['serial']); ?></td>
					<td><?php echo strlen($r['title']) > 0 ? htmlspecialchars($r['title']) : '<i>N/A</i>'; ?></td>
					<td><?php echo date("Y-m-d H:i", strtotime($r['added'])); ?></td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
