<?php
	require_once("MySiteDB.php");

	$login = $_POST['login'];
	$password = $_POST['password'];
	//echo $login, $password;"<br>";

	if(($login)&&($password))
	{
		$query = "SELECT * FROM authors WHERE login = '$login' AND password = '$password'";
		$send_query = mysqli_query($link,$query);
		$user_array = mysqli_fetch_array($send_query);
		$login = $user_array['login'];
		$rights = $user_array['rights'];

		$count = mysqli_num_rows($send_query);
		if($count>0)
		{
			session_start();
			$_SESSION['login'] = $login;
			$_SESSION['rights'] = $rights;

			header("refresh:3; url = default.php");
			echo "Вход на сайт автоматически осуществится через 3 секунды или нажмите <a href=\"default.php\">сюда</a>";
		}
		else 
		{
			echo "Извините, Вы не зарегистрированы <a href=\"default.php\">Вернуться на главную</a>.";	
		}
	}

?>