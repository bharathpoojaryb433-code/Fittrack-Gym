let playerName = "";
let petName = "";
let petType = "dog";

let hunger = 80;
let happiness = 80;
let energy = 80;
let health = 100;

let coins = 0;
let score = 0;
let gameRunning = true;


/* LOGIN */

function startGame() {

    playerName = document.getElementById("playerName").value.trim();
    petName = document.getElementById("petName").value.trim();
    petType = document.getElementById("petType").value;

    if (playerName === "" || petName === "") {
        alert("Please enter your name and pet name!");
        return;
    }

    document.getElementById("loginPage").classList.add("hidden");
    document.getElementById("gamePage").classList.remove("hidden");

    document.getElementById("playerDisplay").textContent = playerName;
    document.getElementById("petNameDisplay").textContent = petName;

    setPet();

    updateStats();
}


/* SET PET */

function setPet() {

    let emoji = petType === "dog" ? "🐶" : "🐱";

    document.getElementById("petDisplay").textContent = emoji;
    document.getElementById("loginPet").textContent = emoji;
}


/* FEED */

function feedPet() {

    if (hunger >= 100) {
        showMessage("I'm not hungry! 😋");
        return;
    }

    hunger += 20;

    if (hunger > 100) hunger = 100;

    happiness += 5;

    if (happiness > 100) happiness = 100;

    coins += 2;

    showMessage("Yummy! Thank you for the food! 🍖");

    updateStats();
}


/* PLAY */

function playPet() {

    if (energy < 15) {
        showMessage("I'm too tired! 😴");
        return;
    }

    happiness += 20;
    energy -= 15;
    hunger -= 10;

    if (happiness > 100) happiness = 100;
    if (hunger < 0) hunger = 0;

    coins += 5;

    showMessage("That was fun! 🎾");

    updateStats();
}


/* SLEEP */

function sleepPet() {

    showMessage("Good night... 😴");

    document.getElementById("petDisplay").style.animation =
        "none";

    setTimeout(() => {

        energy += 40;

        if (energy > 100) energy = 100;

        document.getElementById("petDisplay").style.animation =
            "petBounce 2s infinite";

        showMessage("Good morning! I feel great! ☀️");

        updateStats();

    }, 2000);
}


/* CARE */

function carePet() {

    health += 20;
    happiness += 10;

    if (health > 100) health = 100;
    if (happiness > 100) happiness = 100;

    coins += 3;

    showMessage("Thank you for taking care of me! ❤️");

    updateStats();
}


/* UPDATE STATS */

function updateStats() {

    hunger = Math.max(0, Math.min(100, hunger));
    happiness = Math.max(0, Math.min(100, happiness));
    energy = Math.max(0, Math.min(100, energy));
    health = Math.max(0, Math.min(100, health));

    document.getElementById("hungerBar").style.width =
        hunger + "%";

    document.getElementById("happyBar").style.width =
        happiness + "%";

    document.getElementById("energyBar").style.width =
        energy + "%";

    document.getElementById("healthBar").style.width =
        health + "%";


    document.getElementById("hungerText").textContent =
        hunger;

    document.getElementById("happyText").textContent =
        happiness;

    document.getElementById("energyText").textContent =
        energy;

    document.getElementById("healthText").textContent =
        health;

    document.getElementById("coins").textContent =
        coins;
}


/* MESSAGE */

function showMessage(message) {

    document.getElementById("petMessage").textContent =
        message;
}


/* MENU */

function toggleMenu() {

    document.getElementById("menu")
        .classList.toggle("active");
}


/* HOME */

function showHome() {

    document.getElementById("homeSection")
        .classList.remove("hidden");

    document.getElementById("miniGame")
        .classList.add("hidden");

    document.getElementById("menu")
        .classList.remove("active");
}


/* MINI GAME */

function openGame() {

    document.getElementById("homeSection")
        .classList.add("hidden");

    document.getElementById("miniGame")
        .classList.remove("hidden");

    score = 0;

    document.getElementById("score").textContent = score;

    moveBall();

    document.getElementById("menu")
        .classList.remove("active");
}


/* CATCH BALL */

function catchBall() {

    score++;

    document.getElementById("score").textContent =
        score;

    if (score % 5 === 0) {
        coins += 10;
        updateStats();
    }

    moveBall();
}


/* MOVE BALL */

function moveBall() {

    const area = document.getElementById("gameArea");
    const ball = document.getElementById("ball");

    let maxX = area.clientWidth - 60;
    let maxY = area.clientHeight - 60;

    let x = Math.random() * maxX;
    let y = Math.random() * maxY;

    ball.style.left = x + "px";
    ball.style.top = y + "px";
}


/* RESTART GAME */

function restartGame() {

    score = 0;

    document.getElementById("score").textContent =
        score;

    moveBall();
}


/* PET STATUS CHANGES OVER TIME */

setInterval(() => {

    if (document.getElementById("gamePage").classList.contains("hidden")) {
        return;
    }

    hunger -= 2;
    energy -= 1;
    happiness -= 1;

    if (hunger < 0) hunger = 0;
    if (energy < 0) energy = 0;
    if (happiness < 0) happiness = 0;

    if (hunger < 30 || happiness < 30) {
        health -= 1;
    }

    if (health < 0) health = 0;

    updateStats();

}, 10000);
function startGame() {

    playerName = document.getElementById("playerName").value.trim();
    petName = document.getElementById("petName").value.trim();
    petType = document.getElementById("petType").value;

    // Check names
    if (playerName === "" || petName === "") {
        alert("Please enter your name and pet name!");
        return;
    }

    // Select sound automatically
    if (petType === "dog") {

        const dogSound = document.getElementById("dogBark");

        dogSound.currentTime = 0;
        dogSound.play();

    } else if (petType === "cat") {

        const catSound = document.getElementById("catMeow");

        catSound.currentTime = 0;
        catSound.play();
    }

    // Open game
    document.getElementById("loginPage").classList.add("hidden");
    document.getElementById("gamePage").classList.remove("hidden");

    // Show player and pet name
    document.getElementById("playerDisplay").textContent = playerName;
    document.getElementById("petNameDisplay").textContent = petName;

    // Set selected pet
    setPet();

    // Update stats
    updateStats();

    // Message
    if (petType === "dog") {
        showMessage("Woof! Woof! 🐶 I'm ready to play!");
    } else {
        showMessage("Meow! Meow! 🐱 I'm ready to play!");
    }
}