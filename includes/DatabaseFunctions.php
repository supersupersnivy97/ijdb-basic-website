<?php
function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);

    /*foreach ($parameters as $name => $value) {
        $query->bindValue($name, $value);
    }*/

    $query->execute($parameters);
    return $query;
}
function totalJokes($pdo) {
    $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
    $row = $query->fetch();
    return $row[0];
}
function getJoke($pdo, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM `joke` WHERE `id`=:id', $parameters);
    return $query->fetch();
}
function insertJoke($pdo, $joketext, $authorId) {
    $query = 'INSERT INTO `joke` (`joketext`, `jokedate`, `authorid`) VALUES (:joketext, CURDATE(), :authorid)';
    query($pdo, $query, [':joketext' => $joketext, ':authorid' => $authorId]);
}
function updateJoke($pdo, $jokeId, $joketext, $authorId) {
    query($pdo, 'UPDATE `joke` SET `authorid` = :authorid, `joketext` = :joketext WHERE `id` = :id', [':id' => $jokeId, ':joketext' => $joketext, ':authorid' => $authorId]);
}
function deleteJoke($pdo, $id) {
    query($pdo, 'DELETE FROM `joke` WHERE `id`=:id', [':id' => $id]);
}
function allJokes($pdo) {
    $jokes = query($pdo, 'SELECT `joke`.`id`, `joketext`,
    `name`, `primaryemail`
        FROM `joke` INNER JOIN `author` 
        ON `authorid` = `author`.`id`');

    return $jokes->fetchAll();
}