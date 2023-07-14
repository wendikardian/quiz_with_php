<?php

require_once "quiz-list.php";

$answers = $_POST;
$topic = $_POST['topic'] ?? '';

if ($topic === '') {
    echo "Invalid Quiz";
    die;
}

if (isset($quizzes[$topic])) {
    $quiz = $quizzes[$topic];
    $totalQuestions = count($quiz);
    $correctAnswers = 0;
    $keyAnswers = [];

    foreach ($quiz as $question) {
        $questionText = str_replace(' ', '_', $question['question']);
        $selectedAnswer = $answers[$questionText];

        if ($selectedAnswer === $question['answer']) {
            $correctAnswers++;
            //   add question to key answer but with a new key called 'isRight' set to true
            $question['isRight'] = true;
            $keyAnswers[] = $question;
        } else {
            $question['isRight'] = false;
            $keyAnswers[] = $question;
        }

        // print_r($keyAnswers);
    }

    $score = ($correctAnswers / $totalQuestions) * 100;
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
    <h2>Quiz Results</h2>
    <p>Total Questions: <?php echo $totalQuestions ?></p>
    <p>Correct Answers: <?php echo $correctAnswers ?></p>
    <p>Score: <?php echo $score ?>%</p>


    <!-- render $keyAnswers from question and check if the question is right or not  -->
    <?php foreach ($keyAnswers as $keyAnswer) : ?>
        <p>
            <?php echo $keyAnswer['question'] ?>
            <?php if ($keyAnswer['isRight']) : ?>
                <span style="color: green">Correct</span>
            <?php else : ?>
                <span style="color: red">Incorrect</span>
            <?php endif ?>
            <!-- Also render the options using for each and tell the correct answer -->
        <ul>
            <?php foreach ($keyAnswer['options'] as $option) : ?>
                <li>
                    <?php echo $option ?>
                    <?php if ($option === $keyAnswer['answer']) : ?>
                        <span style="color: green">Correct Answer</span>
                    <?php endif ?>
                    <!-- check if this is selectedAnswer of the user -->
                    <?php if ($option === $answers[str_replace(' ', '_', $keyAnswer['question'])] and $keyAnswer['isRight'] == false) : ?>
                        <span style="color: red">Your Answer</span>
                    <?php endif ?>
                </li>
            <?php endforeach ?>
        </ul>
        </p>
    <?php endforeach ?>

    <!-- Check if the score is equal or more than 75 %  will display you pass the test else you fail -->
    <?php if ($score >= 75) : ?>
        <h3 style="color: green">You pass the test</h3>
    <?php else : ?>
        <h3 style="color: red">You fail the test</h3>
        <!-- link to take back to exam -->
        <a href="index.php">Take the exam again</a>
    <?php endif ?>
</body>

</html>