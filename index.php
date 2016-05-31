<?php
include_once 'functions_bd.php';
include_once 'functions_task.php';
$link = connect();
//получаем список возможнх статусов
$st_name = status_list($link);
//var_dump($st_name);
$kol_st = count($st_name)-1;
?>
<form action="" method="post">
	<table>
		<tr>
			<td>Имя заметки:</td>
			<td><input type="text" name="task_name" value="<? if (isset($_POST['task_name'])) echo $_POST['task_name']?>"></td>
		</tr>
		<!--<tr>
			<td>Имя пользователя:</td>
			<td><input type="text" name="user_name"></td>
		</tr>-->
		<tr>
			<td>Статус заметки:</td>
			<td><select name="sel">
				<option value="0">Выберите статус</option>
				<?php
					for ($i=1;$i<=$kol_st;$i++){
						echo "<option value=\"". $st_name[$i]['id'] ."\"";
						if (isset($_POST['sel']) && ($_POST['sel'] == $st_name[$i]['id'])) echo "selected";
						echo ">" . $st_name[$i]['name'] . "</option>";
					}
				?>
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
if (count($_POST)>0) $data = search_task($link, $_POST['task_name'], $_POST['sel']);
else $data = search_task($link,'',0);
if (!empty($data['0'])) echo getTable($data);
else echo "По вашему запросу ничего не найдено";
//var_dump ($data);
//echo getTable($data2);

