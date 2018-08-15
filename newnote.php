<?php
	session_start();
	if ($_SESSION['rights']=='a')
	{
		echo "Доброго времени суток, ".$_SESSION['login']."!";

?>
<?php require_once ("MySiteDB.php");?>
<!DOCTYPE html>
<html>
	<head>
		<title>Добавить новую заметку</title>
	</head>
	<body>
		<p><h3>Создать новую заметку</h3></p>
		<form method="POST" enctype="multipart/form-data">
			<p><input type="text" name="title" size="30" maxlength="30"><br></p>
			<p><textarea rows="10" cols="55" name="article"></textarea><br></p>
			<p><input type="hidden" name="created" value="<?php echo date("Y-m-d");?>"></p>
			<p><input type="submit" name="submit" value="Отправить"></p><br>
		</form>

		</body>
</html>
<?php
	$title = $_POST['title'];
	$created = $_POST['created'];
	$article = $_POST['article'];

	if (($title)&&($created)&&($article)) {
	$query = "INSERT INTO notes (id, created, title, article)
	VALUES (NULL, '$created', '$title', '$article')";
	
	$result = mysqli_query($link, $query);
	}
}
	else
		{
		echo "Извините, у Вас нет доступа!";
		echo "<a href = \"default.php\"><br>Вернуться на главную</a>";
		}
?>
<?php
	/*$var = $_GET['MyRadio'];
	switch ($var)
	{
		case 'Rome':
			echo "You choose $var";
				break;
		case 'Paris':
			echo "You choose $var";
				break;
		case 'Moscow':
			echo "You choose $var";
				break;	
		
	}
?>
<?php
	$arr = $_GET['MyCheckBox'];
		if(empty($arr))
		{
			echo "Вы не выбрали ни один вариант!";
		}
		else 
		{
			$count=count($arr);
			echo "Вы выбрали:"."<br>";
			for($i=0; $i<$count; $i++)
			{
				echo $arr[$i]."<br>";
			}
		}*/

?>