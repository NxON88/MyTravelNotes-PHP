<?php
	session_start();
	if ($_SESSION['rights']=='a')
	{
		echo "Доброго времени суток, ".$_SESSION['login']."!";
?>
<?php require_once("MySiteDB.php");?>
<?php
	//Вычисление количества заметок
	$query_allnotes = "SELECT COUNT(id) AS allnotes FROM notes";
	$allnotes = mysqli_query ($link, $query_allnotes) or die(mysqli_error());
	$row_allnotes = mysqli_fetch_assoc ($allnotes);
	$allnotes_num = $row_allnotes['allnotes'];
	mysqli_free_result ($allnotes);

	//Вычисление количества комментариев
	$query_allcomments = "SELECT COUNT(id) AS allcomments FROM comments";
	$allcomments = mysqli_query ($link, $query_allcomments) or die
	(mysqli_error());
	$row_allcomments = mysqli_fetch_assoc ($allcomments);
	$allcomments_num = $row_allcomments['allcomments'];
	mysqli_free_result ($allcomments);

	//Работа с датой
	$date_array = getdate();
	$begin_date = date ("Y-m-d", mktime(0,0,0, $date_array['mon'],1,
	$date_array['year']));
	$end_date = date ("Y-m-d", mktime(0,0,0, $date_array['mon'] + 1,0,
	$date_array['year']));

	//Заметки за последний месяц
	$query_lmnotes = "SELECT COUNT(id) AS lmnotes FROM notes
	WHERE created>='$begin_date' AND created<='$end_date'";
	$lmnotes = mysqli_query ($link, $query_lmnotes)or die (mysqli_error());
	$row_lmnotes = mysqli_fetch_assoc ($lmnotes);
	$lmnotes_num = $row_lmnotes['lmnotes'];
	mysqli_free_result ($lmnotes);

	//Комментарии за послений месяц
	$query_lmcomments = "SELECT COUNT(id) AS lmcomments FROM comments
	WHERE created >= '$begin_date' AND created <=
	'$end_date'";
	$lmcomments = mysqli_query ($link, $query_lmcomments)or die (mysqli_error());
	$row_lmcomments = mysqli_fetch_assoc ($lmcomments);
	$lmcomments_num = $row_lmcomments['lmcomments'];
	mysqli_free_result ($lmcomments);

	//Последняя добавленная заметка
	$query_last_note = "SELECT id, title FROM notes
	ORDER BY created DESC LIMIT 0,1";
	$lastnote = mysqli_query ($link, $query_last_note) or die (mysqli_error());
	$row_lastnote = mysqli_fetch_assoc ($lastnote);
	mysqli_free_result ($lastnote);

	//Самая комментируемая заметка
	$query_mcnote = "SELECT notes.id, notes.title FROM comments, notes
	WHERE comments.art_id=notes.id
	GROUP BY notes.id
	ORDER BY COUNT(comments.id) DESC LIMIT 0,1";
	$mcnote = mysqli_query($link, $query_mcnote)or die (mysqli_error());
	$row_mcnote = mysqli_fetch_assoc($mcnote);
	mysqli_free_result ($mcnote);
}
	else
		{
		echo "Извините, у Вас нет доступа!";
		echo "<a href = \"default.php\"><br>Вернуться на главную</a>";
		}
?>


		<h2>Страница статистики</h2>
		<style type="text/css">
			.div {
				width: 400px;
				height: 250px;
				margin: 30px;
				border: 1.5px solid;
				background-color: #F8F8FF;
			}
		</style>
	
	
	<div class="div">
		<p>Полезная информация:</p>
		<hr noshade width="380" align="left">
		Сделанно записей -<?php echo $allnotes_num;?>;<br>
		Оставленно комментариев -<?php echo $allcomments_num;?>;<br>
		За последний месяц я создал записей -<?php echo $row_lmnotes['lmnotes']?>;<br>
		За последний месяц оставленно комментариев -<?php echo $row_lmcomments['lmcomments']?>;<br>
		Моя последняя запись -<a href="comments.php?note=<?php echo $row_lastnote['id'];?>"><?php echo $row_lastnote['title'];?></a><br>
		Самая обсуждаемая запись - <a href="comments.php?note=<?php echo $row_mcnote['id'];?>"><?php echo $row_mcnote['title'];?></a><br><br>

	<p><input  type="button" value="Вернуться на главную" onclick="javascript:window.location='default.php'"/></p>
	</div>