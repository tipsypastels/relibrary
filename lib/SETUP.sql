CREATE TABLE `relibrary`.`books` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) NOT NULL , 
  `description` VARCHAR(255) NOT NULL , 
  `total_amount` INT NOT NULL DEFAULT '0' , 
  `published` DATE NOT NULL , 
  `author_id` INT NOT NULL , 
  `publisher_id` INT NOT NULL , 
  `series_id` INT, 

  PRIMARY KEY (`id`), 
  INDEX `author_id` (`author_id`), 
  INDEX `publisher_id` (`publisher_id`), 
  INDEX `series_id` (`series_id`), 
  UNIQUE `description` (`description`), 
  UNIQUE `name` (`name`)
) ENGINE = InnoDB;

CREATE TABLE `relibrary`.`authors` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) NOT NULL , 
  `biography` VARCHAR(255) NOT NULL , 
  `picture` VARCHAR(255) NOT NULL , 

  PRIMARY KEY (`id`), 
  UNIQUE `name` (`name`)
) ENGINE = InnoDB;

CREATE TABLE `relibrary`.`customers` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` TEXT NOT NULL , 
  `email` TEXT NOT NULL , 
  `phone` VARCHAR(10) NOT NULL , 
  `address` TEXT NOT NULL , 
  `date_joined` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  `password` TEXT NOT NULL , 

  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `relibrary`.`book_rentals` (
  `customer_id` INT NOT NULL , 
  `book_id` INT NOT NULL , 
  `checked_out` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  `return_due` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

CREATE TABLE `relibrary`.`publishers` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(255) NOT NULL , 
  `picture` VARCHAR(255) NOT NULL , 
  `website` VARCHAR(255) NOT NULL , 

  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `relibrary`.`book_ratings` ( 
  `book_id` INT NOT NULL , 
  `customer_id` INT NOT NULL , 
  `score` INT NOT NULL 
) ENGINE = InnoDB;

CREATE TABLE `relibrary`.`series` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,

  PRIMARY KEY(`id`) 
) ENGINE = InnoDB;

INSERT INTO books VALUES (1, 'Do Androids Dream of Electric Sheep?','It was January 2021, and Rick Deckard had a license to kill
Somewhere among the hordes of humans out there, lurked several rogue androids. Deckards assignment find them ..."retire" them. Trouble was, the androids all looked exactly humans, they didnt want to be found!',10,'01-06-1996',1,1,1);

INSERT INTO books VALUES (2,'I Was Told Thered Be Cake','From despoiling an exhibit at the Natural History Museum to provoking the ire of her first boss to siccing the cops on her mysterious neighbor, Crosley can do no right despite the best of intentions ',2,'01-04-2008',2,2, NULL);

INSERT INTO books VALUES (3,'The Edge of Human','K.W. Jeter picks up the tale of Rick Deckard, the `blade runner created by Phillip K. Dick and popularized by Ridley Scotts cult classic film. ',5,'10-10-2000',3,3,1);

INSERT INTO books VALUES (4,'Something Wicked This Way Comes','A carnival rolls in sometime after the midnight hour on a chill Midwestern October eve, ushering in Halloween a week before its time.',3,'01-03-1998',4,4, NULL);

INSERT INTO books VALUES (5,'To Kill a Mockingbird','The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it, To Kill A Mockingbird became both an instant bestseller and a critical success when it was first published in 1960',8,'23-05-2006',5,5, NULL);

INSERT INTO books VALUES (6,'The Man in the High Castle','Its America in 1962. Slavery is legal once again. The few Jews who still survive hide under assumed names. In San Francisco, the I Ching is as common as the Yellow Pages.',2,'30-06-1992',1,6, NULL);

INSERT INTO books VALUES (7,'Valis','VALIS is the first book in Philip K. Dicks incomparable final trio of novels (the others being The Divine Invasion and The Transmigration of Timothy Archer).',7,'03-07-2004',1,6, NULL);

INSERT INTO books VALUES (8,'Neverwhere','Under the streets of London theres a place most people could never even dream of. A city of monsters and saints, murderers and angels, knights in armour and pale girls in black velvet. ',6,'02-09-2003',6,5, NULL);

INSERT INTO books VALUES (9,'How the Marquis Got His Coat Back','A Neverwhere short story from one of the brightest, most brilliant writers of our generation - the Sunday Times and New York Times bestselling author of the award-winning The Ocean At the End of the Lane. ',2,'27-10-2015',6,7, NULL);

