<?php
/***
Задача:
В переменной $a лежит текст новости. В переменной $link лежит ссылка на страницу с полным текстом этой новости.
Нужно в переменную $b записать сокращенный текст новости по правилам:
- обрезать до 180 символов
- приписать многоточие
- последние 2 слова и многоточие сделать ссылкой на полный текст новости.
***/

/* Возможный вариант решения: */
$a = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam ipsum harum molestiae repellendus esse blanditiis distinctio possimus et fugiat temporibus, quisquam placeat id necessitatibus ipsa pariatur perferendis quod expedita! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam ipsum harum molestiae repellendus esse blanditiis distinctio possimus et fugiat temporibus, quisquam placeat id necessitatibus ipsa pariatur perferendis quod expedita!";
$link = "href_link";

// сокращаем текст новости до 180 символов
$b = substr($a, 0, 180); 
// уберем в конце знаки препинания, если они есть
$b = rtrim($b, "!,.-"); 
// получаем массив слов из нашего отрывка
$words = preg_split("/[\s]+/", $b, -1, PREG_SPLIT_OFFSET_CAPTURE); 
// получаем последние 2 слова отрывка
$last_word = array_pop($words);
$pre_last_word = array_pop($words);
// получаем отрывок без последних двух слов
$b = substr($b, 0, $pre_last_word[1]);
// собираем все воедино
$b .= '<a href="' . $link . '">' . $pre_last_word[0] . " " . $last_word[0] . "...";

echo $b;

/***
Какие проблемы вы видите в решении этой задачи? Что может пойти не так?
***/

/*
На мой взгляд очевидны следующие проблемы:
 - изначальная обрезка до 180 символов, может обрезать так же и слово (как в данном примере);
 - если в тексте будут html теги, так же скрипт отработает не корректно. 
*/
?>