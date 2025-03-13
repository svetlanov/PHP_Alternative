# PHP Alternative

## Описание

Проект **PHP Alternative** представляет собой простую систему тестирования на PHP, позволяющую пользователю проходить тесты, получать результаты и просматривать их в виде таблицы. Приложение реализует следующие функции:

- **Создание теста:** Вопросы и варианты ответов загружаются из файла в формате JSON.
- **Прохождение теста:** Пользователь вводит своё имя, выбирает ответы (вопросы с одним правильным ответом отображаются с использованием radio, с несколькими – checkbox) и отправляет форму.
- **Подсчёт результатов:** После завершения теста происходит проверка правильности ответов, вычисляется количество правильных ответов и процент набранных баллов.
- **Хранение данных:** Результаты тестов (имя пользователя и набранные баллы) сохраняются в JSON-файл.
- **Просмотр результатов:** Все результаты доступны для просмотра в виде таблицы по URL `/dashboard.php`.

## Установка и запуск проекта

1. **Клонирование репозитория:**

```bash
git clone https://github.com/svetlanov/PHP_Alternative.git
```

2. **Настройка веб-сервера:**

- **Локальный запуск:**  
  Перейдите в корневую директорию проекта и запустите встроенный сервер PHP:
  ```bash
  php -S localhost:8000
  ```
  Затем откройте в браузере [http://localhost:8000/index.php](http://localhost:8000/index.php).


## Описание основных функций

Проект использует несколько серверных функций для обработки тестов. Вот описание ключевых функций:

### 1. `validateUserResponse($user_answers, $username)`

Эта функция:
- Загружает вопросы из файла `quiz.json`.
- Сравнивает ответы пользователя с правильными ответами.
- Подсчитывает количество правильных ответов.
- Вычисляет процент правильных ответов.
- Возвращает массив с результатами теста (имя пользователя, количество правильных ответов, общее число вопросов и процент правильных ответов).

**Пример PHPDoc для функции:**
```
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
 *               - \"username\": Имя пользователя.
 *               - \"correct_answers\": Количество правильных ответов.
 *               - \"total_questions\": Общее количество вопросов.
 *               - \"percentage\": Процент набранных правильных ответов.
 */
```

### 2. `saveUserResult($user_result)`

Эта функция:
- Принимает массив с результатами теста.
- Считывает предыдущие результаты из файла `results.json` (если файл существует).
- Добавляет новый результат к массиву всех результатов.
- Сохраняет обновлённый массив обратно в файл `results.json`.

**Пример PHPDoc для функции:**
```
/**
 * Сохраняет результат теста пользователя в JSON-файл.
 *
 * Функция получает массив с результатами теста, затем:
 * - Проверяет, существует ли файл с предыдущими результатами.
 * - Если файл существует, декодирует его содержимое в массив, иначе создаёт новый пустой массив.
 * - Добавляет новый результат в массив всех результатов.
 * - Кодирует массив в формат JSON с форматированием и сохраняет его в файл.
 *
 * @param array $user_result Массив с результатами теста пользователя. Обычно содержит ключи:
 *                           - \"username\": Имя пользователя.
 *                           - \"correct_answers\": Количество правильных ответов.
 *                           - \"total_questions\": Общее количество вопросов.
 *                           - \"percentage\": Процент правильных ответов.
 *
 * @return void
 */
```

### Дополнительные файлы

- **`quiz.json`**: Содержит список вопросов, варианты ответов и правильные ответы в формате JSON.
- **`results.json`**: Файл, в котором сохраняются результаты тестирования пользователей. Создаётся автоматически при первом сохранении результата.

## Работа проекта

1. **Прохождение теста:**  
   На странице `test.php` пользователь вводит своё имя и выбирает ответы на вопросы. Форма отправляет данные на страницу `result.php`.

2. **Подсчёт результатов:**  
   На странице `result.php` происходит обработка данных, подсчёт правильных ответов, вычисление процента набранных баллов, сохранение результата и вывод информации пользователю.

3. **Просмотр всех результатов:**  
   Страница `dashboard.php` считывает все результаты из файла `results.json` и отображает их в виде таблицы.
