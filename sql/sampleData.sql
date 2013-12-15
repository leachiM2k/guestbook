USE guestbook;
REPLACE INTO users (id, login, passwordHash, role, name, email) VALUES
    (1, 'admin', '', 'admin', 'Administrator', 'admin@example.com'),
    (2, 'hans', '', 'user', 'Hans Wurst', 'hans@example.com'),
    (3, 'john', '', 'user', 'John Doe', 'john@example.com');
REPLACE INTO entries (userId, text, date) VALUES
    (2, 'This is a brown fox test that I left here few days ago.', '2013-12-12 12:44:11'),
    (2, 'This is the second brown fox test.', '2013-12-12 15:44:11'),
    (3, 'I\'m writing this entry on a very strange date.', '2013-12-13 14:15:16');