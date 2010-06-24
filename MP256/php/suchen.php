<?php
$output .=  "<div id='auswertung'>";
$output .=  "<table>
		   	    <tr>
		    		<th>Betreff</th><th>Kunde</th><th>Problem</th></th><th>Mitarbeiter</th>
		    	</tr>
				<tr>
					<td><input type='text' name='suche_datum' onkeyup='search(\"datum\", this.value)' />
					<td><input type='text' name='suche_betreff' onkeyup='search(\"datum\", this.value)' />
					<td><input type='text' name='suche_problem' onkeyup='search(\"datum\", this.value)' />
					<td><input type='text' name='suche_status' onkeyup='search(\"datum\", this.value)' />
					<td><input type='text' name='suche_supportart' onkeyup='search(\"datum\", this.value)'/>	
			    </tr>
			</table>";
$output .=  "</div>";
?>