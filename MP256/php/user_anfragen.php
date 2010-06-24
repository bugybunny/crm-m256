<?php
check_kunde();

$output .= '<h1>Liste</h1>';
$output .= '<table>
				<tr id="anfragen">
					<td id="open" style="width:35px;" align="center">
						<b>Open</b>
					</td>
					<td>|</td>
					<td id="working" style="width:55px;" align="center">
						<a href="#" onclick="do_bold(\'working\', 2)">Working</a>
					</td>
					<td>|</td>
					<td id="done" style="width:30px;" align="center">
						<a href="#" onclick="do_bold(\'done\', 3)">Done</a>
					</td>
				</tr>
			</table>';
$output .= '<div id="anfragenliste">';
$output .= get_user_anfragen($_SESSION['user_id']);
$output .= '</div>
			<input type="hidden" id="anfrage_typ" value="user" />';
?>