let timerSeconds = 0;
let timerInterval = null;
let timerRunning = false;

function updateTimerDisplay() {

    const display = document.getElementById("timer");

    if (!display) return;

    let minutes = Math.floor(timerSeconds / 60);
    let seconds = timerSeconds % 60;

    minutes = String(minutes).padStart(2, "0");
    seconds = String(seconds).padStart(2, "0");

    display.textContent = `${minutes}:${seconds}`;
}

function startTimer() {

    if (timerRunning) return;

    timerRunning = true;

    timerInterval = setInterval(() => {

        timerSeconds++;

        updateTimerDisplay();

    }, 1000);
}

function pauseTimer() {

    timerRunning = false;

    clearInterval(timerInterval);
}

function resetTimer() {

    timerRunning = false;

    clearInterval(timerInterval);

    timerSeconds = 0;

    updateTimerDisplay();
}

updateTimerDisplay();