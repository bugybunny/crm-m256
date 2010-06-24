<?php
$output .= '<h1>Liste</h1>';
$output .= '<table>
				<tr id="anfragen">
					<td id="open" style="width:100px;">
						<b>Open</b>
					</td>
					<td id="working" style="width:100px;">
						<a href="#" onclick="do_bold(\'working\', 2)">Working</a>
					</td>
					<td id="done" style="width:100px;">
						<a href="#" onclick="do_bold(\'done\', 3)">Done</a>
					</td>
				</tr>
			</table>';
$output .= '<div id="anfragenliste">';
$output .= get_user_anfragen($_SESSION['user_id']);
$output .= '</div>
			<input type="hidden" id="anfrage_typ" value="user" />';
?>