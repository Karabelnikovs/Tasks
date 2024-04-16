const container = document.getElementById("container");
let id = 0;
let cardsElements = [];

/**
 * Sends a post request to the server, clears and gets new cards from the said server.
 */
async function taskDone(index) {
  id = index;
  let form = new FormData();
  form.append("check", id);
  await fetch("check", {
    method: "POST",
    body: form,
  });
  clearCards();
  getCards();
}

/**
 * Clears all cards from the page.
 */
function clearCards() {
  cardsElements = [];
}

/**
 * Returns the adjusted text for the PHP done status.
 *
 * @param {boolean} donedata The PHP done status.
 * @returns {string} The adjusted text for the PHP done status.
 */
function fixPHPDone(donedata) {
  return donedata ? "done" : "notdone";
}

/**
 * Returns the deadline string, if is done then green, otherwise red.
 *
 * @returns {string} Adjusted text for deadline.
 */
function formatDoneButton(donedata) {
  done = donedata ? true : false;
  text = done ? "Done" : "Due";
  btn = done ? "btn btn-success" : "btn btn-danger";
  return `class="${btn}">${text}`;
}
/**
 * Returns the deadline date formatted if overdue then red, otherwise black.
 *
 * @returns {string} The user ID from the cookie.
 */
function formatDeadlineDate(deadlineDate) {
  const currentDate = new Date();
  const deadline = new Date(deadlineDate);

  const isOverdue = currentDate >= deadline;
  const color = isOverdue ? "red" : "black";

  const formattedDate = deadline.toLocaleString(); // Adjust formatting as needed
  return `<div style="color: ${color}">${formattedDate}</div>`;
}

/**
 * Returns the user ID from the cookie if it exists, otherwise returns an empty string.
 *
 * @returns {string} The user ID from the cookie.
 */
function getUserIdFromCookie() {
  const cookieName = "user_id"; // Replace with your actual cookie name if different
  let userId = "";

  if (document.cookie) {
    const cookies = document.cookie.split(";");
    for (const element of cookies) {
      const cookie = element.trim();
      if (cookie.startsWith(cookieName + "=")) {
        userId = cookie.substring(cookieName.length + 1);
        break;
      }
    }
  }

  return userId;
}
/**
 * Fetches data from the server using a POST request.
 *
 * @returns {Promise} A Promise that resolves to the response data.
 */
async function fetchData() {
  const response = await fetch("parse", {
    method: "POST",
  });
  const data = await response.json(); // Parse response as JSON
  return data;
}

async function getCards() {
  // New function to handle fetching and processing data
  try {
    const data = await fetchData(); // Fetch data from server
    data.forEach((card, index) => {
      let cardPush = document.createElement("div");
      cardPush.classList.add("card");
      cardPush.id = index;
      cardPush.innerHTML += `<div class="title">Title: ${card.title}</div>`;
      cardPush.innerHTML += `<div class="user">User: ${card.username}</div>`;
      cardPush.innerHTML += `<div class="created">Created: ${card.created_date}</div>`;
      cardPush.innerHTML += `<div class="deadline">Deadline: ${formatDeadlineDate(card.deadline_date)}</div>`;
      cardPush.innerHTML += `<div class="description">Description: ${card.DESCRIPTION}</div>`;
      cardPush.innerHTML += `<button onclick="taskDone(${index})" ${formatDoneButton(card.done)}</button>`;
      cardPush.addEventListener("click", () => {
        if (index != id) {
          id = index;
          updateCards();
        } 
      });
      let cardPushArr = { card: cardPush };
      cardsElements.push(cardPushArr);
    });
    updateCards();
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}

getCards();
/**
 * Updates the cards displayed in the container.
 */
function updateCards() {
  const length = cardsElements.length;
  container.innerHTML = "";
  cardsElements.forEach((cardElement) => {
    cardElement.card.style.zIndex = "0";
    cardElement.card.style.scale = "0.5";
    cardElement.card.style.userSelect = "none";
    cardElement.card.style.filter = "blur(5px)";
    cardElement.card.classList.remove("card-left");
    cardElement.card.classList.remove("card-right");
  });
  cardsElements[id].card.style.zIndex = "1";
  cardsElements[id].card.style.scale = "1.5";
  cardsElements[id].card.style.filter = "blur(0px)";
  cardsElements[id].card.style.userSelect = "auto";
  cardsElements[id].card.classList.remove("card-left");
  cardsElements[id].card.classList.remove("card-right");

  if (length > 0) {
    if (length > 2) {
      if (id === 0) {
        cardsElements[length - 1].card.classList.add("card-left");
        cardsElements[1].card.classList.add("card-right");
        container.append(cardsElements[length - 1].card);
        container.append(cardsElements[0].card);
        container.append(cardsElements[1].card);
      } else if (id === length - 1) {
        
        cardsElements[id - 1].card.classList.add("card-left");
        cardsElements[0].card.classList.add("card-right");
        container.append(cardsElements[id - 1].card);
        container.append(cardsElements[id].card);
        container.append(cardsElements[0].card);
      } else {
        
        cardsElements[id - 1].card.classList.add("card-left");
        cardsElements[id + 1].card.classList.add("card-right");
        container.append(cardsElements[id - 1].card);
        container.append(cardsElements[id].card);
        container.append(cardsElements[id + 1].card);
      }
    } else if (length === 2) {
      if (id === 0) {
        cardsElements[1].card.classList.add("card-left");
        container.append(cardsElements[1].card);
        container.append(cardsElements[0].card);
      } else {
        cardsElements[0].card.classList.add("card-left");
        container.append(cardsElements[0].card);
        container.append(cardsElements[1].card);
      }
    } else {
      container.append(cardsElements[0].card);
    }
  } else {
    container.innerHTML = "No cards to show";
  }
}

/**
 * Switches index of the current task and updates the cards displayed in the container.
 */
function nextCard() {
  id++;
  if (id === cardsElements.length) {
    id = 0;
  }
  updateCards();
}

/**
 * Switches index of the current task and updates the cards displayed in the container.
 */
function prevCard() {
  id--;
  if (id < 0) {
    id = cardsElements.length - 1;
  }
  updateCards();
}
