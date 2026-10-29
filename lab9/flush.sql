-- Очистка данных (но не структуры) в правильном порядке: сначала
-- дочерняя таблица address, потом родительская street
DELETE FROM `address`;
DELETE FROM `street`;
