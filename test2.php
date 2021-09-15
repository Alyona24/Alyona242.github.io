<html>
	<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
   TABLE {
   /* width: 300px; */
    border-collapse: collapse; 
   }
   TD, TH {
    padding: 3px;
    border: 1px solid black;
   }
   TH {
    background: #b0e0e6; 
   }
  </style>
	
<h1>Отдел кадров</h1>


	</head>
//
<form action="test.php" method="get">
<button name="button1">Испытательный срок</button>
<button name="button2">Уволенные</button>
<button name="button3">Начальники</button>

<br/>
<br/>
<body>
<?php
 $con= mysqli_connect("localhost","root","","test");

	 if( isset( $_GET['button1'] ) )
 {
 if (isset($_GET['pageno'])){
   $pageno = $_GET['pageno'];
}else {$pageno = 1;};
echo $pageno;
//$pageno = 1; // текущая страница
$kol = 3;  //количество записей для вывода
$art = ($pageno -1) * $kol; // определяем, с какой записи нам выводить
//echo $art;
$res = mysqli_query($con, "SELECT COUNT(*) FROM `user` WHERE `created_at`> DATE_SUB(CURRENT_DATE(),INTERVAL 8 MONTH) ORDER BY `last_name` ASC ");
$row3 = mysqli_fetch_row($res);
$total = $row3[0]; // всего записей
//echo $total;

$total_pages = ceil($total / $kol);
  //echo $str_pag;
 

 
//for ($i = 1; $i <= $str_pag; $i++){
 // echo "<a href=test.php?page=".$i."> Страница ".$i." </a>";
//}
	
	
$querysubmit1 = "SELECT * FROM `user` WHERE `created_at`> DATE_SUB(CURRENT_DATE(),INTERVAL 8 MONTH) ORDER BY `last_name` ASC  LIMIT $art,$kol;";
$result = mysqli_query($con,$querysubmit1 );
$count = mysqli_num_rows($result);
print "<table>";
print "<tr>";
print "<td>";
print "<b>Фамилия</b>";
print "</td>";
print "<td>";
print "<b>Имя</b>";
print "</td>";
print "<td>";
print "<b>Отчество</b>";
print "</td>";
print "<td>";
print "<b>Дата устройства</b>";
print "</td>";
print "</tr>";
if ($count) {
	while ($row = mysqli_fetch_array($result)){
		print "<tr>";
print "<td>";
print_r($row['last_name']);
print "</td>";
print "<td>";
print_r($row['first_name']);
print "</td>";
print "<td>";
print_r($row['middle_name']);
print "</td>";
print "<td>";
print_r($row['created_at']);
print "</td>";
print "</tr>";

}
print "</table>";}

print "<ul class='pagination'>";
print "<li><a href='?pageno=1'>First</a></li>";
if($pageno <= 1){
	print "<li class= 'disabled'>";};
if($pageno <= 1){
  print "<a href= '#'> Prev </a> ";} 
  else { $pageno--; print "<a href=?pageno=$pageno>Prev</a>";}; 
  print "</li>";
  
  if($pageno >= $total_pages){
  echo  print "<li class='disabled'>";};
  if($pageno >= $total_pages){ echo "<a href=#"; } else { $pageno++;
  print "<li><a href=?pageno=$pageno>Next</a>"; $_GET['pageno'] = ($pageno + 1);};
print "</li>";
 print "<li><a href=?pageno=$total_pages>Last</a></li>";
print "</ul>";

echo $pageno;

} ;echo $pageno;
//};

	 if( isset( $_POST['button2'] ) )
 {

$querysubmit2 = "SELECT user.last_name,user.first_name, user.middle_name ,dismission_reason.description,user_dismission.is_active, user_dismission.created_at FROM `user_dismission` INNER JOIN dismission_reason ON `user_dismission`.`reason_id` = `dismission_reason`.`id` INNER JOIN user ON `user_dismission`.`user_id` = user.id WHERE `is_active` = 0 GROUP BY user_id ;";
$result = mysqli_query($con,$querysubmit2 );
$count = mysqli_num_rows($result);
print "<table>";
print "<tr>";
print "<td>";
print "<b>Фамилия</b>";
print "</td>";
print "<td>";
print "<b>Имя</b>";
print "</td>";
print "<td>";
print "<b>Отчество</b>";
print "</td>";
print "<td>";
print "<b>Дата увольнения</b>";
print "</td>";
print "<td>";
print "<b>Причина увольнения</b>";
print "</td>";
print "</tr>";
if ($count) {
	while ($row = mysqli_fetch_array($result)){
		print "<tr>";
print "<td>";
print_r($row['last_name']);
print "</td>";
print "<td>";
print_r($row['first_name']);
print "</td>";
print "<td>";
print_r($row['middle_name']);
print "</td>";
print "<td>";
print_r($row['description']);
print "</td>";
print "<td>";
print_r($row['created_at']);
print "</td>";
print "</tr>";
}
print "</table>";}

}



	 if( isset( $_POST['button3'] ) )
 {

$querysubmit3 = "SELECT user_position.department_id, department.description, user_position.position_id, user.last_name FROM user_position INNER JOIN user ON user_position.user_id = user.id INNER JOIN department ON user_position.department_id = department.id GROUP BY user_position.department_id  ORDER BY user_position.created_at DESC;";
$result = mysqli_query($con,$querysubmit3 );
$count = mysqli_num_rows($result);
print "<table>";
print "<tr>";
print "<td>";
print "<b>Отдел</b>";
print "</td>";
print "<td>";
print "<b>Фамилия начальника</b>";
print "</td>";
print "<td>";
print "<b>Фамилия сотрудника</b>";
print "</td>";
print "<td>";
print "<b>Дата устройства</b>";
print "</td>";
print "</tr>";

if ($count) {
	while ($row = mysqli_fetch_array($result)){
	$department = $row['department_id'];	
	$querysubmit4 = "SELECT user_position.department_id, user.last_name, user.id, user_position.created_at FROM `user_position` INNER JOIN user ON user_position.user_id = user.id WHERE user_position.department_id = $department ORDER BY user_position.created_at DESC LIMIT 1;";
	$result2 = mysqli_query($con,$querysubmit4 );
	while ($row2 = mysqli_fetch_array($result2)){
		print "<tr>";
print "<td>";
print_r($row['description']);
print "</td>";
print "<td>";
print_r($row['last_name']);
print "</td>";
print "<td>";
print_r($row2['last_name']);
print "</td>";
print "<td>";
print_r($row2['created_at']);
print "</td>";
print "</tr>";
	}}
print "</table>";}

}

?>

</form>
</body>
</html>
