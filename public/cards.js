const container = document.getElementById("container");
let id = 0;
let cardsElements = [];
let fetching = false;

/**
 * Marks the task with the given index done or due. 
 * 
 * @param {BigInt} index 
 */
async function taskDone(index) {
  const buttonElement = document.getElementById(`done-${index}`);
  let form = new FormData();
  if (id == index && !fetching && buttonElement) {
    fetching = !fetching;

    buttonElement.classList.remove("hover:bg-sky-500");
    buttonElement.classList.add(
      "flex",
      "items-center",
      "justify-center",
      "cursor-default"
    );
    buttonElement.innerHTML = `<div class="cursor-default inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"></div>`;

    id = index;
    form.append("check", id);
    await fetch("check", {
      method: "POST",
      body: form,
    }).then(() => {
      getCards();
    });
  }
}


/**
 * Removes a task from the list.
 *
 * @param {number} index - The index of the task.
 */
async function removeTask(index) {
  const buttonElement = document.getElementById(`delete-${index}`);
  let form = new FormData();
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
    }).then(() => {
      id > 0 ? (id -= 1) : id;
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
function editTask(id) {
  window.location.href = `/edit?id=${id}`;
}

/**
 * Returns the formatted button text and style based on whether the task is done or not.
 *
 * @param {boolean} donedata The PHP done status.
 * @returns {string} The formatted button text and style.
 */
function formatDoneButton(donedata) {
  const done = donedata? true : false;
  const text = done? "Done" : "Due";
  const btn = done
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
/**
 * Creates a task card element.
 *
 * @param {object} card - The task data.
 * @param {number} index - The index of the task.
 * @returns {HTMLElement} The task card element.
 */
function createCard(card, index) {
  let cardPush = document.createElement("div");
  cardPush.classList = `
        card

        w-60 
        h-80 
        z-10 
        p-4 

        flex 
        shrink-0 
        flex-col 
        items-start 
        justify-center 
        
        rounded-3xl 

        bg-neutral-800 
        text-neutral-300 
        hover:bg-gray-1000 
        hover:shadow-lg 
        hover:shadow-purple-400 
        transition-all`;
  cardPush.id = index;
  cardPush.innerHTML += `<div id="delete-${index}" onclick="removeTask(${index})" class="absolute cursor-pointer flex justify-center content-center bg-gray-700 font-extrabold m-3 rounded-xl hover:bg-red-500 transition-all top-0 right-0 h-4 w-4 group">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
      <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
    </svg>
    
    
      </div>`;
  cardPush.innerHTML += `<div id="edit-${index}" onclick="editTask(${index})" class="absolute cursor-pointer flex justify-center content-center align-center bg-gray-700 font-extrabold m-3 rounded-xl hover:bg-blue-500 transition-all top-0 right-6 h-4 w-4 group">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="relative top-0.5 w-3 h-3">
      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
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
  cardPush.addEventListener("click", () => scrollToCard(index));
  return cardPush;
}
/**
 * Fetches cards data from the server and renders them on the UI.
 */
async function getCards() {
  clearCards();
  try {
    const data = await fetchData();
    data.forEach((card, index) => {
      let cardPush = createCard(card, index);
      let cardPushArr = {
        card: cardPush,
        title: card.title,
      };
      cardsElements.push(cardPushArr);
    });
    updateCards();
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}

/**
 * Prompts user to add a new card.
 */
function prompEmpty() {
  container.innerHTML = "";
  const element = document.createElement("div");
  element.classList = `card selected         w-60 
    h-80 
    z-10 
   flex flex-col z-20 bg-neutral-800 rounded-3xl text-neutral-300 p-4 flex flex-col justify-center gap-3 hover:bg-gray-1000 hover:shadow-lg hover:shadow-purple-400 transition-shadow`;
  element.innerHTML = `<a href="create" class=" w-70 h-90 transition-all text-white text-xl hover:no-underline duration-300 text-center rounded-full px-2 py-1 border-2 border-purple-700 hover:bg-purple-700">Add task</a>`;
  container.append(element);
}

/**
 * Updates the cards displayed in the container.
 */
function updateCards() {
  fetching = false;
  const length = cardsElements.length;
  if (length === 0) {
    prompEmpty();
  } else {
    container.innerHTML = "";
    cardsElements.forEach((element) => {
      container.append(element.card);
    });
    scrollToCard(id);
  }
}
/**
 * Scrolls the page to the specified card element.
 *
 * @param {string} cardId - The ID of the card element.
 */
function scrollToCard(cardId) {
  const card = document.getElementById(cardId);
  if (card) {
    // Get the width of the container element and the card element
    const containerWidth = container.clientWidth;
    const cardWidth = card.offsetWidth;

    // Calculate the horizontal scroll position based on the card's position relative to the container
    const scrollPosition = card.offsetLeft - containerWidth / 2 + cardWidth / 2;

    // Set the container's scroll position to the calculated position
    container.scrollLeft = scrollPosition;

    // Update the current card ID
    id = cardId;

    // Remove the "selected" class from all cards and add it to the specified card
    document.querySelectorAll(".card").forEach((card) => {
      card.classList.remove("selected");
    });
    card.classList.add("selected");
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
}

/**
 * Switches index of the current task and updates the cards displayed in the container.
 */
function prevCard() {
  id--;
  if (id < 0) {
    id = cardsElements.length - 1;
  }
}

getCards();

// enriko, markuss, rekur jums paskaidrojumi lai jus normali izprotat sito js:

// Variable Declarations:
// container: It stores a reference to an HTML element with the id "container".
// id: It stores the index of the currently selected card.
// cardsElements: It's an array that will store objects containing card elements.
// fetching: It's a flag to prevent multiple fetch requests when one is already in progress.

// Functions:
// taskDone(index): This function sends a POST request to the server when a task is marked as done. It updates the UI by clearing existing cards and fetching new ones.
// removeTask(index): This function sends a POST request to the server to delete a task. Similar to taskDone, it also updates the UI after deleting the task.
// clearCards(): Clears all cards from the page by emptying the cardsElements array.
// fixPHPDone(donedata): Adjusts the text for the PHP done status.
// formatDoneButton(donedata): Formats the button text and style based on whether the task is done or not.
// formatDeadlineDate(deadlineDate): Formats the deadline date, changing the color based on whether it's overdue or not.
// getUserIdFromCookie(): Retrieves the user ID from the cookie.
// fetchData(): Fetches data from the server using a POST request.
// handleChange(index): Handles the change in selected card index.
// getCards(): Fetches cards data from the server and renders them on the UI.
// resetStyle(card): Resets the style of the card.
// promptEmpty(): Prompts the user to add a new task if there are no tasks available.
// updateCards(): Updates the displayed cards in the container based on the current cardsElements array and id.
// nextCard(): Switches to the next card.
// prevCard(): Switches to the previous card.

// Event Listeners:
// taskDone, removeTask, and handleChange are attached as event listeners to specific elements in the DOM.

// Initialization:
// The getCards() function is called initially to fetch and render cards data.
