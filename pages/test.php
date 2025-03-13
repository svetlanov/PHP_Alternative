<form action="./result.php" method="POST"> 
    <label>Введите ваше имя:</label>
    <input type="text" name="username" required>

    <?php // выше - // Означает, что после отправки формы, ответы будут переданы на dashboard страницу;  данные формы отправляются скрыто - post
    $questions = json_decode(file_get_contents('../data/quiz.json'), true); // son_decode - расшифровывает json в php, если true - превращается в php-массив; теперь перем-я $questions содержит массив вопросов

    foreach ($questions as $index => $q): // проходит по кажд эл-ту массива questions; $index — номер текущего вопроса ; $q — текущий вопрос (массив с текстом и ответами)
        echo "<h3>" . ($index + 1) . ". {$q['question']}</h3>"; // Выводит номер и текст вопроса на страницу

        foreach ($q['options'] as $option): // Проходит по каждому варианту ответа для текущего вопроса
            if ($q['type'] == 'radio'):
    ?>
                <label>
                    <input type="radio" name="answer[<?php echo $index ?>][]" value="<?php echo $option ?>" required>
                    <?php echo $option ?>
                </label><br>
    <?php else: ?>
                <label>
                    <input type="checkbox" name="answer[<?php echo $index ?>][]" value="<?php echo $option ?>">
                    <?php echo $option ?>
                </label><br>
    <?php
            endif;
        endforeach;
    endforeach;
    ?>

    <button type="submit">Завершить тест</button>
</form>
