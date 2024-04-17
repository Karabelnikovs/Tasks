const inputs = document.querySelectorAll("input"); // Select all input elements

function generatePassword(length) {
    // Define character sets
    const lowercaseChars = "abcdefghijklmnopqrstuvwxyz";
    const uppercaseChars = lowercaseChars.toUpperCase();
    const specialChars = "!@$%^&*";
    const numbers = "0123456789";
  
    // Ensure length is a positive integer
    length = Math.max(1, parseInt(length) || 12); // Default to 12 if invalid
  
    let password = "";
  
    // Guarantee at least one character from each set
    password += lowercaseChars[Math.floor(Math.random() * lowercaseChars.length)];
    password += uppercaseChars[Math.floor(Math.random() * uppercaseChars.length)];
    password += specialChars[Math.floor(Math.random() * specialChars.length)];
    password += numbers[Math.floor(Math.random() * numbers.length)];
  
    // Fill remaining characters with random selection from all sets
    for (let i = password.length; i < length; i++) {
      const charSet = [lowercaseChars, uppercaseChars, specialChars, numbers];
      const randomSet = charSet[Math.floor(Math.random() * charSet.length)];
      password += randomSet[Math.floor(Math.random() * randomSet.length)];
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
