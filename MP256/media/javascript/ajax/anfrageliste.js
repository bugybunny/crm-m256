var req = null;
function do_bold(objekt, statusid) {
	if (objekt != "open" && document.getElementById("open") != null) {
		document.getElementById("open").innerHTML = "<a href=\"#\" onclick=\"do_bold('open', 1)\">Open</a>";
	} else if (document.getElementById("open") != null) {
		document.getElementById("open").innerHTML = "<b>Open</b>";
	}
	if (objekt != "working" && document.getElementById("working") != null) {
		document.getElementById("working").innerHTML = "<a href=\"#\" onclick=\"do_bold('working', 2)\">Working</a>";
	} else if (document.getElementById("working") != null) {
		document.getElementById("working").innerHTML = "<b>Working</b>";
	}
	if (objekt != "done" && document.getElementById("done") != null) {
		document.getElementById("done").innerHTML = "<a href=\"#\" onclick=\"do_bold('done', 3)\">Done</a>";
	} else if (document.getElementById("done") != null) {
		document.getElementById("done").innerHTML = "<b>Done</b>";
	}

	update_list(statusid);
}

function handleAnfragelisteTranslation() {
	switch (req.readyState) {
	case 4:
		if (req.status != 200) {
			alert("Fehler:" + req.status);
		} else {
			document.getElementById("anfragenliste").innerHTML = req.responseText;
		}
		break;
	default:
		return false;
		break;
	}
}

function update_list(statusid, updateid) {
	// erstellen des requests
	try {
		req = new XMLHttpRequest();
	} catch (e) {
		try {
			req = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				req = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (failed) {
				req = null;
			}
		}
	}
	if (req == null)
		alert("Error creating request object!");
	var home_url = document.getElementById('home_url').value;
	var ext = "";
	if (updateid != null) {
		var ext = "&update=" + updateid;
	}
	if (document.getElementById("anfrage_typ").value == "supportart") {
		ext += "&team_mitarbeiter=" + document.getElementById("user_id").value;
	} else if (document.getElementById("anfrage_typ").value == "user") {
		ext += "&user=" + document.getElementById("user_id").value;
	} else if (document.getElementById("anfrage_typ").value == "supporter") {
		ext += "&mitarbeiter=" + document.getElementById("user_id").value;
	}
	var url = home_url + 'php/ajax/anfragen.php?statusid=' + statusid + ""
			+ ext;
	req.open("GET", url, true);
	// Beim abschliessen des request wird diese Funktion ausgeführt
	req.onreadystatechange = handleAnfragelisteTranslation;
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	req.send(null);
}