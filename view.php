<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once "connect.php";
	$geree = 4225;
	$sql12 = "SELECT turul.name ner, sum(suugch.niit_talbai) as 'ubds', sum(suugch.niit_talbai) as 'niit_tal', sum(suugch.s_smart) as 'bair', sum(suugch.s_smart) as 'neh', sum(suugch.dulaan_talbai)-sum(suugch.s_smart) as 'zuruu'  FROM dulaan.suugch_info suugch, dulaan.turul turul, dulaan.hothon hothon, dulaan.geree geree WHERE suugch.m2type=turul.idx and  geree.name='$geree' and suugch.hothon_idx = hothon.idx and hothon.geree_idx=geree.idx  group by suugch.m2type;";
	$sql11 = "SELECT tuluv.name ner, SUM(suugch.niit_talbai) AS 'ubds',SUM(suugch.niit_talbai) AS 'niit_tal', SUM(suugch.s_smart) AS 'bair', SUM(suugch.s_smart) AS 'neh', SUM(suugch.dulaan_talbai) - SUM(suugch.s_smart) AS 'zuruu'FROM dulaan.suugch_info suugch, dulaan.tuluv tuluv, dulaan.hothon hothon, dulaan.geree geree WHERE suugch.tuluv_idx = tuluv.idx AND geree.name = '$geree' AND suugch.hothon_idx = hothon.idx AND hothon.geree_idx = geree.idx GROUP BY suugch.tuluv_idx;";
	$sql3 = "SELECT name,idx FROM dulaan.geree;";
	$result11 = $conn->query($sql11);
	$result12 = $conn->query($sql12);
?>
<table class='table table-bordered table-hover table-striped' style='width: 650px'>
	<thead>
		<tr>
			<th scope='col' rowspan='2'> ДЭХ төрөл</th>
			<th scope='col' rowspan='2'>  УБДС</th>
			<th scope='col' colspan='3'> Хайспийд  </th>
			<th scope='col' rowspan='2'> Зөрүү </th>
		</tr>
		<tr> 
			<th> Нийт талбай</th>
			<th>Дулаан тооцох</th> 
			<th>Нэхэмжилсэн</th> 
		</tr>
	</thead>
	<tbody>
		<?php
		while($row = mysqli_fetch_array($result11)){
			echo "<tr>";
				echo "<td style='font-weight:bold'>" . $row['ner'] . "</td>";
				echo "<td>" .(int) $row['ubds'] . "</td>";
				echo "<td>" . (int)$row['niit_tal'] . "</td>";
				echo "<td>" . (int)$row['bair'] . "</td>";
				echo "<td>" . (int)$row['neh'] . "</td>";
				echo "<td>" . (int)$row['zuruu'] . "</td>";
			echo "</tr>";
		}
		while($row = mysqli_fetch_array($result12)){
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