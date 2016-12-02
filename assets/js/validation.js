function validation() {

  var user = document.getElementById('user');
  var pass = document.getElementById('pass');

  if (pass.value === "") {
    alert("passwrod is empty");
    return false;
  } else
    return true;
}