INSERT INTO books VALUES (10,'Rogues','by George R.R. Martin (Editor/Contributor), Gardner Dozois (Editor), Joe Abercrombie (Contributor), Gillian Flynn',8,'17-06-2017', 1,8, NULL);

INSERT INTO authors VALUES (1,'Philip K. Dick','Philip K. Dick was born in Chicago in 1928 and lived most of his life in California. In 1952. he began writing professionally and proceeded to write numerous novels and short-story collections','https://images.gr-assets.com/authors/1264613853p8/4764.jpg');

INSERT INTO authors VALUES (2,'Sloane Crosley','Sloane Crosley is the author of the New York Times bestsellers I Was Told Thered Be Cake (a Thurber Prize finalist) and How Did You Get This Number. The Clasp is her first novel. A frequent contributor to The New York Times, she lives in Manhattan.','https://images.gr-assets.com/authors/1442330018p8/994873.jpg');

INSERT INTO authors VALUES (3,' K.W. Jeter','Kevin Wayne Jeter (born 1950) is an American science fiction and horror author known for his literary writing style, dark themes, and paranoid, unsympathetic characters. ','https://images.gr-assets.com/authors/1363305061p8/1003655.jpg');

INSERT INTO authors VALUES (4,'Ray Bradbury','Ray Douglas Bradbury, American novelist, short story writer, essayist, playwright, screenwriter and poet, was born August 22, 1920 in Waukegan, Illinois. He graduated from a Los Angeles high school in 1938.','https://images.gr-assets.com/authors/1445955959p8/1630.jpg');

INSERT INTO authors VALUES (5,'Harper Lee','Harper Lee, known as Nelle, was born in the Alabama town of Monroeville, the youngest of four children of Amasa Coleman Lee and Frances Cunningham Finch Lee.','https://images.gr-assets.com/authors/1188820730p8/1825.jpg');

INSERT INTO authors VALUES (6,'Neil Gaiman','I was in LA two weeks ago, to record the person who is playing the actual Voice of God in Good Omens. I had hoped for a long enough trip to see old friends and catch up with the world, but the trip was immediately truncated, as I was needed in Toronto where they having press days for the next season of American Gods.','https://images.gr-assets.com/authors/1234150163p8/1221698.jpg');

INSERT INTO series VALUES (1,
'Blade Runner',
'The official and authorized novels were written by Philip K. Dicks friend, K.W. Jeter. They pursue the story Rick Deckard attempt resolve many the differences the novel the film but the books a novelization the movie. The book Blade Runner identical Androids Dream Electric Sheep? added movie photos etc');

INSERT INTO publishers VALUES (1,'Ballantine Books','https://www.google.ca/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwjcwcqm_MDeAhUfIDQIHRNyDlkQjRx6BAgBEAU&url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2FBallantine_Books&psig=AOvVaw0zSKy5ZjRQ7Pb_wdKMs7pe&ust=1541635063022904','www.Ballantinebooks.com');

INSERT INTO publishers VALUES (2,'Riverhead Books','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRowhEzGkZj4aQCqpFJvcEEoolKr2uq-VD0MtQ090RYLRke5z6','www.Riverheadbooks.com');

INSERT INTO publishers VALUES (3,'Spectra','https://vignette.wikia.nocookie.net/starwars/images/9/9f/BantamSpectra.png/revision/latest?cb=20061121124259','www.spectra.com');

INSERT INTO publishers VALUES (4,'Avon','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQki22RLc7MVOQhbEe5mp3znvqaQIGpJCnhOidfM_71OzaBnWZn','www.avon.com');

INSERT INTO publishers VALUES (5,'Harper Perennial Modern Classics ','https://d1xcdyhu7q1ws8.cloudfront.net/wp-content/uploads/2018/05/08103139/hc-logo.png','https://www.harpercollins.com/9780007205004/the-lover-harper-perennial-modern-classics/');

INSERT INTO publishers VALUES (6,'Vintage ','http://knopfdoubleday.com/wp-content/uploads/2012/10/vintage-logo.png','http://www.vintage-books.com/');

INSERT INTO publishers VALUES (7,'Headline','https://www.thebookseller.com/sites/default/files/2016/07/04/Headline_newlogo%5B1%5D.jpg','https://www.headline.co.uk/');

INSERT INTO publishers VALUES (8,' Bantam Books','https://upload.wikimedia.org/wikipedia/en/thumb/e/e2/Bantam_Logo.png/100px-Bantam_Logo.png','http://www.randomhousebooks.com/');
