const firstPassword = document.getElementById("first-password");
const secondPassword = document.getElementById("second-password");
const resultText = document.getElementById("result-text");

function checkPasswords() {
    const firstPasswordValue = firstPassword.value;
    const secondPasswordValue = secondPassword.value;

    if(firstPasswordValue === secondPasswordValue) {
        resultText.textContent = "Heslá sa zhodujú";
        resultText.classList.add("valid");
        resultText.classList.remove("invalid");
    } else {
        resultText.textContent = "Heslá sa nezhodujú";
        resultText.classList.add("invalid");
        resultText.classList.remove("valid");
    }
}

firstPassword.addEventListener("input", checkPasswords);
secondPassword.addEventListener("input", checkPasswords);
