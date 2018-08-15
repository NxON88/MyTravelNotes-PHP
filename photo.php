<?php
	session_start();
	if ($_SESSION['rights']==('a')||('u'))
	{
		echo "Доброго времени суток, ".$_SESSION['login']."!";

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Работа с изображениями</title>
		<meta charset="utf-8">

	</head>
<body>
	<h1>Это страница для работы с изображениями</h1>
	<form name = "file_upload" action="photo.php" enctype="multipart/form-data" method="POST">
	<input type="file" name="file_upload" />
	<input type="hidden" name="MAX_FILE_SIZE" value="65536" />
	<input type="submit" name="submit" value="Добавить" />
</form>
<?php
	if(isset($_POST["MAX_FILE_SIZE"]))
	{
	$tmp_file_name = $_FILES["file_upload"]["tmp_name"];$dest_file_name = $_SERVER['DOCUMENT_ROOT']."/mytravelnotes/photo/".$_FILES["file_upload"]["name"];
	move_uploaded_file($tmp_file_name, $dest_file_name);
	}
?>
	
<?php
	//Получаем полный путь к папке, где хранятся графические файлы
	$image_dir_path = $_SERVER['DOCUMENT_ROOT']."/mytravelnotes/photo";

	//Запускаем просмотр папки
	$image_dir_id = opendir($image_dir_path);
	//Создаем массив, в который будут перемещаться все найденные файлы
	$array_files = null;
	$i=0;
	while(($path_to_file = readdir($image_dir_id)) !==false)
	{
      if(($path_to_file !=".")&&($path_to_file !=".."))
      {
      	$array_files[$i] = basename($path_to_file);
      	$i++;
      }
	}
	closedir($image_dir_id);


	$array_files_count = count($array_files);
	if($array_files_count)
	{
		?>
		<hr/>
	<?php	
		sort($array_files);
		for ($i=0; $i<$array_files_count; $i++)
		{
			?>
			<p><a href="/mytravelnotes/photo/<?php echo $array_files[$i];?>"
	target="_blank"><?php echo $array_files[$i];?></a></p>
	<?php
		}
		?>
		<hr/>
		<?php
	}
?>
	<form name="file_delete" action="photo.php" method="post"
	enctype=" multipart/form-data ">Файл<select name = "file_delete" size="1">

	<?php for ($i=0; $i<$array_files_count; $i++)
	{
	?>
	<option><?php echo $array_files[$i]; ?></option>
	<?php
	}
	?>
	</select>
	<input type="submit" name="submit" value="Удалить"/>
	</form>
	<?php
	//Сценарий удаления файла
	//Сначала проверяем, было ли запущено удаление файла
	if (isset($_POST["file_delete"]))
	{
	//Формируем полное имя файла
	$file_name = $_SERVER['DOCUMENT_ROOT']."/mytravelnotes/photo/".
	$_POST["file_delete"];
	//Функция unlink() удаляет файл
	unlink($file_name);
	}
}
	else
		{
		echo "Извините, у Вас нет доступа!";
		echo "<a href = \"default.php\"><br>Вернуться на главную</a>";
		}
	?><br>

<input  type="button" value="Вернуться на главную" onclick="javascript:window.location='default.php'"/>
</body>
</html>