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
INSERT INTO dict_types(id_dictio_type,type_name,type_description) VALUES (null,'User','Define user type');
INSERT INTO dict_types(id_dictio_type,type_name,type_description) VALUES (null,'Country','Define ountry name');
INSERT INTO dict_types(id_dictio_type,type_name,type_description) VALUES (null,'Workplace','Define workplace type');
INSERT INTO dict_types(id_dictio_type,type_name,type_description) VALUES (null,'Gender','Define gender');

#dict
INSERT INTO dict(id_dict,short_description,description,lang,id_dictio_type) VALUES (null, 'Admin',null,null,1);
INSERT INTO dict VALUES (null, 'Professor',null,null,1);
INSERT INTO dict VALUES (null, 'Student',null,null,1);
INSERT INTO dict VALUES (null, 'AL','Albania',null,2);
INSERT INTO dict VALUES (null, 'AR','Argentina',null,2);
INSERT INTO dict VALUES (null, 'AT','Austria',null,2);
INSERT INTO dict VALUES (null, 'BE','Belgium',null,2);
INSERT INTO dict VALUES (null, 'BA','Bosnia and Herzegovina',null,2);
INSERT INTO dict VALUES (null, 'BG','Bulgaria',null,2);
INSERT INTO dict VALUES (null, 'CA','Canada',null,2);
INSERT INTO dict VALUES (null, 'CN','China',null,2);
INSERT INTO dict VALUES (null, 'HR','Croatia',null,2);
INSERT INTO dict VALUES (null, 'CZ','Czech Republic',null,2);
INSERT INTO dict VALUES (null, 'DK','Denmark',null,2);
INSERT INTO dict VALUES (null, 'EG','Egypt',null,2);
INSERT INTO dict VALUES (null, 'EE','Estonia',null,2);
INSERT INTO dict VALUES (null, 'FI','Finland',null,2);
INSERT INTO dict VALUES (null, 'FR','France',null,2);
INSERT INTO dict VALUES (null, 'GE','Georgia',null,2);
INSERT INTO dict VALUES (null, 'DE','Germany',null,2);
INSERT INTO dict VALUES (null, 'GR','Greece',null,2);
INSERT INTO dict VALUES (null, 'HU','Hungary',null,2);
INSERT INTO dict VALUES (null, 'IN','India',null,2);
INSERT INTO dict VALUES (null, 'IE','Ireland',null,2);
INSERT INTO dict VALUES (null, 'IS','Israel',null,2);
INSERT INTO dict VALUES (null, 'IT','Italy',null,2);
INSERT INTO dict VALUES (null, 'JP','Japan',null,2);
INSERT INTO dict VALUES (null, 'KZ','Kazakhstan',null,2);
INSERT INTO dict VALUES (null, 'LV','Latvia',null,2);
INSERT INTO dict VALUES (null, 'LT','Lithuania',null,2);
INSERT INTO dict VALUES (null, 'MX','Mexico',null,2);
INSERT INTO dict VALUES (null, 'MC','Monaco',null,2);
INSERT INTO dict VALUES (null, 'NL','Netherlands',null,2);
INSERT INTO dict VALUES (null, 'NO','Norway',null,2);
INSERT INTO dict VALUES (null, 'PL','Poland',null,2);
INSERT INTO dict VALUES (null, 'PT','Portugal',null,2);
INSERT INTO dict VALUES (null, 'RU','Russian Federation',null,2);
INSERT INTO dict VALUES (null, 'SG','Singapore',null,2);
INSERT INTO dict VALUES (null, 'SK','Slovakia',null,2);
INSERT INTO dict VALUES (null, 'SI','Slovenia',null,2);
INSERT INTO dict VALUES (null, 'ZA','South Africa',null,2);
INSERT INTO dict VALUES (null, 'ES','Spain',null,2);
INSERT INTO dict VALUES (null, 'SE','Sweden',null,2);
INSERT INTO dict VALUES (null, 'CH','Switzerland',null,2);
INSERT INTO dict VALUES (null, 'UA','Ukraine',null,2);
INSERT INTO dict VALUES (null, 'GB','United Kingdom',null,2);
INSERT INTO dict VALUES (null, 'US','United States',null,2);
INSERT INTO dict VALUES (null, 'ZW','Zimbabwe',null,2);
INSERT INTO dict VALUES (null,'University',null,null,3);
INSERT INTO dict VALUES (null,'Institution',null,null,3);
INSERT INTO dict VALUES (null,'Male',null,null,4);
INSERT INTO dict VALUES (null,'Female',null,null,4);

