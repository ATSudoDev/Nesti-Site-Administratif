let pwInput = document.getElementById("inputUserPassword");

if (pwInput.value != '') {
    document.getElementById("pwd-strength").value = passwordStrength(pwInput.value);

}
pwInput.addEventListener('keyup', function() {

    document.getElementById("pwd-strength").value = passwordStrength(pwInput.value);

});

// Checks conditions password
function passwordStrength(pw) {

    changeColorConditions(pw);

    return (
        /.{12,}/.test(pw) + /* at least 12 characters */
        /[a-z]/.test(pw) + /* a lower letter */
        /[A-Z]/.test(pw) + /* a upper letter */
        /\d/.test(pw) + /* a digit */
        /[^A-Za-z0-9]/.test(pw) /* a special character */
    )
}

// Changes the color of the conditions depending of the input password
function changeColorConditions(pw) {

    if (/.{12,}/.test(pw) == true) {
        document.getElementById("pwdLength").style.color = 'green'
    } else(
        document.getElementById("pwdLength").style.color = 'red'
    )

    if (/[a-z]/.test(pw) == true) {
        document.getElementById("pwdLowCase").style.color = 'green'
    } else(
        document.getElementById("pwdLowCase").style.color = 'red'
    )

    if (/[A-Z]/.test(pw) == true) {
        document.getElementById("pwdUpperCase").style.color = 'green'
    } else(
        document.getElementById("pwdUpperCase").style.color = 'red'
    )

    if (/\d/.test(pw) == true) {
        document.getElementById("pwdDigit").style.color = 'green'
    } else(
        document.getElementById("pwdDigit").style.color = 'red'
    )

    if (/[^A-Za-z0-9]/.test(pw) == true) {
        document.getElementById("pwdSpecial").style.color = 'green'
    } else(
        document.getElementById("pwdSpecial").style.color = 'red'
    )
}

// Reset all inputs new user
function resetUserCreate() {
    document.getElementById("inputUserName").value = '';
    document.getElementById("inputUserPassword").value = '';
    document.getElementById("inputUserRole").value = '';
    document.getElementById("inputUserState").value = '';
    document.getElementById("inputUserCity").value = '';
    document.getElementById("inputUserLastName").value = '';
    document.getElementById("inputUserFirstName").value = '';
    document.getElementById("inputUserEmail").value = '';
    document.getElementById("inputUserAdress1").value = '';
    document.getElementById("inputUserAdress2").value = '';
}