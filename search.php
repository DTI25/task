<?php
	include_once '1.php';
?>
<form action="" method="post">
	<table>
		<tr>
			<td>Имя заметки:</td>
			<td><input type="text" name="task_name" value="<? if (isset($_POST['task_name'])) echo $_POST['task_name']?>"></td>
		</tr>
		<tr>
			<td>Имя пользователя:</td>
			<td><input type="text" name="user_name"></td>
		</tr>
		<tr>
			<td>Статус заметки:</td>
			<td><select name="sel">
				<option value="0">Выберите статус</option>
				<?
					$res = mysql_query("SELECT id,name FROM status");
					while($row = mysql_fetch_array($res)){
				?>
					<option value="<?=$row['id']?>"> <?=$row['name']?> </option>
					<?}?>
				</select></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="search" value="Поиск"></td>
		</tr>
	</table>
</form>

<?php
	if (count($_POST)>0){
		var_dump ($_POST);
		if (isset($_POST['search'])){
		$sql = "SELECT task.id,task.name,task.text,status.name as 'status',task.date,users.name as 'user' FROM task,users,status where id_status=status.id and id_user=users.id";}
		if ($_POST['task_name'] !='') $sql .= " and task.name like '%" . $_POST['task_name'] . "%'";
		if ($_POST['sel'] !='') $sql .= " and status.id= " . $_POST['sel'] ;
		echo $sql;
		$arr = query($link, $sql);
		echo getTable($arr);
		}
	
?>
