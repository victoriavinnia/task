<?php
$server = '127.0.0.1';
$db = 'task'; // имя базы данных
$login = 'user'; // пользователь
$pwd = 12344321; // пароль
$charset = 'utf8'; // кодировка

$dsn = "mysql:host=$server;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $login,$pwd,$options);
//var_dump($pdo);

$arr = array(
    array('Пожалуйста', 'Просто', 'Если сможете'),
    array('удивительное', 'крутое', 'простое', 'важное', 'бесполезное'),
    array('быстро', 'мгновенно', 'оперативно', 'правильно'),
    array('изменялось случайным образом', 'менялось каждый раз'),
);
$word1 = $arr[0][rand(0, count($arr[0]) - 1)];
$word2 = $arr[1][rand(0, count($arr[1]) - 1)];
$word3 = $arr[2][rand(0, count($arr[2]) - 1)];
$word4 = $arr[3][rand(0, count($arr[3]) - 1)];
if($word4 == "изменялось случайным образом") {
    $str = $word1.' сделайте так, чтобы это '.$word2.' тестовое предложение '.$word4.' '.$word3.'.';
    echo $str;
    $sql = "SELECT * FROM task";
    $statement = $pdo->query($sql);
    $data = $statement->fetchAll();
    foreach ($data as $elem) {
      //  var_dump($elem);
        foreach ($elem as $key => $value) {
            if ($value === $str) {
                return;
            }
        }
    }
    $str_sql = "INSERT INTO task (`sentence`) VALUES (:sentence)";
    $preparedStatement = $pdo->prepare($str_sql);
    $preparedStatement->bindParam(':sentence', $str);
    $preparedStatement->execute();
} elseif ($word4 == "менялось каждый раз") {
    $str = $word1.' сделайте так, чтобы это '.$word2.' тестовое предложение '.$word4;
    echo $str;
    $sql = "SELECT * FROM task";
    $statement = $pdo->query($sql);
    $data = $statement->fetchAll();
    foreach ($data as $elem) {
        //  var_dump($elem);
        foreach ($elem as $key => $value) {
            if ($value === $str) {
                return;
            }
        }
    }
    $str_sql = "INSERT INTO task (`sentence`) VALUES (:sentence)";
    $preparedStatement = $pdo->prepare($str_sql);
    $preparedStatement->bindParam(':sentence', $str);
    $preparedStatement->execute();
}
