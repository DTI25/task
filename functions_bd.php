<?php
function getTable($xo) {
	$num = 0;
    $result = '<table border="1">';
    foreach ($xo as $row) {
        $result .= '<tr>';
        foreach ($row as $key => $value) {
            if ($key == $value)
                $result .= "<th>$value</th>";
            else
                $result .= "<td>$value</td>";
        }
		if ($num>0)	$result .='<td> edit <br> delete</td>';
		else{
			$result .='<td> &nbsp;</td>';
			$num++;
		}
		$result .= '</tr>';
    }
    $result .= '</table>';
    return $result;
}

function connect() {
    $link = mysql_connect('localhost', 'tadu', 'tadutadu');
    $db   = mysql_select_db('tadu', $link); 
    return $link;
}

function query($link, $query) {
    $res = mysql_query($query, $link);        
	if (is_bool($res)) return $res;
    $data = array(
        0 => array()
    );
	$i = 1;
    while ($row = mysql_fetch_array($res)) {
        //var_dump($row);
        foreach ($row as $key => $value) {
            if (is_string($key)) {
                $data[$i][$key] = $value;
                $data[0][$key] = $key;
            }
        }
        $i++;
    }
    return $data;
}