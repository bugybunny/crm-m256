<?php
$output .= '<h1>Liste</h1>';
$output .= '<table>
				<tr id="anfragen">
					<td id="working" style="width:100px;">
						<a href="#" onclick="do_bold(this, 2)">Working</a>
					</td>
					<td id="done" style="width:100px;">
						<a href="#" onclick="do_bold(this, 3)">Done</a>
					</td>
				</tr>
			</table>';
$output .= '<div id="anfragenliste">';
$output .= get_supporter_anfragen($_SESSION['user_id']);
$output .= '</div>
			<input type="hidden" id="anfrage_typ" value="supporter" />';
?>