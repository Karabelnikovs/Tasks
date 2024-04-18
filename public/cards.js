const container = document.getElementById("container");
let id = 0;
let cardsElements = [];
let fetching = false;
/**
 * Sends a post request to the server, clears and gets new cards from the said server.
 */
async function taskDone(index) {
  const buttonElement = document.getElementById(`done-${index}`);
  let form = new FormData();
  if (!id) {
    id = index;
  }
  if (id == index && !fetching && buttonElement) {
    fetching = !fetching;

    buttonElement.classList.add("flex", "items-center", "justify-center");
    buttonElement.innerHTML = `<div class="inline-block h-3 w-3 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"></div>`;

    id = index;
    form.append("check", id);
    await fetch("check", {
      method: "POST",
      body: form,
    });
    clearCards();
    getCards();
  }
}




async function removeTask(index) {
  const buttonElement = document.getElementById(`delete-${index}`);
  const div = buttonElement.getElementsByClassName("absolute flex justify-center content-center bg-gray-700 font-extrabold m-3 rounded-xl hover:bg-red-500 transition-all top-0 right-0 h-4 w-4 group")
  let form = new FormData();
  if (!id) {
    id = index;
  }
  if (id == index && !fetching && div) {
    div.classList = "";
    div.classList = "flex items-center justify-center";
    div.innerHTML = `<div class="inline-block h-3 w-3 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"></div>`;

    id = index;
    form.append("delete", id);
    await fetch("delete", {
      method: "POST",
      body: form,
    });
    clearCards();
    getCards();
  }

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
  btn = done
    ? "bg-purple-700 font-extrabold p-2 px-6 rounded-xl hover:bg-sky-500 transition-colors"
    : "bg-gray-700 font-extrabold p-2 px-6 rounded-xl hover:bg-sky-500 transition-colors";
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
  const color = isOverdue ? "red" : "white";

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
function handleChange(index) {

  if (index != id) {
    id = index;
    updateCards();
  }
  return null;
}
async function getCards() {
  // New function to handle fetching and processing data
  try {
    const data = await fetchData(); // Fetch data from server
    data.forEach((card, index) => {
      let cardPush = document.createElement("div");
      cardPush.classList =
        "w-60 h-80 bg-neutral-800 rounded-3xl text-neutral-300 p-4 flex flex-col items-start justify-center gap-3 hover:bg-gray-1000 hover:shadow-lg hover:shadow-purple-400 transition-shadow";
      cardPush.id = index;
      cardPush.innerHTML += `<button id="delete-${index}"  onclick="removeTask(${index})"><div class="absolute flex justify-center content-center bg-gray-700 font-extrabold m-3 rounded-xl hover:bg-red-500 transition-all top-0 right-0 h-4 w-4 group">
      <svg class="h-4 w-4 stroke-white group-hover:stroke-black transition-all" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10 12L14 16M14 12L10 16M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
      </div><div>`;
      cardPush.innerHTML += `<div class="title">Title: ${card.title}</div>`;
      cardPush.innerHTML += `<div class="user">User: ${card.username}</div>`;
      cardPush.innerHTML += `<div class="created">Created: ${card.created_date}</div>`;
      cardPush.innerHTML += `<div class="deadline">Deadline: ${formatDeadlineDate(
        card.deadline_date
      )}</div>`;
      cardPush.innerHTML += `<div class="description">Description: ${card.DESCRIPTION}</div>`;
      cardPush.innerHTML += `<button id="done-${index}" onclick="taskDone(${index})" ${formatDoneButton(
        card.done
      )}</button>`;
      cardPush.addEventListener("click", function () { handleChange(index) });
      let cardPushArr = { card: cardPush };
      cardsElements.push(cardPushArr);
    });
    updateCards();
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}
function resetStyle(card) {
  card.style.zIndex = "0";
  card.style.margin = "60px";
  card.style.scale = "0.7";
  card.style.userSelect = "none";
  card.style.filter = "blur(3px)";
  card.classList.remove("card-left");
  card.classList.remove("card-right");
}
/**
 * Updates the cards displayed in the container.
 */
function updateCards() {
  fetching = false;
  const length = cardsElements.length;
  container.innerHTML = "";
  if (length <= 2) {
    cardsElements.forEach((cardElement) => {
      cardElement.card.removeEventListener(
        "click",
        handleChange(cardElement.id)
      );
      cardElement.card.style.margin = "60px";
      cardElement.card.style.scale = "1.3";
      cardElement.card.style.userSelect = "none";
      cardElement.card.style.filter = "blur(0px)";
      cardElement.card.classList.remove("card-left");
      cardElement.card.classList.remove("card-right");
    });
  } else {
    cardsElements.forEach((cardElement) => {
      resetStyle(cardElement.card);
    });
    cardsElements[id].card.style.zIndex = "1";
    cardsElements[id].card.style.scale = "1.5";
    cardsElements[id].card.style.filter = "blur(0px)";
    cardsElements[id].card.style.userSelect = "auto";
    cardsElements[id].card.classList.remove("card-left");
    cardsElements[id].card.classList.remove("card-right");
  }

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
        cardsElements[1].card.classList.add("blur-3");
        container.append(cardsElements[1].card);
        container.append(cardsElements[0].card);
      } else {
        cardsElements[0].card.classList.add("blur-3");
        container.append(cardsElements[0].card);
        container.append(cardsElements[1].card);
      }
    } else {
      container.append(cardsElements[0].card);
    }
  } else {
    container.innerHTML = ":<";
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

getCards();
