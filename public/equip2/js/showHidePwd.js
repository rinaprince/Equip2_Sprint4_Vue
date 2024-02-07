function showHidePassword() {
    var passwordInput = document.getElementById("password");
    var showPasswordButton = document.getElementById("showPassword");

    passwordInput.type = (passwordInput.type === "password") ? "text" : "password";
    showPasswordButton.textContent = (passwordInput.type === "password") ? "Mostrar Contraseña" : "Ocultar Contraseña";
}