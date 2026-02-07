function validateRegister() {
    const email = document.getElementById('email').value;
    const pass = document.getElementById('password').value;
    if (pass.length < 6) {
        alert("Password must be at least 6 characters!");
        return false;
    }
    return true;
}

function validateLogin() {
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;

    if (!email.includes("@") || password.length < 6) {
        alert("Please enter a valid email and password (min 6 characters).");
        return false;
    }
    return true;
}
