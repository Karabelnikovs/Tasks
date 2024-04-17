const inputs = document.querySelectorAll("input"); // Select all input elements

function generatePassword() {
  // Define character sets
  const lowercaseChars = "abcdefghijklmnopqrstuvwxyz";
  const uppercaseChars = lowercaseChars.toUpperCase();
  const digits = "0123456789";
  const printableAscii = String.fromCharCode(33, 126).replace(/\s/, "");

  const length = Math.floor(Math.random() * (16 - 8 + 1)) + 8;

  let password = "";

  password += lowercaseChars[Math.floor(Math.random() * lowercaseChars.length)];
  password += uppercaseChars[Math.floor(Math.random() * uppercaseChars.length)];
  password += digits[Math.floor(Math.random() * digits.length)];
  password += printableAscii[Math.floor(Math.random() * printableAscii.length)];

  for (let i = password.length; i < length; i++) {
    const allChars = lowercaseChars + uppercaseChars + digits + printableAscii;
    password += allChars[Math.floor(Math.random() * allChars.length)];
  }

  password = password
    .split("")
    .sort(() => Math.random() - 0.5)
    .join("");

  let passex = document.getElementById("example");
  passex.innerHTML = password;
}
inputs.forEach((input) => {
  const parentElement = input.parentElement;
  const span = parentElement.querySelector("span");

  if (span) {
    input.addEventListener("mouseenter", () => {
      span.classList.remove("hidden");
      span.classList.add("visible");
    });
    input.addEventListener("mouseleave", () => {
      span.classList.add("hidden");
      span.classList.remove("visible");
    });
  }
});
if (document.getElementById("example")) {
  generatePassword();
}
