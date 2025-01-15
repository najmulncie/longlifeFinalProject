@extends('user.user_dashboard')


@section('title', 'Lucky-Royel')


@section('body')

<style>

.game-container {
            width: 400px;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .balls {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .ball {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
        .red { background: red; }
        .green { background: green; }
        .blue { background: blue; }
        .yellow { background: yellow; }
        .timer {
            font-size: 24px;
            margin-top: 20px;
        }
        .bet-buttons button {
            margin: 5px;
        }
    </style>
    <div class="game-container">
    <h2>Betting Game</h2>
    <p>Select a ball color and bet amount.</p>
    <div class="balls">
        <div class="ball red" data-color="red">1</div>
        <div class="ball green" data-color="green">2</div>
        <div class="ball blue" data-color="blue">3</div>
        <div class="ball yellow" data-color="yellow">4</div>
    </div>
    <div>
        <select id="bet-amount" class="form-select w-50 mx-auto">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="1000">1000</option>
        </select>
    </div>
    <button class="btn btn-primary mt-3" id="place-bet">Place Bet</button>
    <div class="timer" id="timer">Time: 0s</div>
    <p id="result" class="mt-3"></p>
</div>

<script>
    const timerDisplay = document.getElementById('timer');
    const resultDisplay = document.getElementById('result');
    const balls = document.querySelectorAll('.ball');
    const betButton = document.getElementById('place-bet');
    let selectedColor = null;

    // Ball selection logic
    balls.forEach(ball => {
        ball.addEventListener('click', () => {
            balls.forEach(b => b.style.border = "none"); // Clear previous selection
            ball.style.border = "3px solid black"; // Highlight selected ball
            selectedColor = ball.getAttribute('data-color');
            resultDisplay.innerText = `You selected ${selectedColor.toUpperCase()}!`;
        });
    });

    // Countdown and result logic
    betButton.addEventListener('click', () => {
        if (!selectedColor) {
            resultDisplay.innerText = "Please select a color!";
            return;
        }

        const betAmount = parseInt(document.getElementById('bet-amount').value);
        let timeLeft = 30; // Countdown start
        timerDisplay.innerText = `Time: ${timeLeft}s`;

        const timer = setInterval(() => {
            timeLeft--;
            timerDisplay.innerText = `Time: ${timeLeft}s`;

            // Beep sound at 5 seconds
            if (timeLeft === 5) {
                console.log("Beep!");
            }

            // Timer ends
            if (timeLeft === 0) {
                clearInterval(timer);
                const winningColor = ["red", "green", "blue", "yellow"][Math.floor(Math.random() * 4)];
                const win = selectedColor === winningColor;
                resultDisplay.innerText = win
                    ? `You WIN! Winning color: ${winningColor.toUpperCase()}, Amount won: ${betAmount * 2}`
                    : `You LOSE! Winning color: ${winningColor.toUpperCase()}`;
            }
        }, 1000);
    });
</script>

@endsection
