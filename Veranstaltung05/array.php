<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$multiCity = array(
    array('City', 'Country', 'Continent'),
    array('Tokyo', 'Japan', 'Asia'),
    array('Mexico City','Mexico', 'North America'),
    array('New York City', 'USA', 'North America'),
    array('Mumbai', 'India', 'Asia'),
    array('Seoul', 'Korea', 'Asia'),
    array('Shanghai', 'China', 'Asia'),
    array('Lagos', 'Nigeria', 'Africa'),
    array('Buenos Aires', 'Argentina', 'South America'),
    array('Cairo', 'Egypt', 'Africa'),
    array('London', 'UK','Europe')
);
?>
<html>
<head>
<title>Multi-dimensional Array</title>
<style type="text/css">
td, th {width: 8em; border: 1px solid black; padding-left: 4px;}
th {text-align:center;}
table {border-collapse: collapse; border: 1px solid black;}
</style>
</head>
 <body>
<h2>Auflistung Array<br /></h2>
 <table>
<thead>
<tr>
<?php
    foreach ($multiCity[0] as $value) {
        echo "<th>".$value."</th>";
    }
?>
</tr>
</thead>
 <?php
    foreach ($multiCity as $value) {
        echo "<tr>";
        foreach ($value as $v) {
            echo "<td>".$v."</td>";
        }
        echo "</tr>";
    }

?>
 </table>
 
<h2>Auflistung der St&auml;dte in Asien<br /></h2>
<pre>
<?php
    print_r(array_filter($multiCity, function ($v) { return $v[2] == "Asia"; }));
?>
</pre>
 
<h2>Auflistung der Kontinente, sowie die Zahl der L&auml;nder darin (im Array)<br /></h2>
<pre>
<?php
    //print_r($level_keys); 
?>
</pre>

<h2>Auflistung nach L&auml;nder A-Z <br /></h2>
<pre>
<?php
    asort($multiCity);
    print_r($multiCity);
?>
</pre>
</body>
</html>