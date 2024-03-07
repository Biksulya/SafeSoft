<!DOCTYPE html>
<html>
    <head>
        <title>Python Code Analyzer</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #282C34;
                color: #ABB2BF;
                margin: 0;
                padding: 0 10px 0 10px;
            }

            form {
                text-align: center;
            }

            textarea {
                box-sizing: border-box;
                width: 100%;
                height: 200px;
                padding: 10px 0 10px 10px;
                font-size: 14px;
                color: #ABB2BF;
                background-color: #1E2127;
                border: none;
                outline: none;
                resize: none;
            }

            input[type="submit"] {
                margin-top: 10px;
                padding: 8px 20px;
                font-size: 16px;
                font-weight: bold;
                color: #282C34;
                background-color: #61AEEF;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .result {
                min-height: 50px;
                margin: 20px 0 0 0;
                padding: 10px;
                background-color: #1E2127;
                border-radius: 4px;
            }
            .code {
                box-sizing: border-box;
                padding: 10px;
                height: 100%;
                font-family: monospace;
                font-size: 14px;
                white-space: pre;
                background-color: #1E2127;
                border-radius: 4px;
                line-height: 1.5;
                overflow-x: auto;
            }
            .code_container{
                box-sizing: border-box;
                height: 100%;
                /* padding: 5px 10px 10px 10px; */
                padding: 10px;
                margin: 10px 0 0 0;
                border: 2px solid #ABB2BF;
                border-radius: 10px;
            }
            .error {
                color: #F44747;
            }

            .wavy {
                background:red;
            }
            .python_io form{
                padding: 0;
                width: 100%;
            }
            .execute_container{
                width: 100%$_COOKIE;
            }
            .python_io{
                margin-right: 20px;
                width: calc(50% - 20px);
                display: flex;
                flex-direction: column;
            }
            .python_io_container{
                box-sizing: border-box;
                padding: 5px 10px 10px 10px;
                margin: 10px 0 0 0;
                border: 2px solid #ABB2BF;
                border-radius: 10px;
            }
            .container{
                display: flex;
            }
            .python_debug{
                display: flex;
                flex-direction: column;
                width: 50%;
            }
            .python_io h1, .python_debug h1{
                margin: 0;
                text-align: center;
                color: #61AEEF;
            }
            .task_text{
                padding: 0;
                color: white;
            }
            .task_header{
                color: black;
            }
            .hline {
                height: 3px;
                width: 100%;
                background: black;
            }
            h1{
                margin-block-start: 0em;
                margin-block-end: 0em;
                margin-inline-start: 0px;
                margin-inline-end: 0px;
                text-align: center;
                color: #a6caf0;
            }
            .logo_container{
                align-items: center;
                justify-content: center;
                display: flex;
                flex-direction: column;
            }
            /* .logo_container h1{
                margin-right: 20px;
            } */
            .logo_img{
                width: 100px;
                height: 100px;
            }
            h2{
                margin-block-start: 0em;
                margin-block-end: 0em;
                margin-inline-start: 0;
                margin-inline-end: 0;
                text-align: center;
                color:#a6caf0;
                font-size:40px
            }
            .p2 {
                margin: 0 0 3px 0;
            }
            .p2:nth-last-child(1){
                margin: 0;
            }
            .p2:nth-child(1){
                margin-top: 10px;
            }
            @media screen and (width <= 800px){
                .container{
                    margin-top: 50px;
                    display: flex;
                    flex-direction: column;
                }
                .python_io{
                    width: 100%;
                }
                .python_debug{
                    margin-top: 30px;
                    width: 100%;
                }
            } 
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="logo_container">
            <img class='logo_img' src="logo.png" alt="Логотип">
            <h1> SafeSoft </h1>
        </div>
        <div class="container">
            <div class="python_io">
                <h2> Ученик</h2>
                <div class="python_io_container">
                    <div class="task_block">
                        <h1 class='task_header'>Задание</h1>
                        <p class='task_text'>Напишите программу, в которой рассчитывается сумма и произведение цифр положительного трёхзначного числа 123.</p>
                    </div>
                    <div class='hline'></div>
                    <h1 class='python_code_analyzer_header'>Интерпретатор</h1>   
                    <form method="post">
                        <textarea id="code" name="code" placeholder="Введите код Python" rows="10" cols="50"><?php echo isset($_POST['code']) ? htmlspecialchars($_POST['code']) : ''; ?></textarea><br>
                        <input type="submit" name="submit" value="Выполнить">
                    </form>
                    <div class='execute_container'>
                        <?php
                            $code = '';
                            $output = '';
                            // Функция для подсветки синтаксиса Python с использованием стандартной библиотеки tokenizer
                            function highlightPythonCode(string $code): string {
                                $highlightedCode = '';
                                $lines = explode(PHP_EOL, $code);
                                foreach ($lines as $line) {
                                    if (strpos($line, '#') !== false) {
                                        $lineParts = explode('#', $line, 2); // Разбиваем строку на части по символу "#"
                                        $errorPart = $lineParts[1]; // Часть строки после символа "#"
                                        $highlightedCode .= $lineParts[0] . '<span class="wavy">#' . $errorPart . '</span>'; // Оборачиваем часть строки после "#" в тег <span class="wavy"></span> с символом "#"
                                        $highlightedCode .= '<br>';
                                    }
                                        //else {
                                    //     $highlightedCode .= $line;
                                    // }
                                }

                                return $highlightedCode;
                            }
                            if (isset($_POST['submit'])) {
                                $code = $_POST['code'];

                                // Сохраняем код во временный файл
                                $fileName = 'test.py';

                                file_put_contents($fileName, $code);

                                // Выполняем код Python с помощью команды shell_exec
                                $command = "python $fileName";
                                $output = shell_exec($command);

                                unlink($fileName);
                            }
                            echo '<div class="result">';
                            echo '<pre>';
                            echo $output;
                            echo '</pre>';
                            echo '</div>';
                        ?>
                    </div>
                </div>
            </div>
            <div class='python_debug'>
                <h2 class='python_code_analyzer_header'>Преподаватель</h2>
                <div class="code_container">
                    <?php
                        // Вывод кода с подсветкой ошибок и комментариев
                        echo '<div class="code">';
                        echo highlightPythonCode($code);
                        echo '</div>';
                    ?>
                </div>
            </div>
        </div>
        <footer>
            <p class='p2'> Проектная работа «SafeSoft»</p>
            <p class='p2'>Ученики: Новиков Максим Сергеевич, Бурляев Тимур Иванович, 11 класс</p>
            <p class='p2'> Образовательная организация: </p>
            <p class='p2'>  Физико-математическая школа-интернат ФГАОУ ВО «Сибирский федеральный университет», г. Красноярск</p>                   
        </footer>
    </body>
</html>