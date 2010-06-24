<?php
$output .= "<div id='auswertung'>";
check_mitarbeiter();

$output .=  '<table id="tabelle" cellpadding="0" cellspacing="0" width="960px">
		   	    <tr>
		    		<th>Betreff</th><th>Kunde</th></th><th>Supporter</th><th>Supportart</th><th>Status</th>
		    	</tr>
				<tr id="auswertung_header">
					<th><input type="text" name="suche_betreff" onkeyup="search(\'betreff\', this.value)" /></th>
					<th><input type="text" name="suche_kunde" onkeyup="search(\'kunde\', this.value)" /></th>
					<th><input type="text" name="suche_supporter" onkeyup="search(\'supporter\', this.value)" /></th>
					<th>'.get_supportart_dropdown2("search('supportart', this.value)").'</th>
					<th>'.get_status_dropdown("search('status', this.value)").'</th>
			    </tr>
			    <tr id="auswertung_resultat">
			    </tr>
			</table>';

$output .= "</div>";
?>