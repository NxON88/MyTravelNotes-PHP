<?php require_once ("MySiteDB.php");?>
<!DOCTYPE html>
<html>
	<head class="header">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Главная страница сайта</title>
	</head>
<body>
	
	<form align = "right" method="GET" enctype="mulltipart/form-data">
		<input type="text" name="usersearch" size ="30" placeholder="Поиск по сайту">
		<input type="submit" name="submit" value="Найти"><br>
	</form>

<?php
	//Поиск по одному слову
	/*$user_search = $_GET['usersearch'];
	if(!empty($user_search))
	{
		$query_usersearch = "SELECT * FROM notes
							WHERE title LIKE '%$user_search%'
							OR article LIKE '%$user_search%'";
	}
	$result_usersearch = mysqli_query($link, $query_usersearch);
	while ($array_usersearch = mysqli_fetch_array($result_usersearch))
	{
		echo $array_usersearch['id'];
		echo $array_usersearch['title'];
		echo $array_usersearch['article'];
	}
	*/
	//Поиск по фразе
	$submit = $_GET['submit'];
	if ($submit) {
	$user_search = $_GET['usersearch'];
	//$search_query = "SELECT * FROM tableName"
	$where_list = array();
	$query_usersearch = "SELECT * FROM notes";
	$search_words = explode(' ', $user_search);

	foreach($search_words as $word)
	{
		$where_list[] = " article LIKE '%$word%'";
	}
	$where_clause = implode (' OR ', $where_list);
	if (!empty($where_clause))
	{
		$query_usersearch .=" WHERE $where_clause";
	}
	$res_query = mysqli_query($link, $query_usersearch);
	while ($res_array = mysqli_fetch_array($res_query))
		{
			echo $res_array['id'], "<br>";
			echo $res_array['article'], "<br>", "<hr>", "<br>";
		}
	}
?>
	<div class="navbar">
	<form align="center">
	<input  type="button" value="Вход" onclick="javascript:window.location='login.html'"/>
	<input  type="button" value="Создать новую заметку" onclick="javascript:window.location='newnote.php'"/>
	<input  type="button" value="Отправить сообщение" onclick="javascript:window.location='email.php'"/>
	<input  type="button" value="Добавить фото" onclick="javascript:window.location='photo.php'"/>
	<input  type="button" value="Статистика" onclick="javascript:window.location='inform.php'"/>
	<input  type="button" value="Администратору" onclick="javascript:window.location='admin.php'"/>
	<input  type="button" value="Выход" onclick="javascript:window.location='logout.php'"/>
		</form>
	</div>

	<div class="image">
            
       <img src="img/logo.png" alt="logo">
       
        </div>
	<p><h1 align="center">"Хоббит, <em>или</em> Туда и обратно"</h1></p><br>
	
	<?php
		$query = "SELECT * FROM notes ORDER BY id DESC";
		$select_note = mysqli_query($link, $query);

		while ($note = mysqli_fetch_array($select_note))
		{
			echo $note ['id'],"<br>";?>
			<a href = "comments.php?note=<?php echo $note['id'];?>"><?php echo $note ['title'],"<br>";?></a>
	<?php
			echo $note ['created'],"<br>";
			echo $note ['article'],"<br>";
		}
	?><br><br>

	</body>
</html>