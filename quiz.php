<?php
    require_once "quiz-list.php";

    $topic = $_POST['topic'] ?? '';

    if ($topic === '') {
       echo "Invalid Quiz";
       die;
    }

    if (isset($quizzes[$topic])) {
        $quizTitle = "{$topic} Quiz";

        $quiz = $quizzes[$topic];
    } else {
        echo "Invalid quiz data";
        die;
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><?php echo $quizTitle ?></h2>

    <form action="result.php" method="post">
        <input type="hidden" name="topic" value="<?php echo $topic ?>">
        <?php foreach($quiz as $question) : ?>
            <p><?php echo $question['question'] ?></p>

            <?php foreach($question['options'] as $option) : ?>
                <label><input type="radio" name="<?php echo $question['question'] ?>" value="<?php echo $option ?>"> <?php echo $option ?></label>
                <br>
            <?php endforeach ?>
        <?php endforeach ?>

        <button type="submit">Submit</button>
    </form>
</body>
</html>