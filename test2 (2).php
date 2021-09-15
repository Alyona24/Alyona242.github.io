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
ul li{
font-size:16 px;
display:inline-block;

}
  </style>
	
<h1>Отдел кадров</h1>


	</head>

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
	 
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else { 
    $pageno = 1;
}
 
$size_page = 3;
$offset = ($pageno-1) * $size_page;
$count_sql = "SELECT COUNT(*) FROM `user` WHERE `created_at`> DATE_SUB(CURRENT_DATE(),INTERVAL 8 MONTH) ORDER BY `last_name` ASC ";
$result = mysqli_query($con, $count_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $size_page);
	
$querysubmit1 = "SELECT * FROM `user` WHERE `created_at`> DATE_SUB(CURRENT_DATE(),INTERVAL 8 MONTH) ORDER BY `last_name` ASC  LIMIT $offset,$size_page;";
$result = mysqli_query($con,$querysubmit1 );
$count = mysqli_num_rows($result);

 if ($count) {
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
print "</table>";
 //}}
 
?>

<ul class="pagination" >
    <li><a href="?button1&pageno=1">Первая страница</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?button1&pageno=".($pageno - 1); } ?>">Предыдущая страница</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?button1&pageno=".($pageno + 1); } ?>">Следующая страница</a>
    </li>
    <li><a href="?button1&pageno=<?php echo $total_pages; ?>">Последняя страница</a></li>
</ul>
<?php
}}
	 if( isset( $_GET['button2'] ) )
 {
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else { 
    $pageno = 1;
}
 
$size_page = 3;
$offset = ($pageno-1) * $size_page;

$count_sql = "SELECT COUNT(*) FROM user_dismission WHERE `is_active` = 0;";
$result = mysqli_query($con, $count_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $size_page);
	
	
$querysubmit2 = "SELECT user.last_name,user.first_name, user.middle_name ,dismission_reason.description,user_dismission.is_active, user_dismission.created_at FROM `user_dismission` INNER JOIN dismission_reason ON `user_dismission`.`reason_id` = `dismission_reason`.`id` INNER JOIN user ON `user_dismission`.`user_id` = user.id WHERE `is_active` = 0 GROUP BY user_id LIMIT $offset,$size_page;";
$result = mysqli_query($con,$querysubmit2 );
$count = mysqli_num_rows($result);
if ($count) {
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
print "</table>";
//}

//}
?>

<ul class="pagination">
    <li><a href="?button2&pageno=1">Первая страница</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?button2&pageno=".($pageno - 1); } ?>">Предыдущая страница</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?button2&pageno=".($pageno + 1); } ?>">Следующая страница</a>
    </li>
    <li><a href="?button2&pageno=<?php echo $total_pages; ?>">Последняя страница</a></li>
</ul>
<?php
}}


	 if( isset( $_GET['button3'] ) )
 {
	 
	 if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else { 
    $pageno = 1;
}
 
$size_page = 3;
$offset = ($pageno-1) * $size_page;

$count_sql = "SELECT COUNT(*) FROM department;";
$result = mysqli_query($con, $count_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $size_page);
	
	
	
$querysubmit3 = "SELECT user_position.department_id, department.description, user_position.position_id, user.last_name FROM user_position INNER JOIN user ON user_position.user_id = user.id INNER JOIN department ON user_position.department_id = department.id GROUP BY user_position.department_id  ORDER BY user_position.created_at DESC LIMIT $offset,$size_page;";
$result = mysqli_query($con,$querysubmit3 );
$count = mysqli_num_rows($result);
if ($count) {
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
print "</table>";
//}}
?>

<ul class="pagination">
    <li><a href="?button3&pageno=1">Первая страница</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?button3&pageno=".($pageno - 1); } ?>">Предыдущая страница</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?button3&pageno=".($pageno + 1); } ?>">Следующая страница</a>
    </li>
    <li><a href="?button3&pageno=<?php echo $total_pages; ?>">Последняя страница</a></li>
</ul>
<?php
}}

?>

</form>
</body>
</html>