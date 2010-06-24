var req = null;
function do_bold(element, statusid){
	element.className = "bold";
	element.removeAttribute("href");
	update_list(statusid);
}

function handleTranslation() {
	switch (req.readyState) {
		case 4 :
			if (req.status != 200) {
				alert("Fehler:" + req . status);
			} else {
				document.getElementById("anfragenliste").innerHTML = req.responseText;
			}
			break;
		default :
			return false;
			break;
	}
}

function update_list(statusid, updateid) {
	//erstellen des requests
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
	if(updateid != null){
		var ext = "&update="+updateid;
	}
	ext += "&mitarbeiter="+document.getElementById("user_id").value;
	var url = home_url+'php/ajax/anfragen.php?statusid='+statusid+""+ext;
	req.open("GET", url, true);
	//Beim abschliessen des request wird diese Funktion ausgeführt
	req.onreadystatechange = handleTranslation;
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	req.send(null);
}