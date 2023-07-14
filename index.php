<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Select a Quiz Topic</h2>
    <form action="quiz.php" method='post'>
        <label><input type='radio' name='topic' value='science'> Science</label><br>
        <label><input type='radio' name='topic' value='history'> History</label><br>
        <!-- Add more quiz topics here -->
        <br>
        <button type='submit'>Start Quiz</button>
    </form>
</body>
</html>