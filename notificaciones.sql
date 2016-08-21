CREATE TABLE _notifications(
	id int(11) not null primary key auto_increment,
	email varchar(255) not null,
	origin varchar(50),
	inserted_date timestamp not null default CURRENT_TIMESTAMP,
	text varchar(255) not null,
	viewed bit(1) not null default 0,
	viewed_date timestamp not null,
	link varchar(255),
	tag enum('URGENT','IMPORTANT','WARNING','INFO')
);