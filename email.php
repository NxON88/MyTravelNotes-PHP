<?php
	session_start();
	if ($_SESSION['rights']==('a')||('u'))
	{
		echo "Доброго времени суток, ".$_SESSION['login']."!";
	
?>

	
		<p><h3>Отправить сообщение автору блога:</h3></p>
		<form method="POST" enctype="multipart/form-data">

			<p><input type="text" name="sbj"><br></p>
			<p><textarea rows="10" cols="40" name="msg"></textarea><br></p>
			<p><input type="submit" name="submit" value="Отправить"></p>

		</form>
		<input  type="button" value="Вернуться на главную" onclick="javascript:window.location='default.php'"/>

<?php
	$sbj = $_POST['sbj'];
	$msg = $_POST['msg'];
	$to = "mail@mail.ru";

	if (($sbj)&&($msg)&&($to)) {
		mail ($to, $msg, $sbj);
	}
}
	else
		{
		echo "Извините, у Вас нет доступа!";
		echo "<a href = \"default.php\"><br>Вернуться на главную</a>";
		}
?>