CREATE DATABASE IF NOT EXISTS our_site;
USE our_site;

CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(50) PRIMARY KEY,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255),
    user_bio TEXT,
    date_registered DATETIME DEFAULT CURRENT_TIMESTAMP,
    role ENUM('registered', 'admin') DEFAULT 'registered'
);

CREATE TABLE IF NOT EXISTS posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    post_title VARCHAR(150) NOT NULL,
    post_body TEXT,
    post_image VARCHAR(255),
    post_date DATETIME DEFAULT (CURRENT_DATE),
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    post_id INT NOT NULL,
    comment_body TEXT,
    comment_date DATETIME DEFAULT (CURRENT_DATE),
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS likes (
    username VARCHAR(50) NOT NULL,
    post_id INT NOT NULL,
    PRIMARY KEY (username, post_id),
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS saves (
    username VARCHAR(50) NOT NULL,
    post_id INT NOT NULL,
    PRIMARY KEY (username, post_id),
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE
);

INSERT INTO users (username, email, password, user_bio)
VALUES 
('sammie', 'sammie@example.com', 'knitlover123', 'Sammie is a creative soul who loves knitting cozy sweaters and scarves. When not crafting, Sammie enjoys spending time outdoors, hiking through forests, and soaking up the sunshine. Sammie has a soft spot for animals, especially cats, and dreams of one day opening a small yarn shop in a quiet town.'),
('chris', 'chris@example.com', 'climbrocks456', 'Chris is a passionate British rock climber who thrives on scaling cliffs and boulders. With a love for adventure, Chris has traveled to some of the most stunning climbing spots around the world. When not climbing, Chris enjoys spending time with Sammie, sharing stories of their adventures, and planning their next big trip. Chris also has a secret talent for baking the perfect scones.'),
('Spooky', 'spooky@example.com', 'meowmeow789', 'Spooky is an oddball scaredy-cat who loves parading around with her favorite toy. Despite her timid nature, Spooky is obsessed with food and would choose a tasty treat over anything else in the world—even over Chris and Sammie. She often hides under the bed during thunderstorms but emerges triumphantly when she hears the sound of a food bag opening.'),
('Salem', 'salem@example.com', 'purrfect101', 'Salem is a mischievous and fearless cat who adores Sammie above all else. Known for his bold personality, Salem once defended Sammie when Chris tickled her by biting Chris’s feet. He fears nothing and is always ready to protect his favorite human. Salem enjoys exploring the house, causing playful trouble, and keeping a watchful eye on Sammie.');

INSERT INTO posts (username, post_title, post_body, post_image)
VALUES 
('sammie', 'My Latest Knitting Project', 'Just finished this cozy scarf! It’s perfect for the chilly weather. What do you think?', 'scarf_image.jpg'),
('chris', 'Conquered the Peak!', 'Finally made it to the top of this insane cliff. The view was worth every second of the climb!', 'cliff_view.jpg'),
('Spooky', 'The Best Day Ever!', 'Sammie gave me a whole plate of tuna today. I’m in heaven! 🐟', 'tuna_plate.jpg'),
('Salem', 'Guard Cat on Duty', 'Protected Sammie from Chris’s tickles again. Someone has to keep this household in order. 😼', 'salem_guard.jpg');

INSERT INTO comments (username, post_id, comment_body)
VALUES 
('chris', 1, 'Looks amazing, Sammie! Can you knit me a climbing beanie next?'),
('Spooky', 1, 'I tried to play with the yarn, but Sammie said no. 😿'),
('Salem', 1, 'Nice work, but I still prefer the yarn ball you made for me.'),
('sammie', 2, 'That view is breathtaking! Be careful up there, though. ❤️'),
('Spooky', 2, 'Why would anyone climb rocks when there’s food down here?'),
('Salem', 2, 'Impressive, but I could climb that in my sleep. 😎'),
('sammie', 3, 'You deserve it, Spooky! You’ve been such a good kitty.'),
('chris', 3, 'I see where I rank in this household… behind tuna. 😂'),
('Salem', 3, 'I let you have the tuna this time, but next time it’s mine.'),
('sammie', 4, 'Thank you for protecting me, Salem! You’re the best. ❤️'),
('chris', 4, 'I was just having fun! No need to bite my feet, Salem. 😅'),
('Spooky', 4, 'I’d help, but I’m busy napping. Good job, though!');