<!DOCTYPE html>
<html>
<head>
    <title>Ludo Game - Front Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin: 0;
            padding: 20px;
            background-image: url("images/1492592.webp");
            background-size: cover;
        }

        h1 {
            color: #45a049;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .start-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .start-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Ludo Game</h1>
        <p>Click the button below to start the game.</p>
        <form action="game.php" >
            <button class="start-button" type="submit">Start Game</button>
        </form>
    </div>
</body>
</html>
