<?php
include_once 'functions_bd.php';
include_once 'functions_task.php';
$link = connect();

$id = $_GET['id'];
//echo $id;
$info_task = info_task($link,$id);
//var_dump ($info_task[1]);

if (empty($info_task['0'])) {
	echo "По вашему запросу ничего не найдено";
	exit();
	}
if (count($_POST)>0) $data = edit_task($id, $_POST['task_name'], $_POST['sel'], $_POST['text']);
//получаем список возможнх статусов
$st_name = status_list($link);
//var_dump($st_name);
$kol_st = count($st_name)-1;

?>

<form method="post">
<table>
		<tr>
			<td>Имя заметки:</td>
			<td><input type="text" name="task_name" value="<?=$info_task[1]['name'];?>"></td>
		</tr>
		<tr>
			<td>Описание заметки:</td>
			<td><textarea name="text" rows="5"><?=$info_task[1]['text'];?></textarea ></td>
		</tr>
		<tr>
			<td>Статус заметки:</td>
			<td><select name="sel">
				<?php
					for ($i=1;$i<=$kol_st;$i++){
						echo "<option value=\"". $st_name[$i]['id'] ."\"";
						if ($info_task[1]['id_status'] == $st_name[$i]['id']) echo "selected";
						echo ">" . $st_name[$i]['name'] . "</option>";
					}
				?>
				</select></td>
		</tr>
		<tr>
			<td>Дата:</td>
			<td><?=$info_task[1]['date'];?></td>
			
		</tr>
		<tr>
			<td>Пользователь:</td>
			<td><?=$info_task[1]['u_name'];?></td>
			
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="search" value="Редактировать"></td>
		</tr>
	</table>
</form>
