<?php require_once("MySiteDB.php");
	$query_allauthors = "SELECT COUNT(id) AS allauthors FROM authors";
	$allauthors = mysqli_query ($link, $query_allauthors) or die(mysqli_error());
	$row_allauthors = mysqli_fetch_assoc ($allauthors);
	$allauthors_num = $row_allauthors['allauthors'];
	mysqli_free_result ($allauthors);
?>

<p>Количество зарегистрированных пользователей:</p>
		<hr noshade width="330" align="left">
		Количество пользователей: <?php echo $allauthors_num;?>;<br>

<p><h3>Добавление нового пользователя</h3></p>
<form action="newUser.php" method="POST" enctype="multipart/form-data">
	<p>Введите логин:<input type="text" name="login"></p><br>
	<p>Введите пароль:<input type="text" name="password"></p>
	<p>Выберите права пользователя:</p>
	<p><input type="radio" name="rights" value="a">Администратор</p>
	<p><input type="radio" name="rights" value="u">Пользователь</p>
	<p><input type="submit" name="submit" value="Добавить"></p>
</form>
<p><input  type="button" value="Вернуться на главную" onclick="javascript:window.location='default.php'"/></p>