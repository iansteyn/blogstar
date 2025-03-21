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
('sammie', 'sammie@example.com', 'knitlover123', 'Sammie is a creative soul with an unshakable love for knitting cozy sweaters, scarves, and blankets. Her hands are always busy creating something warm and comforting for friends and family. When not crafting, Sammie enjoys spending time outdoors, hiking through forests, and soaking up the sunshine. She has a deep connection with nature and a soft spot for animals, especially cats. Sammie dreams of one day opening a small yarn shop in a quiet town, where she can share her passion with others and offer a peaceful retreat for fellow yarn enthusiasts.'),
('chris', 'chris@example.com', 'climbrocks456', 'Chris is an adventurous British rock climber who thrives on scaling cliffs, boulders, and exploring some of the most challenging climbing spots around the world. His love for adventure has taken him to incredible places, from rugged mountains to serene coastlines, always seeking that perfect climb. When not scaling new heights, Chris enjoys spending time with Sammie, sharing stories from their travels, and planning their next big adventure. He’s also known for his hidden talent in the kitchen, especially when it comes to baking the perfect scones—just ask Sammie!'),
('Spooky', 'spooky@example.com', 'meowmeow789', 'Spooky is an adorable yet quirky cat who has a very peculiar love for food. She’s not a fan of loud noises, so you can often find her hiding under the bed when there’s a thunderstorm or the vacuum comes out. Despite her timid nature, Spooky is always on the lookout for a tasty snack, and she’ll do just about anything to get her paws on a plate of tuna or a piece of chicken. Her favorite pastime, aside from eating, is playing with her favorite toy mouse, which she carries around proudly.'),
('Salem', 'salem@example.com', 'purrfect101', 'Salem is a mischievous, fearless cat who thinks he’s the boss of the house. Known for his bold personality, Salem often surprises Sammie and Chris with his antics, like when he once defended Sammie from a tickling attack by biting Chris’s feet. Salem has a strong bond with Sammie and will do anything to protect her from any perceived threats—even if that threat is just Chris trying to have a little fun. He loves exploring every nook and cranny of the house and has a particular fondness for chasing shadows.'),
('Joy', 'joy@example.com', 'farmgirl789', 'Joy is a soon-to-be graduate and a self-proclaimed homebody, but she’s been pushing herself to try new activities and step out of her comfort zone. She’s married to her high school sweetheart and has a tuxedo cat who keeps her company when she’s at home. In the summer, Joy works on a farm, where she gets her hands dirty helping with crops and animals. While Joy prefers the quieter moments of life, she’s excited about the future and is learning to embrace new experiences. She’s also studying computer science and can’t wait to see where it takes her.'),
('Ian', 'ian@example.com', 'outdooradventure123', 'Ian is a dedicated computer science student with a deep love for the outdoors. He manages his time well, balancing his academic life with his passion for outdoor activities, from hiking and camping to rock climbing. Originally from South Africa, Ian embraces his Christian faith and values the sense of community it brings. His ability to stay organized and focused allows him to excel both academically and in his personal life. When he’s not coding or studying, you’ll find him exploring new places and seeking his next adventure.');

INSERT INTO posts (username, post_title, post_body, post_image)
VALUES 
('joy', 'Farm Life Adventures', 'Spent another amazing day on the farm today! The animals were all super active, and I even helped with feeding the chickens. It’s hard work, but it’s also so rewarding. I’m learning a lot every day, and I think I’m becoming more confident in my ability to help out. The quiet moments on the farm are the best, especially when the sun is setting. 🌅', 'farm_sunset.jpg'),
('ian', 'Weekend Hiking Trip', 'Had a great weekend hiking trip to a new trail I found last month. It was a bit challenging, but the views were absolutely worth it. I’ve always believed that a good hike is the perfect way to clear your mind, and it’s also great cardio for those long coding sessions. 😊', 'hiking_trail.jpg'),
('sammie', 'Cozy Blankets for Chilly Days', 'I’m currently working on knitting a new blanket to keep me warm this winter. There’s nothing like wrapping yourself in something you made yourself. I can’t wait to finish it and start using it. Anyone have any suggestions for color combinations? I’m thinking of something with blues and purples to mimic the sky at sunset. 🌅', 'blanket_image.jpg'),
('chris', 'Rock Climbing in the Rain', 'The weather was a little crazy this weekend, but I decided to go rock climbing in the rain anyway. It made the climb a bit more challenging, but it was definitely worth it for the rush of adrenaline. Sometimes, you just have to embrace the elements and make the best of it. Who’s with me for the next rainy climb? 🌧️', 'rain_climb.jpg'),
('spooky', 'Napping in the Sun', 'It’s been one of those days where all I want to do is nap in the sun. 😻 Sammie was working on her knitting project, so I took advantage of the nice weather and found the coziest spot by the window. The sun feels so good on my fur, and I think I deserve a long nap after the tuna feast yesterday. 💤', 'sun_nap.jpg'),
('salem', 'Playtime with the Yarn', 'Today, I found Sammie’s yarn stash and decided to make it my own personal playground. Who knew yarn could be so much fun to bat around? I even managed to knock a few things off the counter while I was at it. It’s all about creating chaos and having fun. 😼', 'salem_yarn.jpg');

