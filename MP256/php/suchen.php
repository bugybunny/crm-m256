<?php
$output .= "<div id='auswertung'>";
check_mitarbeiter();

$output .=  '<table id="tabelle" cellpadding="0" cellspacing="0" width="960px">
				<tbody>
		   	    <tr>
		    		<th>Betreff</th><th>Kunde</th></th><th>Supporter</th><th>Supportart</th><th>Status</th>
		    	</tr>
				<tr>
					<th style="word-break:break-all;word-wrap:break-word" width="125px"><input type="text" id="suche_betreff" onkeyup="search()" /></th>
					<th style="word-break:break-all;word-wrap:break-word" width="125px"><input type="text" id="suche_kunde" onkeyup="search()" /></th>
					<th style="word-break:break-all;word-wrap:break-word" width="125px"><input type="text" id="suche_supporter" onkeyup="search()" /></th>
					<th style="word-break:break-all;word-wrap:break-word" width="125px">'.get_supportart_dropdown2("search()").'</th>
					<th style="word-break:break-all;word-wrap:break-word" width="125px">'.get_status_dropdown("search('status', this.value)").'</th>
			    </tr>
			    </tbody>
			</table>
			<div id="auswertung_resultat" onreadystatechange=search()></div>';
			
$output .= "</div>";
?>