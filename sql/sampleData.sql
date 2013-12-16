USE guestbook;
REPLACE INTO users (id, login, passwordHash, role, name, email) VALUES
    (1, 'admin', '$2y$10$qZ9Rc6xXWFumvxMG1HcuDe68PZEXj843nuazzLw0AmfAEdnLA0uDi', 'admin', 'Administrator', 'admin@example.com'),
    (2, 'hans', '$2y$10$qRDKCuG1Pkz//ulegfKBt.n5KXdeBJ/nPC6JJFlS4m4/fq1F5czdy', 'user', 'Hans Wurst', 'hans@example.com'),
    (3, 'john', '$2y$10$9V48ljDcXhWwLzHUmcO/tO.3Roa70wD5ctdQsgWGoM.xQ4U9OAOva', 'user', 'John Doe', 'john@example.com');
REPLACE INTO entries (userId, text, state, date) VALUES
    (2, 'This is a brown fox test that I left here few days ago.', 'active', '2013-12-12 12:44:11'),
    (2, 'This is the second brown fox test.', 'active',  '2013-12-12 15:44:11'),
    (3, 'I\'m writing this entry on a very strange date.', 'inactive', '2013-12-13 14:15:16');