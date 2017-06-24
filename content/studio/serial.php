<?php
array_push($_pagePath, array('text' => $serial, 'uri' => $serial));

$sql = "SELECT * FROM video v JOIN studio s ON ( s.id = v.studio_id ) WHERE s.code = :code AND v.serial = :serial";
$r = $db->query($sql, array(':code' => $studio, ':serial' => $serial));

if(count($r) == 0) {
	// 404 if we don't have a match
	require('./content/404.php');
} else {
	$r = $r[0];

	$_title = "{$serial} - ".htmlspecialchars($r['title']);

	$uriCode    = '/'.rawurlencode($r['code']);
	$htmlCode   = htmlspecialchars($r['code']);
	$uriSerial  = '/'.rawurlencode($r['serial']);
	$htmlSerial = htmlspecialchars($r['serial']);
	$uriItem    = "/studio{$uriCode}{$uriSerial}";
	$htmlTitle  = htmlspecialchars($r['title']);
?>
	<table class="list-table" style="margin:auto">
		<thead>
			<tr>
				<th colspan="3"><?php echo "{$htmlCode} {$htmlSerial} — {$htmlTitle}"; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><div style="display:table;width:250px;height:350px;border:1px solid #666;"><div style="display:table-cell;vertical-align:middle;text-align:center;background-color:#EEE">poster/thumb</div></div></td>
				<td>&lt;meta here&gt;</td>
				<td>&lt;tags here&gt;</td>
			</tr>
			<tr>
				<td colspan="3">&lt;Something else here?&gt;</td>
			</tr>
		</tbody>
	</table>
<?php
}
?>