INSERT INTO comments (username, post_id, comment_body)
VALUES 
('ian', 1, 'The farm life looks so peaceful, Joy! I bet it’s a nice break from the usual hustle and bustle. Keep up the great work!'),
('joy', 1, 'It’s so rewarding, Ian! Even though it’s hard work, it’s worth it. I’m so glad to be learning new things every day.'),
('sammie', 1, 'I love farm sunsets! There’s something magical about those quiet moments. Keep sharing your farm adventures, Joy!'),
('chris', 1, 'Sounds like a dream, Joy! A farm is the perfect place to recharge. I hope one day I get to visit!'),
('ian', 2, 'That trail sounds awesome, Ian! You’re inspiring me to get out and hike more. We should do a climb together sometime soon!'),
('joy', 2, 'I love hiking but haven’t been able to do it much lately. Your photos make me want to hit the trails again!'),
('chris', 2, 'Wow, that sounds like an amazing hike, Ian! I definitely need to get outside more. Thanks for sharing your adventure!'),
('sammie', 2, 'Your hiking adventures always inspire me to get out of my comfort zone! It looks so beautiful out there. ❤️'),
('joy', 3, 'Your blankets always look so cozy, Sammie! I love the idea of using blues and purples. It sounds like the perfect color combo for winter.'),
('ian', 3, 'The blanket sounds so comfy, Sammie! I’d love to have one to snuggle up with after a long hike. Let me know when it’s done!'),
('salem', 3, 'I could use a blanket like that for my naps. But maybe I’ll stick to my favorite spot on the couch for now. 😼'),
('chris', 3, 'Can’t wait to see the finished blanket, Sammie! I love the colors you picked out. They’re going to look great!'),
('sammie', 4, 'Climbing in the rain sounds so intense, Chris! I admire your dedication. It’s not easy, but I know you love the challenge! Stay safe out there.'),
('joy', 4, 'You’re brave for climbing in the rain, Chris! I’ll stick to indoor activities for now, haha. But I admire your adventurous spirit!'),
('ian', 4, 'You’re a true adventurer, Chris! I love that you embrace the elements. That’s the kind of attitude that makes the best climbers.'),
('salem', 4, 'Climbing in the rain sounds a bit too wet for me. I prefer my dry, warm naps. 😹'),
('joy', 5, 'You look so peaceful in the sun, Spooky! I wish I could join you for a nap, but I’ve got too much to do. Enjoy your well-deserved rest!'),
('sammie', 5, 'I always love seeing you relax, Spooky! You deserve the best naps, and the sun is the perfect spot. Enjoy!'),
('chris', 5, 'That sounds like the perfect day, Spooky. I might have to join you for a nap sometime. 😸'),
('ian', 5, 'I think you’ve mastered the art of napping, Spooky. Maybe you could teach me how to do that!'),
('sammie', 6, 'I can’t stop laughing at how much fun you had with the yarn, Salem! You’ve got such a playful side. 😻'),
('joy', 6, 'You’re quite the troublemaker, Salem! But at least you had fun with it. 😄'),
('chris', 6, 'Haha, Salem, you’re a little chaos machine! But I’m glad you’re having fun with the yarn. Keep causing trouble!'),
('ian', 6, 'Sounds like you had a blast, Salem! You’re really getting into the spirit of things. Maybe I need to take some notes from you on how to have fun!');