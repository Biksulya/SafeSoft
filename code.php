<?php
// Включаем вывод всех ошибок и предупреждений
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Функция, которая компилирует и исполняет код пользователя
function compileAndExecute($userCode) {
  // Получение кода пользователя (предполагается, что он передан, например, через POST-запрос)
$userCode = $_POST['user_code'];

// Путь к интерпретатору Python (может отличаться в зависимости от вашей конфигурации)
$pythonInterpreterPath = '/usr/bin/python3';

// Создание временного файла для хранения кода пользователя
$tmpFile = tempnam(sys_get_temp_dir(), 'user_code_');
$fileHandle = fopen($tmpFile, 'w');
fwrite($fileHandle, $userCode);
fclose($fileHandle);

// Компиляция и исполнение кода пользователя
try {
    // Компиляция и исполнение кода пользователя с помощью интерпретатора Python
    exec($pythonInterpreterPath . ' ' . $tmpFile, $output, $returnCode);

    // Проверка результата исполнения
    if ($returnCode === 0) {
        // Код исполнен успешно
        echo "Результат выполнения:\n";
        echo implode("\n", $output);
    } else {
        // Произошла ошибка при исполнении кода
        echo "Ошибка исполнения кода";
    }
} catch (Exception $e) {
    // Обработка ошибок
    echo "Ошибка: " . $e->getMessage();
}
?>
<html>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Code Executor</title>
	<style>
		body {
			font-family: Arial, sans-serif;
		}
		textarea {
			width: 500px;
			height: 300px;
		}
	</style>
	<script>
	</script>
</head>
<body>
<form method="post" action="">
	<h1>Python Code Executor</h1>
	<textarea id="code"
	          name="code"
	          placeholder="Введите код Python"
	          class="result"><?php echo !empty($_POST["code"]) ? $_POST['code'] : '' ?></textarea>
	<br /><br />
	<button type="submit">Выполнить</button>
</form>

Результат:
<?php
if (!empty($_POST["code"])) {
?>
	<div>
		<?php
		
		$pythonCode = $_POST["code"];

		
		$fileName = 'test.py';

		file_put_contents($fileName, $pythonCode);

		
		$command = "python $fileName";
		$output = shell_exec($command);

		
		echo $output;

		
		unlink($fileName);
		?>
	</div>
<?php } ?>
</body>
</html>
<?php
   
}


if ($submittedAnswers) {
    foreach ($submittedAnswers as $questionId => $userAnswer) {
        
        if ($questionType[$questionId] == 'python_code') {
            $compiledResult = compileAndExecute($userAnswer);

            
            if ($compiledResult == $expectedResult) {
                
                $score++; 
            } else {
                $score--; 
            }
        
    
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$studentId = $_POST['student_id'];   
$newGrade = $_POST['new_grade'];      


$sql = "UPDATE students SET grade = $newGrade WHERE id = $studentId";

if ($conn->query($sql) === TRUE) {
    echo "Оценка студента успешно обновлена";
} else {
    echo "Ошибка при обновлении оценки студента: " . $conn->error;
}

$conn->close();
    }
}
}
?>
<?php


$testCases = [
    ['input' => 5, 'output' => 25],
    ['input' => 0, 'output' => 0],
    
];


function square($num) {
    return $num * $num;
}


foreach ($testCases as $testCase) {
    $input = $testCase['input'];
    $expectedOutput = $testCase['output'];

  
    $actualOutput = square($input);

    
    if ($actualOutput === $expectedOutput) {
        echo "Тест пройден для входного значения {$input}.<br>";
    } else {
        echo "Тест не пройден для входного значения {$input}.<br>";
        echo "Ожидаемый вывод: {$expectedOutput}<br>";
        echo "Фактический вывод: {$actualOutput}<br>";
    }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $code = $_POST['code'];

    
    if (!empty($code)) {
       
        if (!preg_match('/(system|exec|shell_exec|passthru|popen|proc_open)/i', $code)) {
          
            ob_start();
            eval($code);
            $output = ob_get_clean();

           
            echo $output;
        } else {
            echo 'Ошибка: Недопустимый код';
        }
    } else {
        echo 'Ошибка: Код не был введен';
    }
}
?>
<?php

$pythonCode = 'print("Hello, World!")';


$command = 'python -c "' . $pythonCode . '"';


$result = exec($command);


echo $result;

$pythonCode = 'print("Hello, World!")';


$command = 'python -c "' . $pythonCode . '"';


$result = shell_exec($command);


echo $result;


class PythonCodeRunner {
    public function run($code) {
        class Question {
            private $text;
            private $type;
            private $options;
            
            public function __construct($text, $type, $options) {
               $this->text = $text;
               $this->type = $type;
               $this->options = $options;
            }
            
            public function getText() {
               return $this->text;
            }
            
            public function getType() {
               return $this->type;
            }
            
            public function getOptions() {
               return $this->options;
            }
            
    
         }
    }
}
$text = "Какой ваш любимый цвет?";
$type = "выбор одного варианта";
$options = ["Синий", "Красный", "Зеленый"];

$question = new Question($text, $type, $options);
echo $question->getText(); 
echo $question->getType(); 
print_r($question->getOptions()); 


class CodeManager {
    public function fixCode($code) {
       
    }
    
    public function addCode($code) {
       
    }
}


class AutoGrader {
    public function grade($code) {
        $userCode = $_POST['user_code'];
        $tmpFile = tempnam(sys_get_temp_dir(), 'user_code_');
        $fileHandle = fopen($tmpFile, 'w');
        fwrite($fileHandle, $userCode);
        fclose($fileHandle);
        $testFile = 'test.php';
$output = [];
$returnCode = 0;
exec("php $testFile $tmpFile", $output, $returnCode);
if ($returnCode === 0) {
    echo "Результат проверки:\n";
    echo implode("\n", $output);
} else {
    echo "Ошибка при выполнении тестов";
}
unlink($tmpFile);
    }
}


class SolutionManager {
    public function saveSolution($solution) {
        
$answer = $_POST['answer'];


$file = fopen("solutions.txt", "a");


if (fwrite($file, $answer . "\n") !== false) {
    echo "Решение успешно сохранено";
} else {
    echo "Ошибка сохранения решения";
}


fclose($file);

$servername = "localhost";
$username = "пользователь";
$password = "пароль";
$dbname = "имя_базы_данных";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


$answer = $_POST['answer'];


$sql = "INSERT INTO solutions (answer) VALUES ('$answer')";


if ($conn->query($sql) === TRUE) {
    echo "Решение успешно сохранено";
} else {
    echo "Ошибка сохранения решения: " . $conn->error;
}


$conn->close();
    }
    
    public function getSolution($solutionId) {
        $a = 5;
        $b = 10;
        $c = $a + $b;
        echo $c; 
        function sum($a, $b) {
            return $a + $b;
          }
          $result = sum(5, 10);
          echo $result; 
          class Calculator {
            public function sum($a, $b) {
              return $a + $b;
            }
          }
          
          $calculator = new Calculator();
          $result = $calculator->sum(5, 10);
          echo $result; 
    }
} 
?>