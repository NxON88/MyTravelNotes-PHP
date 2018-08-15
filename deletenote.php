<?php
	session_start();
	if ($_SESSION['rights']=='a')
	{
		echo "Доброго времени суток, ".$_SESSION['login']."!";
	
?>
<?php
	require_once("MySiteDB.php");
	$note_id = $_GET['note'];
	$query = "DELETE FROM notes WHERE id = $note_id";
	$result = mysqli_query ($link, $query);
?>

<?php 
	$submit = $_POST['submit'];
	if(isset($_GET['note'])){ 
		$result = "DELETE FROM notes WHERE id = $note_id"; 
	} 
if($submit) 
    {  
    $query = "DELETE FROM notes WHERE id = $note_id"; 
    $res = mysqli_query($link, $query); 
      if($res) { 
      
      echo "Deleted!"; 
      }   
    }
  } 
    else
		{
		echo "Извините, у Вас нет доступа!";
		echo "<a href = \"default.php\"><br>Вернуться на главную</a>";
		}
?> 
<p><form action="" method="POST">
<input type="hidden" name="del_note" value="$note_id" />
<input  type="button" value="Удаление заметки" onclick="javascript:window.location='default.php'"/>
</form></p>