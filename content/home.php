<?php
$_title = '';
?>
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
-- LIMIT 50";

$rows = $db->query($sql);
foreach($rows as $r) {
	$uriCode = '/'.rawurlencode($r['code']);
	$htmlCode = htmlspecialchars($r['code']);
	$uriSerial = '/'.rawurlencode($r['serial']);
	$htmlSerial = htmlspecialchars($r['serial']);
	$uriItem = "/studio{$uriCode}{$uriSerial}";
?>
				<tr>
					<td class="code-serial"><a href="/studio<?php echo $uriCode; ?>/" title="View studio <?php echo $htmlCode; ?>"><?php echo $htmlCode; ?></a></td>
					<td class="code-serial"><a href="<?php echo $uriItem; ?>" title="View item <?php echo $htmlSerial; ?>"><?php echo $htmlSerial; ?></a></td>
					<td><a href="<?php echo $uriItem; ?>" title="View item <?php echo $htmlSerial; ?>"><?php echo strlen($r['title']) > 0 ? htmlspecialchars($r['title']) : '<i>N/A</i>'; ?></a></td>
					<td><?php echo date("Y-m-d H:i", strtotime($r['added'])); ?></td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
