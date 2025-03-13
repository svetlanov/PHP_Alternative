<?php
    /**
     * Сохраняет результат теста пользователя в JSON-файл.
     *
     * Функция получает массив с результатом тестирования, затем:
     * - Проверяет, существует ли файл с предыдущими результатами.
     * - Если файл существует, декодирует его содержимое в массив, иначе создаёт новый пустой массив.
     * - Добавляет новый результат в массив всех результатов.
     * - Кодирует массив в формат JSON с форматированием и сохраняет его в файл.
     *
     * @param array $user_result Массив с результатами теста пользователя. Обычно содержит ключи:
     *                           - "username": Имя пользователя.
     *                           - "correct_answers": Количество правильных ответов.
     *                           - "total_questions": Общее количество вопросов.
     *                           - "percentage": Процент правильных ответов.
     *
     * @return void
     */
    function saveUserResult($user_result) {

        $results_file = '../data/results.json';

        // Получаем предыдущие результаты или создаём новый массив
        $all_results = file_exists($results_file) ? json_decode(file_get_contents($results_file), true) : [];

        // Добавляем новый результат
        $all_results[] = $user_result;

        // Сохраняем в файл
        file_put_contents($results_file, json_encode($all_results, JSON_PRETTY_PRINT));
    }

?>