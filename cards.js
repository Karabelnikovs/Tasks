const container = document.getElementById("container");
// INTEGRATE THIS INTO THE PHP CODE USE INSTEAD OF DEFAULT LAYOUT IN TASKS.VIEW.PHP
let id = 0;
let cards = [
  { name: "Card 1",
  task: "bla bla bla",

  created: "1999-12-31 23:59:59" ,
  deadline: "1999-12-31 23:59:59"  },
  { name: "Card 2",
  created: "1999-12-31 23:59:59" ,
  task: "bla bla bla",

  created: "1999-12-31 23:59:59" ,
  deadline: "1999-12-31 23:59:59"  },
  { name: "Card 3",
  task: "bla bla bla",

  created: "1999-12-31 23:59:59" ,
  deadline: "1999-12-31 23:59:59"  },
  { name: "Card 4",
  task: "bla bla bla",

  created: "1999-12-31 23:59:59" ,
  deadline: "1999-12-31 23:59:59"  },
  { name: "Card 5",
  task: "bla bla bla",

  created: "1999-12-31 23:59:59" ,
  deadline: "1999-12-31 23:59:59"  },
  { name: "Card 6",
  task: "bla bla bla",

  created: "1999-12-31 23:59:59" ,
  deadline: "1999-12-31 23:59:59"  },
  { name: "Card 7",
  task: "bla bla bla",

  created: "1999-12-31 23:59:59" ,
  deadline: "1999-12-31 23:59:59"  },
  { name: "Card 8",
    task: "bla bla bla",
  
    created: "1999-12-31 23:59:59" ,
    deadline: "1999-12-31 23:59:59" },
];
let cardsElements = [];

cards.forEach((card, index) => {
  cardPush = document.createElement("div");
  cardPush.classList.add("card");
  cardPush.id = index;
  cardPush.innerHTML += `<h2>${card.name}</h2>`;
  cardPush.innerHTML += `<h2>${card.task}</h2>`;
  cardPush.innerHTML += `<h2>${card.deadline}</h2>`;
  cardPush.innerHTML += `<h2>${card.created}</h2>`;

  cardPush.addEventListener("click", () => {
    if (index != id) {
      id = index;
      updateCards();
    }
  });
  let done = card.completed;
  cardPushArr = {card : cardPush, completion: done}
  cardsElements.push(cardPushArr);
  console.log(cardsElements)
});
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
    container.innerHTML = "No cards to show";
  }
}
container.innerHTML = cards[id];
function nextCard() {
  id++;
  if (id === cardsElements.length) {
    id = 0;
  }
  updateCards();
}
function prevCard() {
  id--;
  if (id < 0) {
    id = cardsElements.length - 1;
  }
  updateCards();
}
updateCards();
