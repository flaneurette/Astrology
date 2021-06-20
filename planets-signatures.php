<?php

$servername = "localhost";
$username = "";
$password = "";
$dbname = "astrology";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$year = (int)$_REQUEST['year'];
$month = (int)$_REQUEST['month'];

function format_year($str) {
	$era = ' CE';
	return str_replace('-'.str_replace('-','',$str),str_replace('-','',$str.$era),$str);
}

$planets = array(
	'', 
	'Sun', # 0
	'Moon', # 1
	'Mercury', # 2
	'Venus', # 3
	'Mars', # 4
	'Jupiter', # 5
	'Saturn', # 6
	'Uranus', # 7
	'Neptune', # 8
	'Pluto', # 9
	'Chiron', # 10
	'Lilith' # 11
);

$signs = array ('','Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo', 'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces');

$planetslist = array(
	 0 => 'Sun',
	 1=> 'Moon',
	 2=> 'Mercury',
	 3=> 'Venus',
	 4=> 'Mars',
	 5=> 'Jupiter',
	 6=>'Saturn',
	 7=> 'Uranus',
	 8=> 'Neptune',
	 9=> 'Pluto',
	 10=> 'Chiron',
	 11=> 'Lilith'
);

$signslist = array (
	1=> 'Aries', 
	2=> 'Taurus', 
	3=> 'Gemini', 
	4=> 'Cancer', 
	5=> 'Leo', 
	6=> 'Virgo', 
	7=> 'Libra', 
	8=> 'Scorpio', 
	9=> 'Sagittarius', 
	10=> 'Capricorn', 
	11=> 'Aquarius', 
	12=> 'Pisces'
);
	
		
function getplanetlist($planet,$sign,$year,$month,$options,$conn) {


			$sig = array();

			$sql = "SELECT * FROM astrology_months where month = '".$month."' and year = '".$year."'";
			$result = $conn->query($sql) or die(mysqli_error($conn));
		
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					array_push($sig,array($row['planet'],$row['sign']));
				}
				
			}
			
            $glyphs = array(
			'',
			'&#9800;', 
            '&#9801;',
            '&#9802;',
            '&#9803;',
            '&#9804;',
            '&#9805;',
            '&#9806;',
            '&#9807;',
            '&#9808;',
            '&#9809;',
            '&#9810;',
            '&#9811;');
			
			$qq = '';
			
			for($q=0;$q<count($sig);$q++) {
				$qq .= "' and planet = '".$sig[$q][0]."' and sign = '".$sig[$q][1]."' ";
			}
			
			$i=1;
				
			$sql = "SELECT * FROM astrology_months where 1 ".$qq." order by year DESC";
			//echo $sql;
			$result = $conn->query($sql) or die(mysqli_error($conn));
			
			if ($result->num_rows > 0) {
				$list = "<br><table>";
				while($row = $result->fetch_assoc()) {	
						if($row['retrograde'] == '1') {
							$rg = " R ";
							} else {
							$rg = "";
						}
						$list .= "<tr><td>".$glyphs[$row['planet']]."</td><td>".$glyphs[$row['sign']]."</td><td>".$row['year']."</td><td>".$row['month']."</td><td>".$rg."</td></tr>";			
						$i++;			
				}
				$list .= "</table>";
			}
			
			return $list;
}

?>
<!DOCTYPE html>
<html lang="en" >
<head><meta name="viewport" content="width=device-width, initial-scale=0.73">
  <meta charset="UTF-8">
  <title>Planets signatures</title>

<style>
.container {
	padding:10px;	
}
.vis-overlay {
	padding:10px;
}

table {
clear:both;
	margin:7px;
}
* {
	
}
</style>
</head>
<body>
<br>

<div id="nav">
<form name="" action="" method="POST">

	<input type="text" name="start" value="<?=$year;?>" size="10">
	<input type="text" name="end" value="<?=$year;?>" size="10">
	<select name="planet">
	<?
		for($k=0;$k<count($signslist);$k++) {
			//echo "<option value='".$planetslist[$k]."'>".$planetslist[$k]."</option>";
		}
	?>
	</select>
	<select name="opt">
		<option value="graphs">Graphs</option>
		<option value="table">Table</option>
	</select>
	<input type="submit" name="submit" value="submit">
</form>
</div>


<div id="visualization"></div>

<?

echo "<h3>".$year." - ".$month."</h3>";
echo "<div id=\"visualization\"></div>";

echo getplanetlist($planettoshow,$i,$year,$month,$options,$conn).'<hr/>';


?>
</body>
</html>