<?php
include_once 'functions_bd.php';
include_once 'functions_task.php';
$link = connect();
if (count($_POST)>0) $data = add_task($link, $_POST['task_name'], $_POST['sel'], $_POST['text']);
//получаем список возможнх статусов
$st_name = status_list($link);
//var_dump($st_name);
$kol_st = count($st_name)-1;
?>

<form method="post">
<table>
		<tr>
			<td>Имя заметки:</td>
			<td><input type="text" name="task_name" value="<? if (isset($_POST['task_name'])) echo $_POST['task_name']?>"></td>
		</tr>
		<tr>
			<td>Описание заметки:</td>
			<td><textarea name="text" rows="5"></textarea value="<? if (isset($_POST['text'])) echo $_POST['text']?>"></td>
		</tr>
		<tr>
			<td>Статус заметки:</td>
			<td><select name="sel">
				<?php
					for ($i=1;$i<=$kol_st;$i++){
						echo "<option value=\"". $st_name[$i]['id'] ."\">" . $st_name[$i]['name'] . "</option>";
					}
				?>
				</select></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="search" value="Добавить"></td>
		</tr>
	</table>
</form>
<?php
