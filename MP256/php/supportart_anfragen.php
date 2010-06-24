<?php
$output .= '<h1>Liste</h1>';
$output .= '<table>
				<tr id="anfragen">
					<td id="open" style="width:100px;">
						<a href="#" onclick="do_bold(this, 1)">Open</a>
					</td>
					<td id="working" style="width:100px;">
						<a href="#" onclick="do_bold(this, 2)">Working</a>
					</td>
					<td id="done" style="width:100px;">
						<a href="#" onclick="do_bold(this, 3)">Done</a>
					</td>
				</tr>
			</table>';
$output .= '<div id="anfragenliste">';
$output .= get_anfragen_liste($_SESSION['user_id']);
$output .= '</div>
			<input type="hidden" id="anfrage_typ" value="supportart" />';
?>