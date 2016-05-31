<?php
	include_once 'functions_bd.php';
	//список статусов
	function status_list($link){
		$result = array();
		$result = query($link,"SELECT * FROM status");
		return $result;
	}	
	//поиск статусов
	function search_task($link,$task_name,$status_id){
		$result = array();
		$sql = "SELECT task.id,task.name,task.text,status.name as 'status',task.date,users.name as 'user' 
				FROM task,users,status 
				where id_status=status.id and id_user=users.id";
		if ($task_name !='') $sql .= " and task.name like '%" . $task_name ."%'";
		if ($status_id > 0) $sql .= " and status.id = ". $status_id;
		//echo $sql;
		$result = query($link,$sql);
		return $result;
	}
	//редактирование
	function edit_task($id,$task_name,$status_id,$text){
		$sql = "UPDATE task 
			SET text = '".$text. "', name= '" . $task_name . "', id_status=" . $status_id . " 
			WHERE id=" . $id;
		//echo $sql;
		mysql_query($sql) or die("Ошибка добавления: " . mysql_error());
		header('Location: /'); //перенаправление на index
	}
	//удаление
	function delete_task(){
		return true;
	}
	//добавление
	function add_task($link,$task_name,$status_id,$text){
		$sql = "insert into task (name, text, id_status, date, id_user) 
				values('" . $task_name . "','" . $text . "'," . $status_id . ",'" . date("Y-m-d")."',1)";
		//echo $sql;
		mysql_query($sql) or die("Ошибка добавления: " . mysql_error());
		header('Location: /'); //перенаправление на index
	}
	//просмотр заметки
	function info_task($link,$id_task){
		$sql = "select task.id,task.name,task.text,task.id_status, task.date, users.name as u_name 
				from task, users where task.id_user=users.id and task.id=  ". $id_task;
		//echo $sql;
		$result = query($link,$sql);
		return $result;
	}
	

?>