<!DOCTYPE html>
<?php
	require_once 'valid.php';
?>	
<html>
	<head>
		<title>Dulaan System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel="stylesheet" href='css/index.css'>
		<script>
			function clickButton(str) {
       if (str == "") {
						document.getElementById("mainBody").innerHTML = "";
						return;
				} else { 
						if (window.XMLHttpRequest) {
								// code for IE7+, Firefox, Chrome, Opera, Safari
								xmlhttp = new XMLHttpRequest();
						} else {
								// code for IE6, IE5
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
										document.getElementById("mainBody").innerHTML = this.responseText;
								}
						};
						xmlhttp.open("GET","view.php?geree="+str,true);
						xmlhttp.send();
				}
			}
		</script>
	</head>
	<body style = "background-color:#ffffff">
		<nav class = "navbar navbar-default navbar-fixed-top">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<img src = "images/logo.png" width = "30px" height = "30px" style =" margin-top: 5px;" />
					<h4 class = "navbar-text navbar-right">Dulaan System</h4>
				</div>
				<a href = "logout.php"> <img src = "images/garah.png" width = "30px" height = "30px" style ="float: right; margin-top: 5px;" /> </a>
			</div>
		</nav>
		<div id="mainBody" class = "container-fluid">
			<div class='mytable'>
				<table id='table' class='table table-bordered'>
						<thead class = "alert-success">
							<tr>
									<th scope='col' rowspan='2'> ДЭХ төрөл</th>
									<th scope='col' rowspan='2'>  УБДС</th>
									<th scope='col' colspan='3'> Хайспийд  </th>
									<th scope='col' rowspan='2'> Зөрүү </th>
							</tr
							<tr>
									<th> Нийт талбай</th>
									<th>Дулаан тооцох</th> 
									<th>Нэхэмжилсэн</th> 
							</tr>
						</thead>
						<tbody>
							<?php
								header('Content-Type: text/html; charset=utf-8');
								require_once "connect.php";
								$sql1 = "SELECT tuluv.name as ner, sum(suugch.niit_talbai) as 'ubds', sum(suugch.niit_talbai) as 'niit_tal', sum(suugch.s_smart) as 'bair', sum(suugch.s_smart) as 'neh', sum(suugch.dulaan_talbai)-sum(suugch.s_smart) as 'zuruu'  FROM dulaan.suugch_info suugch, dulaan.tuluv tuluv WHERE suugch.tuluv_idx=tuluv.idx  group by suugch.tuluv_idx;";
								$sql2 = "SELECT turul.name ner, sum(suugch.niit_talbai) as 'ubds', sum(suugch.niit_talbai) as 'niit_tal', sum(suugch.s_smart) as 'bair', sum(suugch.s_smart) as 'neh', sum(suugch.dulaan_talbai)-sum(suugch.s_smart) as 'zuruu'  FROM dulaan.suugch_info suugch, dulaan.turul turul WHERE suugch.m2type=turul.idx  group by suugch.m2type;";
								$sql3 = "SELECT name,idx FROM dulaan.geree;";
								$result1 = $conn->query($sql1);
								$result2 = $conn->query($sql2);
								$result3 = $conn->query($sql3);
								while($row = mysqli_fetch_array($result1)){
										echo "<tr>";
											echo "<td style='font-weight:bold'>" . $row['ner'] . "</td>";
											echo "<td>" .(int) $row['ubds'] . "</td>";
											echo "<td>" . (int)$row['niit_tal'] . "</td>";
											echo "<td>" . (int)$row['bair'] . "</td>";
											echo "<td>" . (int)$row['neh'] . "</td>";
											echo "<td>" . (int)$row['zuruu'] . "</td>";
										echo "</tr>";
								}
								while($row = mysqli_fetch_array($result2)){
										echo "<tr>";
											echo "<td style='font-weight:bold'>" . $row['ner'] . "</td>";
											echo "<td>" .(int) $row['ubds'] . "</td>";
											echo "<td>" . (int)$row['niit_tal'] . "</td>";
											echo "<td>" . (int)$row['bair'] . "</td>";
											echo "<td>" . (int)$row['neh'] . "</td>";
											echo "<td>" . (int)$row['zuruu'] . "</td>";
										echo "</tr>";
								} 
							?>
						</tbody>
				</table>
			</div>
			<form action=''  method='post' class='myButtons'>
				<?php
					while($row = mysqli_fetch_array($result3)){
						echo "<button onclick='clickButton(this.value)' class='btn btn-primary' style='margin-left: 15px; margin-bottom: 10px; width: 100px;' value=".$row['idx']."+".$row['name']." >".$row['name'] ." </button>";
					}
				?>
			</form>
		</div>
		<nav class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container-fluid">
				<label class = "navbar-text pull-right">Dulaan System &copy; All rights reserved 2018</label>
			</div>
		</nav>
	</body>
	<script src = "js/jquery.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script src = "js/login.js"></script>
	<script src = "js/sidebar.js"></script>
</html>