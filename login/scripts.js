document.getElementById("signUpButton").onclick = function () {
  document.getElementById("signIn").style.display = "none";
  document.getElementById("signup").style.display = "block";
};

document.getElementById("signInButton").onclick = function () {
  document.getElementById("signup").style.display = "none";
  document.getElementById("signIn").style.display = "block";
};

document.getElementById("adminLoginButton").onclick = function () {
  document.getElementById("signIn").style.display = "none";
  document.getElementById("adminLogin").style.display = "block";
};

document.getElementById("backToSignInButton").onclick = function () {
  document.getElementById("adminLogin").style.display = "none";
  document.getElementById("signIn").style.display = "block";
};
