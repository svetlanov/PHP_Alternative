<?php
require_once('../utils/answersValidation.php');
require_once('../utils/saveAnswers.php');
// Получаем данные с формы
$username = trim(htmlspecialchars($_POST['username']));
$user_answers = $_POST['answer'];

$test_results = validateUserResponse($user_answers, $username);

saveUserResult($test_results)

?>

<!-- Выводим результаты пользователю -->
<h2>Результат теста для <?= htmlspecialchars($username) ?>:</h2>
<p>Правильных ответов: <?= $test_results['correct_answers'] ?> из <?= $test_results['total_questions'] ?></p>
<p>Набрано баллов: <?= $test_results['percentage'] ?>%</p>

<a href="./dashboard.php">Посмотреть все результаты</a>
