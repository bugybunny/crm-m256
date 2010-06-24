var req = null;

function handleSearch() {
	switch (req.readyState) {
	case 4:
		if (req.status != 200) {
			alert("Fehler:" + req.status);
		} else {
			//Antwort des Servers
			document.getElementById("auswertung_resultat").innerHTML = req.responseText;
		}
		break;
	}
}

function search(searchtype, searchvalue) {
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
	var betreff = document.getElementById('suche_betreff').value;
	var kunde = document.getElementById('suche_kunde').value;
	var supporter = document.getElementById('suche_supporter').value;
	var supportart = document.getElementById('suche_supportart').value;
	var status = document.getElementById('suche_status').value;
	var url = home_url + 'php/ajax/suchen.php?betreff=' + betreff + '&kunde=' + kunde + '&supporter=' + supporter + '&supportart=' + supportart + '&status=' + status;
	req.open("GET", url, true);
	//Beim abschliessen des request wird diese Funktion ausgeführt
	req.onreadystatechange = handleSearch;
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	req.send(null);
}