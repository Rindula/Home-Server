function load(v) {
	var xhttpPasswords = new XMLHttpRequest();
	xhttpPasswords.onreadystatechange = function () {
		if (this.readyState === 4 && this.status === 200) {
			// Typical action to be performed when the document is ready:
			document.getElementById("infos").innerHTML = xhttpPasswords.responseText;
		}
	};
	xhttpPasswords.open("GET", "passwords/fetch.php?id=" + v, true);
	xhttpPasswords.send();
}

function query() {
	name = document.getElementById("name").value;
	out = document.getElementById("out");
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == XMLHttpRequest.DONE) {
			out.innerHTML = xhr.responseText;
		}
	}
	xhr.open('GET', '/contacts/process.php?q=' + name, true);
	xhr.send(null);
}

function copyToPaste(id) {
	document.getElementById(id).select();

	try {
		var successful = document.execCommand('copy');
		var msg = successful ? 'successful' : 'unsuccessful';
		console.log('Copying text command was ' + msg);
	} catch (err) {
		console.log('Oops, unable to copy');
	}
}

function reload() {
	var btn = document.getElementById("btn");
	if (btn === null) {
		setTimeout(reload, 10);
		return;
	}
	btn.innerHTML = "Warten (3)";
	btn.disabled = true;

	loadStorage();
	loadTemps();

	setTimeout(function () {
		var btn = document.getElementById("btn");
		btn.innerHTML = "Warten (2)";
	}, 1000);
	setTimeout(function () {
		var btn = document.getElementById("btn");
		btn.innerHTML = "Warten (1)";
	}, 2000);
	setTimeout(function () {
		var btn = document.getElementById("btn");
		btn.innerHTML = "Aktualisieren";
		btn.disabled = false;
	}, 3000);
}

function loadStorage() {
	var xhttpStorage = new XMLHttpRequest();
	xhttpStorage.onreadystatechange = function () {
		if (this.readyState === 4 && this.status === 200) {
			document.getElementById("storage").innerHTML = xhttpStorage.responseText;
		}
	};
	xhttpStorage.open("GET", "content/statusFiles/storage.php", true);
	xhttpStorage.send();
}

function loadTemps() {
	var xhttpTemperatur = new XMLHttpRequest();
	xhttpTemperatur.onreadystatechange = function () {
		if (this.readyState === 4 && this.status === 200) {
			document.getElementById("temps").innerHTML = xhttpTemperatur.responseText;
		}
	};
	xhttpTemperatur.open("GET", "content/statusFiles/temperatur.php", true);
	xhttpTemperatur.send();
}

function muteOthers(e) {
		elements = document.getElementsByTagName(e.nodeName);
		for (i = 0; i < elements.length; i++) {
			element = elements[i];
			if (element !== e) {
				element.pause();
				element.currentTime = 0;
			}
		}
}

$(document).ready(function() {
	$("a.nav-link:not(.dropdown-toggle), a.dropdown-item").click(function(){
	  var link = $(this).attr('href');
	  $(this).toggle();
	  $("#content").attr("src", link);
	  return false;
   });
});