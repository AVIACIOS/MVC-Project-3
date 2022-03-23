CREATE TABLE `users`(
                        `id` INT AUTO_INCREMENT PRIMARY KEY,
                        `name` VARCHAR(128),
                        `login` VARCHAR(128) UNIQUE,
                        `password` VARCHAR(128),
                        `role` VARCHAR(24) DEFAULT 'user'
);

CREATE TABLE `posts` (
                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                         `user_id` INT,
                         `name` VARCHAR(128),
                         `descriptions` TEXT,
                         `keywords` VARCHAR(512),
                         `created_at` DATETIME,
                         FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `comments` (
                            `id` INT AUTO_INCREMENT PRIMARY KEY,
                            `post_id` INT,
                            `user_id` INT,
                            `comment` VARCHAR(1024),
                            FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`),
                            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);