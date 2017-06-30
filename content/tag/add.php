<?php
// get a list of top-level tags
$sql = "SELECT tag FROM tag WHERE parent_id = '0' ORDER BY LOWER(tag) ASC";
$t = $db->query($sql);
// message($t);
?>

<table id="tag-table" class="list-table">
	<thead>
		<tr>
			<th>Level</th>
			<th>Tags</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="text-align:center">0</td>
			<td class="tag-list" data-taglevel="0">
<?php
foreach($t as $tag) {
?>
				<div class="tag"><a href="#" onclick="alert('Not yet implemented.');" title="Click to view child tags"><?php echo htmlspecialchars($tag['tag']); ?></a></div>
<?php
}
?>
				<div class="tag"><input type="text" size="24" maxlength="64" id="newTag_0" /><button onclick="alert('Not yet implemented.');">Add new tag…</button></div>
			</td>
		</tr>
	</tbody>
</table>