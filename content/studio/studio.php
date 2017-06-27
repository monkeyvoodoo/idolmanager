<?php
$code = $_uri[1];
$_title = "Studio: {$code}";

$sql =
"SELECT
	s.code,
	s.name,
	v.serial,
	v.title,
	v.created AS added
FROM video v
JOIN studio s ON ( s.id = v.studio_id )
WHERE LOWER(s.code) = :code
ORDER BY v.serial ASC";
// message(strtr($sql, array(':code' => "'{$code}'")), true);

$rows = $db->query($sql, array(':code' => strtolower($code)));

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
		$uriCode = '/'.rawurlencode($r['code']);
		$htmlCode = htmlspecialchars($r['code']);
		$uriSerial = '/'.rawurlencode($r['serial']);
		$htmlSerial = htmlspecialchars($r['serial']);
		$uriItem = "/studio{$uriCode}{$uriSerial}";
?>
		<tr>
			<td class="code-serial"><a href="<?php echo $uriItem; ?>" title="View <?php echo "{$htmlCode} {$htmlSerial}"; ?>"><?php echo htmlspecialchars($r['serial']); ?></a></td>
			<td><a href="<?php echo $uriItem; ?>" title="View <?php echo "{$htmlCode} {$htmlSerial}"; ?>"><?php echo strlen($r['title']) > 0 ? htmlspecialchars($r['title']) : '<i>N/A</i>'; ?></a></td>
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