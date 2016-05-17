CREATE TABLE role (
     id int primary key,
     name varchar(15) NOT NULL
);

INSERT INTO role VALUES
(1, "superadmin"),
(2, "admin"),
(3, "editor"),
(4, "users");

CREATE TABLE users (
     id int primary key auto_increment,
     username varchar(20) UNIQUE NOT NULL,
     fullname varchar(100) NOT NULL,
     email varchar(100) UNIQUE NOT NULL,
     pass varchar(64) NOT NULL,
     role int NOT NULL DEFAULT 4,
     activation_key varchar(64) UNIQUE,
     forgot_key varchar(64) UNIQUE,
     registered_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
     constraint foreign key (role) references role(id)
);
CREATE TABLE category (
     id int primary key auto_increment,
     name varchar(100),
     slug varchar(30),
     parent_id int default 0
);

CREATE TABLE post (
     id int primary key auto_increment,
     user_id int,
     time_created datetime DEFAULT CURRENT_TIMESTAMP ,
     time_modified timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
     title varchar(100),
     content text,
     pass varchar(50),
     slug varchar(30) UNIQUE,
     comment_status tinyint,
     post_status tinyint,
     constraint foreign key (user_id) references users(id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE post_category (
     id int primary key auto_increment,
     post_id int,
     category_id int,
     constraint foreign key (post_id) references post(id) ON DELETE CASCADE ON UPDATE CASCADE,
     constraint foreign key (category_id) references category(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE page (
     id int primary key auto_increment,
     user_id int,
     time_created datetime DEFAULT CURRENT_TIMESTAMP ,
     time_modified timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
     title varchar(100),
     content text,
     slug varchar(30) ,
     page_order int,
     post_status bit,
     constraint foreign key (user_id) references users(id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE comments (
     id int primary key auto_increment,
     user_id int,
     post_id int,
     content text,
     comment_date timestamp DEFAULT CURRENT_TIMESTAMP,
     status bit,
     constraint foreign key (user_id) references users(id) ON DELETE SET NULL ON UPDATE CASCADE,
     constraint foreign key (post_id) references post(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE events (
  id int primary key auto_increment,
  title varchar(256) not null,
  description text,
  place_name text,
  scheduled_time datetime,
  finished_time datetime
);
