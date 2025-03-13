<?php
    /**
     * Валидирует ответы пользователя и вычисляет результат теста.
     *
     * Функция принимает ответы пользователя и имя, затем загружает тестовые вопросы из JSON-файла,
     * подсчитывает количество правильных ответов и вычисляет процент правильных ответов.
     *
     * @param array  $user_answers Массив ответов пользователя, где ключами являются индексы вопросов, а значениями – выбранные варианты.
     * @param string $username     Имя пользователя, прошедшего тест.
     *
     * @return array Массив с результатами теста, содержащий следующие ключи:
     *               - "username": Имя пользователя.
     *               - "correct_answers": Количество правильных ответов.
     *               - "total_questions": Общее количество вопросов.
     *               - "percentage": Процент набранных правильных ответов.
     */
    function validateUserResponse($user_answers, $username) {
        // Загружаем вопросы с правильными ответами
        $questions = json_decode(file_get_contents('../data/quiz.json'), true);

        $total_questions = count($questions);
        $correct_count = 0;

        // Подсчёт правильных ответов
        foreach ($questions as $index => $question) {
            $correct_answers = $question['correct'];
            $answers_given = isset($user_answers[$index]) ? $user_answers[$index] : [];

            // Сортируем для сравнения (особенно важно для checkbox)
            sort($correct_answers);
            sort($answers_given);

            if ($correct_answers == $answers_given) {
                $correct_count++;
            }
        }

        // Рассчитываем процент
        $percentage = round(($correct_count / $total_questions) * 100, 2);

        return [
            "username" => $username,
            "correct_answers" => $correct_count,
            "total_questions" => $total_questions,
            "percentage" => $percentage
        ];
    }
?>