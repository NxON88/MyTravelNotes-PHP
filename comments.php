<?php
	session_start();
	if($_SESSION['rights']==('a')||('u'))
	{
		echo "Доброго времени суток, ".$_SESSION['login']."!";
	
?>
<?php 
require_once("MySiteDB.php");
?>
<h1>Заметка о путешествии</h1>

<?php
	$note_id = $_GET['note'];

	$query = "SELECT created,title,article FROM notes WHERE id = $note_id";
	$select_comments_info = mysqli_query($link, $query);
			while ($comments_info = mysqli_fetch_array($select_comments_info))
		{	
			echo $comments_info ['created'],"<br>";	
			echo $comments_info ['title'],"<br>";
			echo $comments_info ['article'],"<br>";
		}
		/*$query_view = "CREATE VIEW CommentsView AS 
		SELECT comments.id, comments.created, comments.comment, 
		comments.art_id, authors.login  FROM comments INNER JOIN authors  ON comments.author_id = authors.id";*/

		$query_comments = "SELECT * FROM commentsView WHERE art_id = $note_id ORDER BY created ASC";
?>
	<p><input  type="button" value="Изменить заметку" onclick="javascript:window.location='editnote.php?note=<?php echo $note_id;?>'"/>
	<input  type="button" value="Удалить заметку" onclick="javascript:window.location='deletenote.php?note=<?php echo $note_id;?>'"/></p><br>
	<input  type="button" value="Вернуться на главную" onclick="javascript:window.location='default.php'"/>
	
	<h2>Комментарии к заметке</h2>
<?php
	//Отображение комментариев
	$select_comments = mysqli_query($link, $query_comments);
		while ($comments = mysqli_fetch_array($select_comments)); 
		{
			echo $comments ['id'], "<br>";
			echo $comments ['created'];
			echo $comments ['author_id'], "<br>";
			echo $comments ['login'], "<br>";
			echo $comments ['comment'], "<br>";
			echo $comments ['art_id'], "<br>", "<br>";
		}

		$a = mysqli_num_rows($select_comments); 
		if ($a) 
		{
			echo "Комментариев к заметке:";
			print_r ($a);		
		}
		else 
		{
			echo "Эту запись еще никто не комментировал!";
		}
		
?><br>
		<h2>Добавьте новый комментарий</h2>
	<form method="POST" enctype="multipart/formdata">
		<p>Введите id автора:</p><input type="text" name="author_id" size="20"></p>
		<p>Текст комментария:<br><textarea rows="10" cols="60" name="comment"></textarea></p>
		<input type="hidden" name="created_comm"
							value="<?php echo date("Y-m-d H:i:s");?>"/>
		<input type="submit" name="submit" value="Отправить"><br>
	</form>
<?php 
		//Добавление комментариев
		$author_id = $_POST['author_id'];
		$comment = $_POST['comment'];	
		$created = $_POST['created_comm'];
		if(($author_id)&&($comment)&&($created))
		{
			$comment_query = "INSERT INTO comments (id, created, author_id, comment, art_id)
						VALUES (NULL, '$created', '$author_id', '$comment', '$note_id')";
			$comment_result = mysqli_query($link, $comment_query);
		}

		if($comment_result)
		{
			echo "\<meta http-equiv=\"refresh\"content=\"0;URL=comments.php?note=".$note_id."\">";
		}
}
else
		{
		echo "Извините, у Вас нет доступа!";
		echo "<a href = \"default.php\"><br>Вернуться на главную</a>";
		}		
?>