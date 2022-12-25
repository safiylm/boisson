
function showHint(str) {
    if (str.length == 0) {
      document.getElementById("proposals").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("proposals").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "proposals.php?q=" + str, true);
      xmlhttp.send();
    }
  }
