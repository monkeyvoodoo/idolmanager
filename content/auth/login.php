<?php
if(isset($_POST['action']) && $_POST['action'] == 'login') {
	$sql = "SELECT * FROM account WHERE login = :login";
	list($a) = $db->query($sql, array(':login' => $_POST['username']));
	if(password_verify($_POST['password'], $a['password'])) {
		$_SESSION['profile'] = $a;
		redirect('/');
	}
}
?>
<div class="centered-box">
	<div class="content">
	<form action="/auth/login" method="post">
		<table class="list-table">
			<thead>
				<tr>
					<th colspan="2">Log In</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="field-label">Username:</td>
					<td><input type="text" name="username" placeholder="Username" size="24" maxlength="256" /></td>
				</tr>
				<tr>
					<td class="field-label">Password:</td>
					<td><input type="password" name="password" placeholder="Password" size="24" maxlength="256" /></td>
				</tr>
			</tbody>
		</table>
		<div style="text-align:right;margin-top:1em"><button type="submit">Log In</button></div>
		<input type="hidden" name="action" value="login" />
	</form>
	</div>
</div>