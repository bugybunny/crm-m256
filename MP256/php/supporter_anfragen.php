<?php
check_mitarbeiter();

$output .= '<h1>Liste</h1>';
$output .= '<table>
				<tr id="anfragen">
					<td id="working" style="width:55px;" align="center">
						<b>Working</b>
					</td>
					<td>|</td>
					<td id="done" style="width:30px;" align="center">
						<a href="#" onclick="do_bold(\'done\', 3)">Done</a>
					</td>
				</tr>
			</table>';
$output .= '<div id="anfragenliste">';
$output .= get_supporter_anfragen($_SESSION['user_id']);
$output .= '</div>
			<input type="hidden" id="anfrage_typ" value="supporter" />';
?>