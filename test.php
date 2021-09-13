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

<form action="test.php" method="post">
<button name="button1">Испытательный срок</button>
<button name="button2">Уволенные</button>
<button name="button3">Начальники</button>

<br/>
<br/>
<body>
<?php
 $com = mysqli_connect("localhost","root","","test");
//echo "Привет";
//$sname="localhost";
//$uname ="root";
//$pass ="root";
//$dbname ="test";
//test1($sname,$uname,$pass,$dbname);


//function test1($sname,$uname,$pass,$dbname)
//{
	 if( isset( $_POST['button1'] ) )
 {

$page = 1; // текущая страница
$kol = 3;  //количество записей для вывода
$art = ($page * $kol) - $kol; // определяем, с какой записи нам выводить	
	
$querysubmit1 = "SELECT * FROM `user` WHERE `created_at`> DATE_SUB(CURRENT_DATE(),INTERVAL 8 MONTH) ORDER BY `last_name` ASC  LIMIT $art,$kol;";
$result = mysqli_query($com,$querysubmit1 );
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


 if (isset($_GET['page'])){
   $page = $_GET['page'];
}else $page = 1;
$res = mysql_query("SELECT COUNT(*) FROM `user` WHERE `created_at`> DATE_SUB(CURRENT_DATE(),INTERVAL 8 MONTH) ORDER BY `last_name` ASC ");
$row = mysql_fetch_row($res);
$total = $row[0]; // всего записей
$str_pag = ceil($total / $kol);
for ($i = 1; $i <= $str_pag; $i++){
  echo "<a href=lessons.php?page=".$i."> Страница ".$i." </a>";
}
}


	 if( isset( $_POST['button2'] ) )
 {

$querysubmit2 = "SELECT user.last_name,user.first_name, user.middle_name ,dismission_reason.description,user_dismission.is_active, user_dismission.created_at FROM `user_dismission` INNER JOIN dismission_reason ON `user_dismission`.`reason_id` = `dismission_reason`.`id` INNER JOIN user ON `user_dismission`.`user_id` = user.id WHERE `is_active` = 0 GROUP BY user_id ;";
$result = mysqli_query($com,$querysubmit2 );
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

	
$query2 = "INSERT INTO user (`id`, `first_name`, `last_name`, `middle_name`) VALUES (3,'vcfd','dfv','dffv' );";
$query = "SELECT * FROM `user`";
$querysubmit1 = "SELECT * FROM `user` WHERE `created_at`> DATE_SUB(CURRENT_DATE(),INTERVAL 8 MONTH) ORDER BY `last_name` ASC;";
//$querydelete = "SELECT * FROM `user_dismission` WHERE `is_active` = 0;";
//SELECT * FROM `user_dismission` INNER JOIN dismission_reason ON `user_dismission`.`reason_id` = `user_dismission`.`reason_id` WHERE `is_active` = 0;
//$querysubmit2 = "SELECT user_dismission.user_id, user.last_name,user.first_name, user.middle_name,dismission_reason.name,user_dismission.is_active FROM `user_dismission` INNER JOIN dismission_reason ON `user_dismission`.`reason_id` = `dismission_reason`.`id` INNER JOIN user ON `user_dismission`.`user_id` = user.id WHERE `is_active` = 0 GROUP BY user_id ;";
$querysubmit2 = "SELECT user.last_name,user.first_name, user.middle_name ,dismission_reason.description,user_dismission.is_active, user_dismission.created_at FROM `user_dismission` INNER JOIN dismission_reason ON `user_dismission`.`reason_id` = `dismission_reason`.`id` INNER JOIN user ON `user_dismission`.`user_id` = user.id WHERE `is_active` = 0 GROUP BY user_id ;";
$querysubmit3 ="SELECT user_position.department_id, user_position.user_id, user.id, user.last_name, user.created_at FROM user_position INNER JOIN user ON user_position.user_id = user.id GROUP BY user_position.department_id  ORDER BY user_position.created_at DESC;";
//SELECT department.id, department.name, department.leader_id,user_position.user_id FROM `department` INNER JOIN user_position on department.id = user_position.department_id GROUP BY leader_id ORDER BY user_position.created_ad DESC LIMIT 1;

$querysubmit3 = "SELECT user_position.department_id, user_position.position_id, user.last_name FROM user_position INNER JOIN user ON user_position.user_id = user.id GROUP BY user_position.department_id  ORDER BY user_position.created_at DESC;";
$result = mysqli_query($com,$querysubmit3 );
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
		print "<tr>";
print "<td>";
print_r($row['department_id']);
print "</td>";
print "<td>";
print_r($row['last_name']);
print "</td>";
print "</tr>";
}
print "</table>";}

}

?>

</form>
</body>
</html>