<?php
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . "/mytravelnotes/photo";
$image_dir_id = opendir($image_dir_path);
$array_files = null;
$i = 0;
while(($path_to_file = readdir($image_dir_id)) !== false)
{
if(($path_to_file !=".") && ($path_to_file !=".."))
{
$array_files[$i] = basename($path_to_file);
$i++;
}
}
closedir($image_dir_id);
?>

<?php
$array_files_count = count($array_files);
if ($array_files_count)
{
?>
<hr />
<?php
sort($array_files);
for ($i=0; $i<$array_files_count; $i++)
{
?>
<p><a href="/mytravelnotes/photo/<?php echo $array_files[$i]; ?>"
target="_blank">
<?php echo $array_files[$i]; ?></a></p>
<?php
}
?>
<hr />
<?php
}
?>

<form name = "file_upload" action="photo1.php"
enctype="multipart/form-data" method="post">
<input type="file" name="file_upload" />
<input type="hidden" name="MAX_FILE_SIZE" value="65536" />
<input type="submit" name="submit" value="Добавить" />
</form>

<?php
if (isset($_POST["MAX_FILE_SIZE"]))
{
$tmp_file_name = $_FILES["file_upload"]["tmp_name"];
$dest_file_name = $_SERVER['DOCUMENT_ROOT'].
"/mytravelnotes/photo/".$_FILES["file_upload"]["name"];
move_uploaded_file($tmp_file_name, $dest_file_name);
}
?>

<form name="file_delete" action="photo1.php" method="post"
enctype=" multipart/form-data ">
Файл <select name = "file_delete" size="1">
<option><option></select>
<input type="submit" name="submit" value="Удалить" />
</form>

<form name="file_delete" action="photo1.php" method="post"
enctype=" multipart/form-data ">
Файл <select name = "file_delete" size="1">
<?php for ($i=0; $i<$array_files_count; $i++)
{
?>
<option><?php echo $array_files[$i]; ?></option>
<?php
}
?>
</select>
<input type="submit" name="submit" value="Удалить" />
</form>

<?php
if (isset($_POST["file_delete"]))
{
$file_name = $_SERVER['DOCUMENT_ROOT'] . "/mytravelnotes/photo/".
$_POST["file_delete"];
unlink($file_name);
}
?>