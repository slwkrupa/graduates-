DROP DATABASE graduates;
CREATE DATABASE graduates;
USE graduates;

CREATE TABLE dict_types( 
	id_dictio_type INT UNSIGNED NOT NULL AUTO_INCREMENT,
	type_name VARCHAR(255) NOT NULL, 
	type_description VARCHAR(500) NULL,
	PRIMARY KEY (id_dictio_type)
	)
Engine=InnoDB DEFAULT charset=utf8;


CREATE TABLE dict(
	id_dict INT UNSIGNED NOT NULL AUTO_INCREMENT,
	short_description VARCHAR(255) NULL, 
	description VARCHAR(1000) NULL, 
	lang VARCHAR(20) NULL, 
	PRIMARY KEY (id_dict),
    id_dictio_type INT UNSIGNED NOT NULL, 
		CONSTRAINT dict_id_diction_FK
        FOREIGN KEY (id_dictio_type)
		REFERENCES dict_types(id_dictio_type) 
	)
Engine=InnoDB DEFAULT charset=utf8;	
	
CREATE TABLE specialization(
	id_specialization INT UNSIGNED NOT NULL AUTO_INCREMENT,
	spec_short_name VARCHAR(100) NOT NULL,
	spec_name VARCHAR(255) NULL, 
	PRIMARY KEY (id_specialization)
)
Engine=InnoDB DEFAULT charset=utf8;

CREATE TABLE WORKPLACE(
	id_workplace INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL, 
	PRIMARY KEY (id_workplace),
    workplace_type INT UNSIGNED NOT NULL,
		CONSTRAINT FK_work_type 
        FOREIGN KEY (workplace_type)
		REFERENCES dict(id_dict), 
     workplace_country INT UNSIGNED NOT NULL,   
		CONSTRAINT FK_country 
        FOREIGN KEY (workplace_country)
		REFERENCES dict(id_dict)
	)
Engine=InnoDB DEFAULT charset=utf8;

CREATE TABLE  users (
	id_user INT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_email VARCHAR(255) NULL,
	user_pass CHAR(60) NULL, 
	first_name VARCHAR(50) NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	pesel VARCHAR(20) NULL, 
	start_date DATE NOT NULL, 
	end_date DATE NULL,
	user_id_division INT UNSIGNED NULL,
	PRIMARY KEY (id_user),
     
    user_type_id INT UNSIGNED NOT NULL, 
		CONSTRAINT users_type_id_fk
        FOREIGN KEY (user_type_id)
		REFERENCES dict(id_dict),
	gender INT UNSIGNED NOT NULL,
		CONSTRAINT users_gender_fk
        FOREIGN KEY (gender)
		REFERENCES dict(id_dict), 
	country INT UNSIGNED NOT NULL, 
		CONSTRAINT users_country_fk 
        FOREIGN KEY (country)
		REFERENCES dict(id_dict),
	id_company INT UNSIGNED NULL,   
		CONSTRAINT useres_company_fk
        FOREIGN KEY (id_company)
		REFERENCES WORKPLACE(id_workplace),
	id_university INT UNSIGNED NULL,   
		CONSTRAINT users_univ_fk
        FOREIGN KEY (id_university)
		REFERENCES WORKPLACE(id_workplace)
) 
Engine=InnoDB DEFAULT charset=utf8;

CREATE TABLE division(
	id_division INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_professor INT UNSIGNED NOT NULL,
	division_code VARCHAR(20) NULL, 
	div_start_date DATE NOT NULL,
	div_end_date DATE NULL,
	PRIMARY KEY (id_division),
    div_id_specialization INT UNSIGNED NULL,
		CONSTRAINT FK_spec 
        FOREIGN KEY (div_id_specialization)
		REFERENCES specialization(id_specialization) 
	)
Engine=InnoDB DEFAULT charset=utf8;


ALTER TABLE users
ADD CONSTRAINT FK_userDivision
FOREIGN KEY (user_id_division) REFERENCES division(id_division);

####################
########Initial data
####################

#dict_types
INSERT INTO dict_types VALUES (null,'User','Define user type');
INSERT INTO dict_types VALUES (null,'Country','Define ountry name');
INSERT INTO dict_types VALUES (null,'Workplace','Define workplace type');
INSERT INTO dict_types VALUES (null,'Gender','Define gender');

#dict
INSERT INTO dict VALUES (null, 'Admin',null,null,1);
INSERT INTO dict VALUES (null, 'Professor',null,null,1);
INSERT INTO dict VALUES (null, 'Student',null,null,1);
INSERT INTO dict VALUES (null, 'PL','Poland',null,2);
INSERT INTO dict VALUES (null, 'DE','Germany',null,2);
INSERT INTO dict VALUES (null, 'US', 'United States',null,2);
INSERT INTO dict VALUES (null, 'RU','Russian Federation',null,2);
INSERT INTO dict VALUES (null, 'SG','Singapore',null,2);
INSERT INTO dict VALUES (null, 'ZA','South Africa',null,2);
INSERT INTO dict VALUES (null, 'ES','Spain',null,2);
INSERT INTO dict VALUES (null, 'CH','Switzerland',null,2);
INSERT INTO dict VALUES (null, 'UA','Ukraine',null,2);
INSERT INTO dict VALUES (null, 'GB','United Kingdom',null,2);
INSERT INTO dict VALUES (null, 'ZW','Zimbabwe',null,2);
INSERT INTO dict VALUES (null,'University',null,null,3);
INSERT INTO dict VALUES (null,'Institution',null,null,3);
INSERT INTO dict VALUES (null,'Male',null,null,4);
INSERT INTO dict VALUES (null,'Female',null,null,4);

#specialization
INSERT INTO specialization VALUES (null,'TOR','Technik Organizacji Reklamy');
INSERT INTO specialization VALUES (null,'TI','Technik Informatyk');
INSERT INTO specialization VALUES (null,'TM','Technik Mechanik');
INSERT INTO specialization VALUES (null,'TE','Technik Elektronik');
INSERT INTO specialization VALUES (null,'TT','Technik Teleinformatyk');
INSERT INTO specialization VALUES (null,'LW','Liceum Wojskowe');

#workplace
INSERT INTO workplace VALUES (null,'Politechnika Rzeszowska',42,4);
INSERT INTO workplace VALUES (null,'Uniwersytet Rzeszowski',42,4);
INSERT INTO workplace VALUES (null,'Asseco Poland S.A.',43,4);
INSERT INTO workplace VALUES (null,'Netguru',43,4);
INSERT INTO workplace VALUES (null,'Deutsche Bank',43,4);
INSERT INTO workplace VALUES (null,'Technische Universität München',42,5);

#users
INSERT INTO users VALUES (null,'kasia@gmail.com',null,'Katarzyna','Mickiewicz',null,'2016-09-01','2020-04-25',null,3,45,4,null,6);
INSERT INTO users VALUES (null,'magmagi@gmail.com',null,'Magdalena','Miaukiewicz','00290405326','2016-09-01','2020-04-25',null,3,45,4,null,2);
INSERT INTO users VALUES (null,'janusz@poczta.pl',null,'Janusz','Pocztenski','454350123','1945-09-01',null,null,2,44,4,7,null);
INSERT INTO users VALUES (null,'zgredzia@poczta.pl',null,'Zygfryd','Kostalewicz','00295906423','2014-09-01','2019-04-30',null,3,44,4,5,1);

#division
INSERT INTO division VALUES (null,2,'A','2016-09-01','2020-04-25',1);

#przypisanie uczniów do klasy
UPDATE users SET user_id_division=1 WHERE id_user in (1,4);
