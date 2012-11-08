create table users
(
id int primary key,
name varchar(64) not null default '',
pwd char(32) not null default '',
email varchar(128) not null default '',
tel varchar(32) not null default '',
grade tinyint unsigned not null default 1
);

insert into users values(100, 'shunping', md5('shunping'), 'shunping@abc.com', '07-37648783', 1);
insert into users values(101, 'xiaohong', md5('xiaohong'), 'xiaohong@abc.com', '07-52154655', 1);

create table book
(
id int primary key auto_increment,
name varchar(64) not null default '',
author varchar(64) not null default '',
publishHouse varchar(128) not null default '',
price float not null default 0,
nums int not null default 10
);

insert into book(name, author, publishHouse, price, nums) values('php developing', 'John Herd', 'Canada development', 58, 100);
insert into book(name, author, publishHouse, price, nums) values('java developing', 'Kent Dab', 'New Zealand development', 34, 100);
insert into book(name, author, publishHouse, price, nums) values('.net developing', 'Bruce xiaohong', 'USA development', 345, 100);
insert into book(name, author, publishHouse, price, nums) values('Android developing', 'Keyt Not', 'Australian development', 32, 100);
insert into book(name, author, publishHouse, price, nums) values('object-c developing', 'Ray Jan', 'Nopte development', 562, 100);
insert into book(name, author, publishHouse, price, nums) values('c# developing', 'Mond Fec', 'Create development', 58, 347);
insert into book(name, author, publishHouse, price, nums) values('e-commerce developing', 'KKe DDe', 'Ative development', 34, 1040);
insert into book(name, author, publishHouse, price, nums) values('oracle developing', 'Goegoe Oreal', 'Zend development', 23, 1030);
insert into book(name, author, publishHouse, price, nums) values('prototype developing', 'Have Myc', 'Frame development', 45, 1005);
insert into book(name, author, publishHouse, price, nums) values('javascript developing', 'None Keyad', 'Word development', 33, 1040);

create table mycart(
id int unsigned primary key auto_increment,
userid int,
bookid int,
nums int unsigned,
cartdate int unsigned,
foreign key (userid) references users(id),
foreign key (bookid) references book(id)
);

create table orders
(
id int primary key auto_increment,
userid int not null,
totalprice float not null,
orderdate int unsigned not null,
foreign key(userid) references users(id)
);

create table ordersitem(
id int primary key auto_increment,
ordersid int,
bookid int,
booknum int default 0 not null,
foreign key(ordersid) references orders(id),
foreign key(bookid) references book(id)
);