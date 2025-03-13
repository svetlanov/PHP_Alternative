<?php
// Читаем сохранённые результаты из файла
$results_file = '../data/results.json';
$results = file_exists($results_file) ? json_decode(file_get_contents($results_file), true) : [];
?>

<h2>Таблица результатов всех пользователей</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Имя пользователя</th>
        <th>Правильных ответов</th>
        <th>Всего вопросов</th>
        <th>Процент правильных ответов</th>
    </tr>

    <?php foreach ($results as $result): ?>
        <tr>
            <td><?= htmlspecialchars($result['username']) ?></td>
            <td><?= $result['correct_answers'] ?></td>
            <td><?= $result['total_questions'] ?></td>
            <td><?= $result['percentage'] ?>%</td>
        </tr>
    <?php endforeach; ?>
</table>
