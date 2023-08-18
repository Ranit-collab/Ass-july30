<!DOCTYPE html>
<html>
<head>
    <title>Simple Dice Roll Game</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            background-image: url("images/1492592.webp");
            background-size: cover;
        }

        .game-container {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }

        .grid-container {
            display: flex;
            justify-content: center;
            /* gap: px; Adjust gap between grid containers as needed */
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 30px); /* Change column count and width as needed */
            grid-template-rows: repeat(3, 30px); /* Change row count and height as needed */
            gap: 5px; /* Adjust gap between cells as needed */
        }

        .grid-item {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            width: 30px;
            height: 30px;
            border: 1px solid black;
        }

        .button-container {
            margin-top: 20px;
        }

        .restart-button, .roll_dice {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
        }

        .restart-button:hover {
            background-color: #45a049;
        }
        
        .roll_dice{
            margin-top: 15px;
        }

        .roll_dice:hover {
            background-color: #45a049;
        }

        h1 {
            margin-bottom: 20px;
            color: #45a049;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <h1>Simple Dice Roll Game</h1>
        <?php
        // Function to simulate a dice roll and return the value (1 to 3)
        function rollDice() {
            return rand(1, 3);
        }

        // Initialize the players' scores and the current turn
        session_start();

        if (!isset($_SESSION['playerAScore'])) {
            $_SESSION['playerAScore'] = 0;
        }

        if (!isset($_SESSION['playerBScore'])) {
            $_SESSION['playerBScore'] = 0;
        }

        if (!isset($_SESSION['currentTurn'])) {
            $_SESSION['currentTurn'] = 'A'; // Set default value if the key is not set
        }

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Determine which player's turn it is
            if ($_SESSION['currentTurn'] === 'A') {
                $diceRoll = rollDice();
                $_SESSION['playerAScore'] += $diceRoll;
                // updatePlayerPosition('A', $diceRoll);
                // Check if Player A wins
                if ($_SESSION['playerAScore'] == 8) {
                    echo "<p>Player A wins!</p>";
                    echo '<div class="button-container">';
                    echo '<a href="restart.php" class="restart-button">Restart Game</a>';
                    echo '</div>';
                    endGame();

                } elseif ($_SESSION['playerAScore'] > 8) {
                    $_SESSION['playerAScore'] -= $diceRoll;
                }
            } else {
                $diceRoll = rollDice();
                $_SESSION['playerBScore'] += $diceRoll;
                // updatePlayerPosition('B', $diceRoll);
                // Check if Player B wins
                if ($_SESSION['playerBScore'] == 8) {
                    echo "<p>Player B wins!</p>";
                    echo '<div class="button-container">';
                    echo '<a href="restart.php" class="restart-button">Restart Game</a>';
                    echo '</div>';
                    endGame();
                } elseif ($_SESSION['playerBScore'] > 8) {
                    $_SESSION['playerBScore'] -= $diceRoll;
                }
            }

            // Switch to the other player's turn

            if (isset($_SESSION['currentTurn'])) { $_SESSION['currentTurn'] = ($_SESSION['currentTurn'] === 'A') ? 'B' : 'A'; }
        }

        // Display the current player's turn (if available)
        if (isset($_SESSION['currentTurn'])) {
            echo "<p>Current Turn: Player {$_SESSION['currentTurn']}</p>";
        }

        
        // Create the dice matrix as a one-dimensional array
        $diceMatrix = array('.', '.', '.', '.', 'S', '.', '.', '.', 'H');


        // Safe position
        $safePosition = 4;

        // Update the dice matrix based on the positions of players A and B
        if (isset($_SESSION['playerAScore'])) {
            if(($_SESSION['playerAScore'] == $safePosition &&  $diceMatrix[$safePosition] == 'B') || ($_SESSION['playerAScore'] == 0 && $_SESSION['playerBScore'] == 0)){
                $diceMatrix[$_SESSION['playerAScore']] = 'AB';
            } elseif($diceMatrix[$_SESSION['playerAScore']] == 'B'){
                $diceMatrix[$_SESSION['playerAScore']] = 'A';
                $_SESSION['playerBScore'] = 0;
                $diceMatrix[$_SESSION['playerBScore']] = 'B';
            } else {
                $diceMatrix[$_SESSION['playerAScore']] = 'A';
            }
            
        }
        if (isset($_SESSION['playerBScore'])) {
            if(($_SESSION['playerBScore'] == $safePosition && $diceMatrix[$safePosition] == 'A') || ($_SESSION['playerAScore'] == 0 && $_SESSION['playerBScore'] == 0)){
                $diceMatrix[$_SESSION['playerBScore']] = 'AB';
            } elseif($diceMatrix[$_SESSION['playerBScore']] == 'A'){
                $diceMatrix[$_SESSION['playerBScore']] = 'B';
                $_SESSION['playerAScore'] = 0;
                $diceMatrix[$_SESSION['playerAScore']] = 'A';
            } else {
                $diceMatrix[$_SESSION['playerBScore']] = 'B';
            }
        }

        // Display the players' scores (if available)
        if (isset($_SESSION['playerAScore']) && isset($_SESSION['playerBScore'])) {
            echo "<p>Player A Score: {$_SESSION['playerAScore']}</p>";
            echo "<p>Player B Score: {$_SESSION['playerBScore']}</p>";
        }

        ?>
        <!-- Display the dice matrix as a single-dimensional array -->
        <?php if (isset($_SESSION['playerAScore']) && $_SESSION['playerAScore'] < 8 && isset($_SESSION['playerBScore']) && $_SESSION['playerBScore'] < 8) { ?>
        <div class="grid-container">
            <div class="grid">
                <div class="grid-item"><?php echo $diceMatrix[7]; ?></div>
                <div class="grid-item"><?php echo $diceMatrix[6]; ?></div>
                <div class="grid-item"><?php echo $diceMatrix[5]; ?></div>
                <div class="grid-item"><?php echo $diceMatrix[0]; ?></div>
                <div class="grid-item"><?php echo $diceMatrix[8]; ?></div>
                <div class="grid-item"><?php echo $diceMatrix[4]; ?></div>
                <div class="grid-item"><?php echo $diceMatrix[1]; ?></div>
                <div class="grid-item"><?php echo $diceMatrix[2]; ?></div>
                <div class="grid-item"><?php echo $diceMatrix[3]; ?></div>
            </div>
        </div>
        <?php }?>
        <!-- <div class="grid-container">
            <div class="grid">
                
            </div>
        </div>
        <div class="grid-container">
            <div class="grid">
                
            </div>
        </div> -->

        <?php
        // echo '<p>';
        // foreach ($diceMatrix as $cell) {
        //     echo "$cell ";
        // }
        // echo '</p>';

        // Display the "Roll Dice" button if the game is still ongoing
        if (isset($_SESSION['playerAScore']) && $_SESSION['playerAScore'] < 8 && isset($_SESSION['playerBScore']) && $_SESSION['playerBScore'] < 8) {
            echo '<form method="post">';
            echo '<input class = "roll_dice" type="submit" value="Roll Dice">';
            echo '</form>';
        } else {
            endGame();
        }

        // Function to end the game and reset the session
        function endGame() {
            session_unset();
            if(isset($_SESSION['currentTurn'])) session_destroy();
        }

        // Function to update player position on the dice matrix
        function updatePlayerPosition($player, $diceRoll) {
            if ($player === 'A') {
                $_SESSION['playerAScore'] = ($_SESSION['playerAScore'] + $diceRoll) % 9;
            } else {
                $_SESSION['playerBScore'] = ($_SESSION['playerBScore'] + $diceRoll) % 9;
            }
        }
        ?>
        <!-- Display the restart button -->
        <?php if (isset($_SESSION['playerAScore']) && $_SESSION['playerAScore'] < 8 && isset($_SESSION['playerBScore']) && $_SESSION['playerBScore'] < 8) { ?>
        <div class="button-container">
            <a href="restart.php" class="restart-button">Restart Game</a>
        </div>
        <?php } ?>
    </div>
</body>
</html>



