<?php
array_push($_pagePath, array('text' => $serial, 'uri' => $serial));

$sql =
"SELECT
	v.id,
	v.studio_id,
	v.serial,
	v.title,
	v.created,
	s.id AS studio_id,
	s.code AS studio_code,
	s.name AS studio_name
FROM video v
JOIN studio s ON ( s.id = v.studio_id )
WHERE
	LOWER(s.code) = :code AND
	LOWER(v.serial) = :serial";
$r = $db->query($sql, array(':code' => strtolower($studio), ':serial' => strtolower($serial)));

if(count($r) == 0) {
	// 404 if we don't have a match
	require('./content/404.php');
} else {
	$r = $r[0];

	$sql =
"WITH RECURSIVE tags_rec(id, parent_id, user_id, tag, depth, path) AS (
		SELECT id, parent_id, user_id, tag, 1::integer AS depth, id::text AS path
		FROM tag
		WHERE parent_id = '0'
	UNION ALL
		SELECT t.id, t.parent_id, t.user_id, t.tag, r.depth + 1 AS depth, (r.path || '->' || t.id::TEXT) AS path
		FROM tags_rec r, tag t
		WHERE t.parent_id = r.id
)

SELECT
	r.id,
	r.parent_id,
	r.user_id,
	r.tag,
	r.depth,
	r.path
FROM tags_rec r
JOIN ( SELECT t.id, v.video_id, t.parent_id, t.user_id, t.tag, t.global, t.created FROM video_tag v JOIN tag t ON ( v.tag_id = t.id ) ) v
	ON ( v.id = r.id OR ( v.parent_id = r.id ) )
WHERE v.video_id = :video_id
GROUP BY
	r.id,
	r.parent_id,
	r.user_id,
	r.tag,
	r.depth,
	r.path
ORDER BY r.path ASC";
// message(strtr($sql, array("\t" => ' ', ':video_id' => "'{$r['id']}'")), true);
	$t = $db->query($sql, array(':video_id' => $r['id']));
	// message($t, true);

	$_title = "{$serial} - ".htmlspecialchars($r['title']);

	$uriCode    = '/'.rawurlencode($r['studio_code']);
	$htmlCode   = htmlspecialchars($r['studio_code']);
	$uriSerial  = '/'.rawurlencode($r['serial']);
	$htmlSerial = htmlspecialchars($r['serial']);
	$uriItem    = "/studio{$uriCode}{$uriSerial}";
	$htmlTitle  = htmlspecialchars($r['title']);
?>
	<table class="list-table" style="margin:auto">
		<thead>
			<tr>
				<th colspan="2"><?php echo "{$htmlCode} {$htmlSerial} — {$htmlTitle}"; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="width:250px"><div style="display:table;width:250px;height:350px;border:1px solid #666;"><div style="display:table-cell;vertical-align:middle;text-align:center;background-color:#EEE">poster/thumb</div></div></td>
				<td>&lt;meta here&gt;</td>
			</tr>
			<tr>
				<td colspan="3">
					[<a href="/tag/add<?php echo $uriCode.'/'.$uriSerial; ?>">Add a tag</a>]
<?php
	// determine number of rows and columns
echo message($t, false, true);
?>
				</td>
			</tr>
		</tbody>
	</table>
<?php
}
?>