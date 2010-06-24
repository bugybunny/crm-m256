function print_window(pWindow) {
	document.getElementById('pButtons').style.display = "none"
	pWindow.print();
	document.getElementById('pButtons').style.display = "inline"
}