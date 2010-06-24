var req = null;
var element = null;
function handleTranslation() {
	switch (req.readyState) {
	case 4:
		if (req.status != 200) {
			alert("Fehler:" + req.status);
		} else {
			//antwort des servers
			var check = req.responseText == "1";
			set_username_icon(check, 'info_'+element.id);
		}
		break;
	default:
		return false;
		break;
	}
}
function validate(elem, type, compare_elem) {
	element = elem;
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
	var compare_value = compare_elem != null ? "&compare_value="+compare_elem.value : "";
	var url = home_url+'php/ajax/validate.php?value='+elem.value+'&type='+type+compare_value;
	req.open("GET", url, true);
	//Beim abschliessen des request wird diese Funktion ausgeführt
	req.onreadystatechange = handleTranslation;
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	req.send(null);
}

function set_username_icon(check, element_id) {
	var element = document.getElementById(element_id);
	if(check) {
		element.innerHTML = get_image('ok.png');
	} else {
		element.innerHTML = get_image('nok.png');
	}
}

function get_image(image_name) {
	return '<img src="media/images/' + image_name + '" alt="" border="0" />';
}