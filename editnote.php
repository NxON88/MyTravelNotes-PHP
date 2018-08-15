<?php
	session_start();
	if ($_SESSION['rights']=='a')
	{
		echo "Доброго времени суток, ".$_SESSION['login']."!";
	
?>
<?php
	require_once("MySiteDB.php");
	$note_id = $_GET['note'];
	$query = "SELECT * FROM notes WHERE id=$note_id";
	$result = mysqli_query ($link, $query);
	$edit_note = mysqli_fetch_array ($result);
?>

	<h2>Редактирование заметки</h2>
	<form method="POST">
		<p>Заголовок заметки:</p> 
		<p><input type="text" name="title" value="<?php echo $edit_note['title'];?>"></p>
		<p>Текст заметки:</p>
		<p><textarea name="article"><?php echo $edit_note['article'];?></textarea></p>
		<input type="hidden" name="note" value="<?php echo $edit_note['id'];?>">
		<input type="submit" name="submit" value="Изменить">
	</form><br>
	
	<input  type="button" value="Вернуться на главную" onclick="javascript:window.location='default.php'"/>
<?php
	$title = $_POST['title'];
	$article = $_POST['article'];
		if (($title)&&($article)) 
		{
			$update_query = "UPDATE notes SET title = '$title', article = '$article' WHERE id = $note_id";
			$update_result = mysqli_query($link, $update_query);
		}
?>

<?php
	if($update_result) {
		echo "\<meta http-equiv=\"refresh\"content=\"0;URL=editnote.php?note=".$note_id."\">";
	}
}
	else
		{
		echo "Извините, у Вас нет доступа!";
		echo "<a href = \"default.php\"><br>Вернуться на главную</a>";
		}
?>


