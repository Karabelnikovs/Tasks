const container = document.getElementById("container");
// INTEGRATE THIS BROTHERRR
let id = 0;

let cardsElements = [];




function fixPHPDone(donedata){
  return  donedata ? "done" : "notdone";
}


/**
 * Returns the deadline string, if is done then green, otherwise red.
 *
 * @returns {string} Adjusted text for deadline.
 */
function formatDoneButton(donedata){
  done = donedata ? true : false;
  text = done ? "Done" : "Due";
  btn = done  ? "btn btn-success" : "btn btn-danger";
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
  return `<p style="color: ${color}">${formattedDate}</p>`;
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
      cardPush.innerHTML += `<h2>${card.title}</h2>`;
      cardPush.innerHTML += `<h2>${card.username}</h2>`;
      cardPush.innerHTML += `<h2>${card.created_date}</h2>`;
      cardPush.innerHTML += `<h2>${formatDeadlineDate(card.deadline_date)}</h2>`;
      cardPush.innerHTML += `<h2>${card.DESCRIPTION}</h2>`;
      cardPush.innerHTML += `
      <form method="POST">
          <input type="hidden" name="${fixPHPDone(card.done)}" value="${index}" class="form-control">
          <button type="submit" ${formatDoneButton(card.done)} </button>
      </form>`;
      cardPush.addEventListener("click", () => {
        if (index != id) {
          id = index;
          updateCards();
        }
      });
      let cardPushArr = { card: cardPush };
      cardsElements.push(cardPushArr);
    });
    updateCards(); // Update cards after data is fetched
  } catch (error) {
    console.error("Error fetching data:", error);
    // Handle error appropriately (e.g., display error message)
  }
}

getCards();
/**
 * Updates the cards displayed in the container.
 * @returns Nothing.
 */
function updateCards() {
  const length = cardsElements.length;
  container.innerHTML = "";
  cardsElements.forEach((cardElement) => {
    cardElement.card.style.zIndex = "0";
    cardElement.card.style.scale = "0.5";
    cardElement.card.style.filter = "blur(5px)";
  });
  cardsElements[id].card.style.zIndex = "1";
  cardsElements[id].card.style.scale = "1.5";
  cardsElements[id].card.style.filter = "blur(0px)";

  if (length > 0) {
    if (length > 2) {
      if (id === 0) {
        container.append(cardsElements[length - 1].card);
        container.append(cardsElements[0].card);
        container.append(cardsElements[1].card);
      } else if (id === length - 1) {
        container.append(cardsElements[id - 1].card);
        container.append(cardsElements[id].card);
        container.append(cardsElements[0].card);
      } else {
        container.append(cardsElements[id - 1].card);
        container.append(cardsElements[id].card);
        container.append(cardsElements[id + 1].card);
      }
    } else {
      if (id === 0) {
        container.append(cardsElements[1].card);
        container.append(cardsElements[0].card);
      } else {
        container.append(cardsElements[0].card);
        container.append(cardsElements[1].card);
      }
    }
  } else {
    container.innerHTML = "No cards to show";
  }
}

/**
 * Switches index of the current task and updates the cards displayed in the container.
 * @returns Nothing.
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
 * @returns Nothing.
 */
function prevCard() {
  id--;
  if (id < 0) {
    id = cardsElements.length - 1;
  }
  updateCards();
}