#specialization
INSERT INTO specialization(id_specialization,spec_short_name,spec_name) VALUES (null,'TOR','Technik Organizacji Reklamy');
INSERT INTO specialization(id_specialization,spec_short_name,spec_name) VALUES (null,'TI','Technik Informatyk');
INSERT INTO specialization(id_specialization,spec_short_name,spec_name) VALUES (null,'TM','Technik Mechanik');
INSERT INTO specialization(id_specialization,spec_short_name,spec_name) VALUES (null,'TE','Technik Elektronik');
INSERT INTO specialization(id_specialization,spec_short_name,spec_name) VALUES (null,'TT','Technik Teleinformatyk');
INSERT INTO specialization(id_specialization,spec_short_name,spec_name) VALUES (null,'LW','Liceum Wojskowe');

#workplace
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Politechnika Rzeszowska',49,35);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Uniwersytet Rzeszowski',49,35);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Uniwersytet Jagielloński',49,35);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Uniwersytet Warszawski',49,35);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Wyższa Szkoła Prawa i Administracji',49,35);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Wyższa Szkoła Informatyki i Zarządzania',49,35);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Asseco Poland S.A.',50,35);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Netguru',50,35);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Deutsche Bank',50,35);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Technische Universität München',49,20);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Universita degil Studi di Roma a Sapienza',49,26);
INSERT INTO workplace(id_workplace,name,workplace_type,workplace_country) VALUES (null,'Zespół Szkół Technicznych w Rzeszowie',49,35);

#users
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university)  VALUES (null,'kasia@gmail.com',null,'Katarzyna','Mickiewicz',null,'2016-09-01','2020-04-25',null,3,52,35,null,6);
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university) VALUES (null,'magmagi@gmail.com',null,'Magdalena','Miaukiewicz','00290405326','2016-09-01','2020-04-25',null,3,52,35,null,2);
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university) VALUES (null,'janusz@poczta.pl',null,'Janusz','Pocztenski','454350123','1945-09-01',null,null,2,51,35,12,null);
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university) VALUES (null,'zgredzia@poczta.pl',null,'Zygfryd','Kostalewicz','00295906423','2015-09-01','2019-04-30',null,3,51,20,null,10);
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university) VALUES (null,'jozef@gmail.com',null,'Józef','Kowalski','00436572475','2015-09-01','2019-04-30',null,3,51,35,null,null);
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university) VALUES (null,'zygmunt@poczta.pl',null,'Zygmunt','Drzewicki','00643429271','2015-09-01','2019-04-30',null,3,51,35,8,null);
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university) VALUES (null,'marzena@poczta.pl',null,'Marzena','Nauczycielska','674350123','1996-09-01',null,null,2,52,35,12,null);
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university) VALUES (null,'pawlowicz@karina.com',null,'Karina','Pawlowicz','774350123','2000-09-01',null,null,2,52,35,12,null);
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university) VALUES (null,'oliwka@ol.pl',null,'Oliwia','Nieziemska','00297564520','2000-09-01','2019-04-30',null,3,52,35,null,1);
INSERT INTO users(id_user,user_email,user_pass,first_name,last_name,pesel,start_date,end_date,user_id_division,user_type_id,gender,country,id_company,id_university) VALUES (null,'ofsdfsdka@ol.pl',null,'Marlena','Brzegowska','00297545690','2000-09-01','2019-04-30',null,3,52,35,null,2);

#division
INSERT INTO division(id_division,id_professor,division_code,div_Start_date,div_end_date,div_id_specialization) VALUES (null,3,'A','2016-09-01','2020-04-25',1);
INSERT INTO division(id_division,id_professor,division_code,div_Start_date,div_end_date,div_id_specialization) VALUES (null,7,'B','2015-09-01','2019-04-30',2);

#przypisanie uczniów do klasy
UPDATE users SET user_id_division=1 WHERE id_user IN (1,2);
UPDATE users SET user_id_division=2 WHERE id_user IN (4,5,6);