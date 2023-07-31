<!DOCTYPE html>
<html>
<head>
    <title>Simple Dice Roll Game</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url("images/1492592.webp");
            background-size: cover;
        }

        .restart-button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .button-container{
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    
    <div class="button-container">
        <h1>Game Restarted!</h1>
        <a href="index.php" class="restart-button">Play Again</a>
    </div>
</body>
</html>
