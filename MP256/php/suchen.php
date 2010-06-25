<?php
$output .= "<div id='auswertung'>";
check_mitarbeiter();

$output .=  '<table id="tabelle" cellpadding="0" cellspacing="0" width="960px" style="padding-bottom: 0px">
				<tbody>
		   	    <tr>
		    		<th>Betreff</th><th>Kunde</th></th><th>Supporter</th><th>Supportart</th><th>Status</th>
		    	</tr>
				<tr>
					<td style="word-break:break-all;word-wrap:break-word" width="100%"><input class="input_field" type="text" id="suche_betreff" onkeyup="search()" /></td>
					<td style="word-break:break-all;word-wrap:break-word" width="150px"><input class="input_field" type="text" id="suche_kunde" onkeyup="search()" /></td>
					<td style="word-break:break-all;word-wrap:break-word" width="160px"><input class="input_field" type="text" id="suche_supporter" onkeyup="search()" /></td>
					<td style="word-break:break-all;word-wrap:break-word" width="200px">'.get_supportart_dropdown2("search()").'</td>
					<td style="word-break:break-all;word-wrap:break-word" width="140px">'.get_status_dropdown("search('status', this.value)").'</td>
			    </tr>
			    </tbody>
			</table>
			<div id="auswertung_resultat" >'.get_anfrageliste("", "", "", "", "").'</div>';
$output .= "</div>";
?>