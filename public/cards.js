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

    buttonElement.classList.remove("hover:bg-sky-500");
    buttonElement.classList.add("flex", "items-center", "justify-center", "cursor-default");
    buttonElement.innerHTML = `<div class="cursor-default inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"></div>`;

    id = index;
    form.append("check", id);
    await fetch("check", {
      method: "POST",
      body: form,
    }).then(()=>{
      clearCards();
      getCards();
    });
  }
}

async function removeTask(index) {
  const buttonElement = document.getElementById(`delete-${index}`);
  let form = new FormData();
  if (!id) {
    id = index;
  }
  if (id == index && !fetching && buttonElement) {
    fetching = !fetching;
    buttonElement.innerHTML = "";
    buttonElement.classList.remove("hover:bg-red-500");
    buttonElement.innerHTML = `<div class="absolute cursor-default flex justify-center content-center bg-gray-700 font-extrabold rounded-xl top-0 right-0 inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"></div>`;

    id = index;
    form.append("delete", id);
    await fetch("delete", {
      method: "POST",
      body: form,
    }).then(()=>{
      clearCards();
      getCards();
    });
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
    ? "bg-purple-700 cursor-pointer font-extrabold p-2 px-6 rounded-xl hover:bg-sky-500 transition-all "
    : "bg-gray-700   cursor-pointer font-extrabold p-2 px-6 rounded-xl hover:bg-sky-500 transition-all ";
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
  try {
    const data = await fetchData();
    data.forEach((card, index) => {
      let cardPush = document.createElement("div");
      cardPush.classList =
        "w-60 h-80 bg-neutral-800 rounded-3xl text-neutral-300 p-4 flex flex-col items-start justify-center gap-3 hover:bg-gray-1000 hover:shadow-lg hover:shadow-purple-400 transition-shadow";
      cardPush.id = index;
      cardPush.innerHTML += `<div id="options-${index}" onclick="showOptions(${index})" class="absolute cursor-pointer flex justify-center content-center bg-gray-700 font-extrabold m-3 rounded-xl hover:bg-orange-500 transition-all top-0 right-0 h-4 w-4 group">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
    </svg>
    
      </div>`;
      cardPush.innerHTML += `<div class="title">Title: ${card.title}</div>`;
      cardPush.innerHTML += `<div class="user">User: ${card.username}</div>`;
      cardPush.innerHTML += `<div class="created">Created: ${card.created_date}</div>`;
      cardPush.innerHTML += `<div class="deadline">Deadline: ${formatDeadlineDate(
        card.deadline_date
      )}</div>`;
      cardPush.innerHTML += `<div class="description">Description: ${card.DESCRIPTION}</div>`;
      cardPush.innerHTML += `<div id="done-${index}" onclick="taskDone(${index})" ${formatDoneButton(
        card.done
      )}</div>`;
      cardPush.addEventListener("click", function () {
        handleChange(index);
      });
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
 * Prompts user to add a new card.
 */
function prompEmpty() {
  const element = document.createElement("div");
  element.classList =
    "w-80 h-50 flex flex-col z-20 bg-neutral-800 rounded-3xl text-neutral-300 p-4 flex flex-col justify-center gap-3 hover:bg-gray-1000 hover:shadow-lg hover:shadow-purple-400 transition-shadow";
  element.innerHTML = `<a href="create" class=" w-70 h-90 transition-all text-white text-xl hover:no-underline duration-300 text-center rounded-full px-2 py-1 border-2 border-purple-700 hover:bg-purple-700">Add task</a>`;
  container.append(element);
}

/**
 * Updates the cards displayed in the container.
 */
function updateCards() {
  fetching = false;
  const length = cardsElements.length;
  let zIndexCard;
  if (length === 0) {
    container.innerHTML = "";
    prompEmpty();
    return;
  }

  if(length == 1){
    id = 0;
  }

  container.innerHTML = "";

  if (length === 2) {
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
    zIndexCard = cardsElements[id];
    if (zIndexCard) {
      zIndexCard.card.style.zIndex = "1";
      zIndexCard.card.style.scale = "1.5";
      zIndexCard.card.style.filter = "blur(0px)";
      zIndexCard.card.style.userSelect = "auto";
      zIndexCard.card.classList.remove("card-left");
      zIndexCard.card.classList.remove("card-right");
    }
  }

  if (length > 2) {
    const prevCard = cardsElements[(id + length - 1) % length];
    const nextCard = cardsElements[(id + 1) % length];

    prevCard.card.classList.add("card-left");
    nextCard.card.classList.add("card-right");

    container.append(prevCard.card, zIndexCard.card, nextCard.card);
  } else if (length === 2) {
    container.append(cardsElements[1].card, cardsElements[0].card);
  } else {
    id = 0;
    container.append(cardsElements[0].card);
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
