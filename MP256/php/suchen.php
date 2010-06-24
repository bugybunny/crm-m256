<?php
$output .=  '<table>
		   	    <tr>
		    		<th>Datum</th><th>Betreff</th><th>Kunde</th></th><th>Supporter</th><th>Supportart</th><th>Status</th>
		    	</tr>
				<tr>
					<td><input type="text" name="suche_datum" onkeyup="search(\'datum\', this.value)" />
					<td><input type="text" name="suche_betreff" onkeyup="search(\'betreff\', this.value)" />
					<td><input type="text" name="suche_kunde" onkeyup="search(\'kunde\', this.value)" />
					<td><input type="text" name="suche_supporter" onkeyup="search(\'supporter\', this.value)" />
					<td><input type="text" name="suche_supportart" onkeyup="search(\'supportart\', this.value)"/>
					<td><input type="text" name="suche_status" onkeyup="search(\'status\', this.value)"/>
			    </tr>
			</table>';

$output .= "<div id='auswertung'></div>";
?>