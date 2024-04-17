const inputs = document.querySelectorAll("input"); // Select all input elements

function generatePassword(length) {
  // Define character sets
  const lowercaseChars = "abcdefghijklmnopqrstuvwxyz";
  const uppercaseChars = lowercaseChars.toUpperCase();
  const digits = "0123456789";
  const printableAscii = String.fromCharCode(33, 126).replace(/\s/, ""); // Printable ASCII chars (exc. space)

  // Ensure length is a positive integer
  length = Math.max(1, parseInt(length) || 12); // Default to 12 if invalid

  let password = "";

  // Guarantee at least one character from each set
  password += lowercaseChars[Math.floor(Math.random() * lowercaseChars.length)];
  password += uppercaseChars[Math.floor(Math.random() * uppercaseChars.length)];
  password += digits[Math.floor(Math.random() * digits.length)];
  password += printableAscii[Math.floor(Math.random() * printableAscii.length)];

  // Fill remaining characters with random selection from all sets
  for (let i = password.length; i < length; i++) {
    const allChars = lowercaseChars + uppercaseChars + digits + printableAscii;
    password += allChars[Math.floor(Math.random() * allChars.length)];
  }

  // Shuffle the password for better randomness (optional)
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

generatePassword(16);
