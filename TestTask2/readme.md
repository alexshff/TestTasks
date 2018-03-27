# Тестовое задание 2
## Проектирование базы данных
### Таблица для хранения авторов
SQL-запрос
```SQL
CREATE TABLE `authors` (
`AuthorID` int(5) NOT NULL AUTO_INCREMENT,
`FirstName` varchar(255) NOT NULL,
`LastName` varchar(255) NOT NULL,
PRIMARY KEY (`AuthorID`)
);
```
Структура таблицы

| Field     | Type         | Null | Key | Default | Extra          |
|-----------|--------------|------|-----|---------|----------------|
| AuthorID  | int(5)       | NO   | PRI | NULL    | auto_increment |
| FirstName | varchar(255) | NO   |     | NULL    |                |
| LastName  | varchar(255) | NO   |     | NULL    |                |

Таблица с данными

| AuthorID | FirstName | LastName |
|----------|-----------|----------|
|        1 | William   | White    |
|        2 | Malthe    | Smith    |
|       ...| ...       | ...      |
|       98 | Emil      | Thompson |
|       99 | Carl      | Davies   |


### Таблица для хранения книг
SQL-запрос
```SQL
CREATE TABLE `books` (
`BookID` int(5) NOT NULL AUTO_INCREMENT,
`BookName` varchar(255) NOT NULL,
PRIMARY KEY (`BookID`)
);
```
Структура таблицы

| Field    | Type         | Null | Key | Default | Extra          |
|----------|--------------|------|-----|---------|----------------|
| BookID   | int(5)       | NO   | PRI | NULL    | auto_increment |
| BookName | varchar(255) | NO   |     | NULL    |                |

Таблица с данными

| BookID | BookName                         |
|--------|----------------------------------|
|      1 | Book about body and person       |
|      2 | Book about girl and people       |
|    ... | ...                              |
|     98 | Book about education and night   |
|     99 | Book about side and program      |

### Сводная таблица для реализации связи many-to-many
SQL-запрос
```SQL
CREATE TABLE `pivot_table` (
`AuthorID` int(5) NOT NULL,
`BookID` int(5) NOT NULL,
FOREIGN KEY (`AuthorID`) REFERENCES `authors` (`AuthorID`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`BookID`) REFERENCES `books` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY (`AuthorID`, `BookID`)
);
```
Структура таблицы

| Field    | Type   | Null | Key | Default | Extra |
|----------|--------|------|-----|---------|-------|
| AuthorID | int(5) | NO   | PRI | NULL    |       |
| BookID   | int(5) | NO   | PRI | NULL    |       |

Таблица с данными

| AuthorID | BookID |
|----------|--------|
|       12 |      1 |
|       34 |      1 |
|       18 |      2 |
|       50 |      2 |
|      ... |    ... |
|       34 |     99 |
|       79 |     99 |

## Запрос выводящий авторов, написавших менее 7 книг
SQL-запрос
```SQL
SELECT a.AuthorID, a.FirstName, a.LastName
FROM `pivot_table` as pt  
   LEFT JOIN `books` as b 
       ON b.BookID = pt.BookID  
   LEFT JOIN `authors` as a  
       ON (a.AuthorID = pt.AuthorID)  
GROUP BY a.AuthorID
HAVING count(*) <7
```
Ответ

| AuthorID | FirstName | LastName |
|----------|-----------|----------|
|        3 | Noah      | Robinson |
|        5 | Malthe    | Wood     |
|      ... | ...       | ...      |
|       98 | Emil      | Thompson |
|       99 | Carl      | Davies   |

## Запрос выводящий авторов, написавших менее 7 книг, и количество книг по возрастанию
SQL-запрос
```SQL
SELECT a.AuthorID, a.FirstName, a.LastName, count(*) as count  
FROM `pivot_table` as pt  
   LEFT JOIN `books` as b 
       ON b.BookID = pt.BookID  
   LEFT JOIN `authors` as a  
       ON (a.AuthorID = pt.AuthorID)  
GROUP BY a.AuthorID
HAVING count <7
ORDER BY count;
```
Ответ

| AuthorID | FirstName | LastName | count |
|----------|-----------|----------|-------|
|       16 | William   | Smith    |     2 |
|       23 | Noah      | Taylor   |     2 |
|       12 | Noah      | Brown    |     2 |
|      ... | ...       | ...      |   ... |
|       53 | Harry     | Wright   |     6 |
|       69 | Magnus    | Roberts  |     6 |
