<?php
$code = $uri[1];
$_title = "Studio: {$code}";

$sql =
"SELECT
	s.code AS studio_code,
	s.name AS studio_name,
	v.serial,
	v.title,
	v.created AS added
FROM video v
JOIN studio s ON ( s.id = v.studio_id )
WHERE s.code = :code
ORDER BY v.serial ASC";
// message(strtr($sql, array(':code' => "'{$code}'")), true);

$rows = $db->query($sql, array(':code' => $code));

if(count($rows) == 0) {
?>
		<div style="text-align:center">Invalid studio?</div>
<?php
} else {
?>
<table class="list-table" style="margin:auto">
	<thead>
		<tr>
			<th>Serial</th>
			<th>Title</th>
			<th>Added</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($rows as $r) {
?>
		<tr>
			<td class="code-serial"><?php echo htmlspecialchars($r['serial']); ?></td>
			<td><?php echo strlen($r['title']) > 0 ? htmlspecialchars($r['title']) : '<i>N/A</i>'; ?></td>
			<td><?php echo date("Y-m-d H:i", strtotime($r['added'])); ?></td>
		</tr>
<?php
	}
?>
			</tbody>
		</table>
<?php
}
?>