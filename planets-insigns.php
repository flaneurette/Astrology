<?php

$servername = "localhost";
$username = "";
$password = "";
$dbname = "astrology";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname) or die('error');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$yearstart = date("Y");
$yearend = date("Y")+100;

$planettoshow = ucfirst(strtolower($_REQUEST['planet']));
$signtoshow = ucfirst(strtolower($_REQUEST['sign']));
$yearstart = intval($_REQUEST['start']);
$yearend = intval($_REQUEST['end']);

$planettoshow  	= preg_replace('/[^a-zA-Z]/','', $planettoshow);
$signtoshow 	= preg_replace('/[^a-zA-Z]/','', $signtoshow);


if(isset($yearstart) && $yearstart == 0) {
	$yearstart = date("Y");
}

if(isset($yearend) && $yearend == 0) {
	$yearend = date("Y")+100;
}


$options =  preg_replace('/[^a-zA-Z]/','', $_REQUEST['opt']);


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
	0=>'',
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

			
function getplanetlist($planet,$sign,$yearstart,$yearend,$signslist,$planetslist,$options,$conn) {

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
	
			$sortyear = $yearstart;
			$endyear = $yearend;
			
			$pl = array_search($planet,$planetslist,true);
			$si = array_search($sign,$signslist,true);
			$i=1;
			$sql = "SELECT * FROM astrology_months where planet = '".$pl."' and sign = '".$sign."' and year >= '".$sortyear."' and year <= '".$endyear."'  group by year";
			//echo $sql;
			$result = $conn->query($sql) or die(mysqli_error($conn));
			
			//var_dump($result);

			if ($result->num_rows > 0) {
				
				if($options == 'graphs') {
					$list = '';
					} else {
					$list = "<br><table>";
				}
			
				while($row = $result->fetch_assoc()) {
					
						if($row['retrograde'] == '1') {
							$rg = " R ";
							} else {
							$rg = "";
						}

						if($options == 'graphs') {
							$list .= "{id: ".$i.", text: '".$glyphs[$row['sign']]."', start: new Date(".$row['year'].",".$row['month'].",".$row['day']."), type:'point'},";
							} else {
							$list .= "<tr><td>".$glyphs[$row['sign']]."</td><td>".$row['year']."</td><td>".$rg."</td></tr>";
						}
										
					$i++;			
				}
				

			if($options == 'graphs') {
				$list .= '';
				} else {
				$list .= "</table>";
			}
			}

				
			return $list;
}



?>
<!DOCTYPE html>
<html lang="en" >
<head><meta name="viewport" content="width=device-width, initial-scale=0.73">
  <meta charset="UTF-8">
  <title>Planets in signs</title>
<script src="lib/vis.js"></script>
<link href="lib/vis-timeline-graph2d.min.css" rel="stylesheet" type="text/css" />

	
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

#visualization {
	margin:0px;
}
</style>
</head>
<body>
<div id="nav">
<h2>Enter a date and select an object.</h2>
<form name="" action="" method="POST">

	<input type="text" name="start" value="<?php echo $yearstart;?>" size="10">
	<input type="text" name="end" value="<?php echo $yearend;?>" size="10">
	<select name="planet">
	<?php
		for($k=0;$k<count($signslist);$k++) {
			echo "<option value='".$planetslist[$k]."'>".$planetslist[$k]."</option>";
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
<h4>To zoom, place mouse cursor on graph, click graph and then use the scroll wheel to zoom in and out.</h4>

<?php

if($signtoshow != '') {
$si = array_search($signtoshow,$signslist,true);

?>

<div id="visualization">
<?php

echo "<h1>".$planettoshow." in ".$signtoshow."</h1>";
echo "<h3>".$yearstart." - ".$yearend."</h3>";
?>
</div>


	<?php
	if($options == 'graphs') {
	?>
	<script type="text/javascript">

	  var items = new vis.DataSet([
		<?php echo getplanetlist($planettoshow,$si,$yearstart,$yearend,$signslist,$planetslist,$options,$conn); ?> 
	  ]);
	  
		function createTimeline(main) {
	   var main = document.getElementById('visualization');
		var container = document.createElement('div');
		container.className = 'container';
		main.appendChild(container);
		
		var options = {
		  editable: true,
		  clickToUse: true
		};

		return new vis.Timeline(container, items, options);
	  }

	  var timelines = [];
	// for (var i = 0; i < 11; i++) {
	timelines.push(createTimeline());
	// }
	</script>
	<?php
	} else {
		echo $signs[$i];
		echo getplanetlist($planettoshow,$si,$yearstart,$yearend,$signslist,$planetslist,$options,$conn).'<hr/>';
	}

} else {
	
$si = array_search($planettoshow,$planetslist,true);
echo $glyphs[$si];
echo "<h1>".$planettoshow."</h1>";
echo "<h3>".$yearstart." - ".$yearend."</h3>";
echo "<div id=\"visualization\"></div>";

// in which sign do we start? good to know.
$ls = (int)$_REQUEST['loopstart'];

if(isset($ls)) {
	$i=$ls;
	} else {
	$i=0;
}

for($i;$i<=count($signs)-1;$i++) {
	
	if($options == 'graphs') {
	?>
	
	<script type="text/javascript">
	  var items = new vis.DataSet({
		start: new Date(<?php echo date("Y");?>, <?php echo date("m");?>, <?php echo date("d");?>)
	  });
	  
	  items.add([
		<?php echo getplanetlist($planettoshow,$i,$yearstart,$yearend,$signslist,$planetslist,$options,$conn); ?>
	  ]);
	  
	  var main = document.getElementById('visualization');
	  var container = document.createElement('div');
	  container.className = 'container';
	  main.appendChild(container);
	  
	  var h = document.createElement("H1");  
	  var t = document.createTextNode('<?php echo $signs[$i];?>');    
	  h.appendChild(t); 
	  container.appendChild(h);

	  var options = {
		  editable: true,
		  clickToUse: true,
		  minHeight: '110px',
	  };
	  
	  new vis.Timeline(container, items, options);
	  
	</script>

		<?php
		} else {
			echo "<h3>".$signs[$i]."</h3>";
			echo getplanetlist($planettoshow,$i,$yearstart,$yearend,$signslist,$planetslist,$options,$conn).'<hr/>';
		}

}

if(isset($ls)) {
	
	$remainder = $ls;

	for($k=0;$k<$remainder;$k++) {
		echo getplanetlist($planettoshow,$k,$yearstart,$yearend,$signslist,$planetslist,$options,$conn).'<hr/>';
	}
	
}




}
?>



</body>

</html>