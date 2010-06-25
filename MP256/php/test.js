function handleTranslation() {
	switch (req.readyState) {
	case 4:
		if (req.status != 200) {
			alert("Fehler:" + req.status);
		} else {
			fenster = window.open();
//			alert(req.responseText);
			fenster.document.write(req.responseText);
			fenster.document.close();
			fenster.focus();
		}
		break;
	default:
		return false;
		break;
	}
}

function print_list() {
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
	var url = "http://localhost/workspace/MP256/php/print.php";
	var parameters = "anfragen=" + document.getElementById('array').value;
	
	req.open('POST', url, true);
	// Beim abschliessen des request wird diese Funktion ausgeführt
	req.onreadystatechange = handleTranslation;
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	req.send(parameters);
}