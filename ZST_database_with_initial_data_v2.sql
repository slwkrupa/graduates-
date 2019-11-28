-- tabela przechowująca typy słownikowe
CREATE TABLE dict_types( 
	id_dictio_type INT UNSIGNED NOT NULL AUTO_INCREMENT, -- id
	type_name VARCHAR(255) NOT NULL, -- krótka nazwa typu, można będzie wyświetlać np. w aplikacji, w oknie dodawania nowego typu
	type_description VARCHAR(500) NULL,	-- długi opis, nie jest wymagany
	PRIMARY KEY (id_dict_type)
	)
Engine=InnoDB DEFAULT charset=utf8;

-- tabela słownikowa
CREATE TABLE dict(
	id_dict INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_dict_type INT NOT NULL, -- połączenie z typem słownika aby rozpoznać jakiego typu dotyczy wpis
	short_description VARCHAR(255) NULL, -- króki opis
	description VARCHAR(MAX) NULL, -- długi opis
	
	lang VARCHAR(20) NULL, -- na wszelki wypadek, gdyby robić stronkę w różnych językach, można potem sterować wyświetlanym opisem w zależności od języka strony
	PRIMARY KEY (id_dict),
	CONSTRAINT FK_dict FOREIGN KEY (id_dict_type)
		REFERENCES dict_types(id_dictio_type) 
	)
Engine=InnoDB DEFAULT charset=utf8;	
	
-- tabela ze specjalizacjami w szkole
-- tą tabelę można przenieść do słowników, bo ma w sumie tylko infomacje o nazwie. tworzymy nowy typ w dict_types i dodajemy wartości w słowniku [dict] z odpowiednim ID
CREATE TABLE specialization(
	id_specialization INT UNSIGNED NOT NULL AUTO_INCREMENT,
	spec_short_name VARCHAR(100) NOT NULL,-- krótka nazwa specjalizacji
	spec_name VARCHAR(255) NULL, -- długa nazwa, pełna, nie jest wymagana
	PRIMARY KEY (id_specialization)
	)
Engine=InnoDB DEFAULT charset=utf8;

CREATE TABLE WORKPLACE(
	id_workplace INT UNSIGNED NOT NULL AUTO_INCREMENT,
	workplace_type INT NOT NULL, -- typ ze słownika (firma/instytucja/uczelnia etc)
	name VARCHAR(255) NOT NULL, -- nazwa
	workplace_country INT NOT NULL,-- kraj
	PRIMARY KEY (id_workplace),
	CONSTRAINT FK_work_type FOREIGN KEY (workplace_type)
		REFERENCES dict(id_dict) -- klucz obcy do tabeli dictionary, gdzie sa wpisy 'univerek', 'biuro' z typem 'workplace type' z dict_types
	CONSTRAINT FK_country FOREIGN KEY (workplace_country)
		REFERENCES dict(id_dict) -- klucz obcy do tabeli dictionary, gdzie sa wpisy 'PL','DE' z typem 'country' z dict_types
	)
Engine=InnoDB DEFAULT charset=utf8;

-- tabela uzytkownicy, służyć będzie do przechowywania danych o pracownikach (wychowawcach klas), uczniach i użytkownikach aplikacji
CREATE TABLE users(
	id_user INT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_type_id INT NOT NULL, -- odwołanie do słownka, określa czy to pracownik, uczeń czy admin
	user_email VARCHAR(255) NULL,-- nie musi byc emaila
	user_pass CHAR(60) NULL, -- typ dla hasłą można dać inny, zależy od zastosowanego sposobu hashowania hasła (np. password_hash() dla PHP)
	first_name VARCHAR(50) NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	gender TINYINT NOT NULL, -- odwołąnie do słownika, typ: Gender
	pesel VARCHAR(20) NULL, -- nie wymagane, co jak obcokrajowiec?
	country INT NOT NULL, -- kraj pracownika, ucznia -> usera
	start_date DATE NOT NULL, -- kiedy pojawił się w szkole
	end_date DATE NULL,-- kiedy zakończył szkołę, może byc puste (np. dla pracownika)
	user_id_division INT NULL, -- id klasy, referencja będzie dodana później (po utworzeniu tabeli division)
	id_company INT NULL, -- odnośnik do słownika, typ: WORKPLACE
	id_university INT NULL, -- odnosnik do słownika, typ: WORKPLACE
	
	
	PRIMARY KEY (id_student),
	CONSTRAINT FK_user_type FOREIGN KEY (user_type_id)
		REFERENCES dict(id_dict) -- klucz obcy do tabeli dictionary, gdzie sa wpisy 'uczen', 'pracownik' z typem 'user_type' z dict_types
	CONSTRAINT FK_GENDER FOREIGN KEY (gender)
		REFERENCES dict(id_dict) -- klucz obcy do tabeli dictionary, gdzie sa wpisy 'K','M', 'inne' z typem 'gender' z dict_types
	CONSTRAINT FK_country FOREIGN KEY (country)
		REFERENCES dict(id_dict) -- klucz obcy do tabeli dictionary, gdzie sa wpisy 'PL','DE' z typem 'country' z dict_types
	CONSTRAINT FK_company FOREIGN KEY (id_company)
		REFERENCES WORKPLACE(id_workplace) -- klucz obcy do tabeli workplace, określjace miejsce pracy, ważne aby podczas zapytań wybierać dict_types='work' zamiast np. 'university'
	CONSTRAINT FK_univer FOREIGN KEY (id_university)
		REFERENCES WORKPLACE(id_workplace) -- klucz obcy do tabeli workplace, określjace uniwersytet, ważne aby podczas zapytań wybierać dict_types='university' zamiast np. 'work'
	)
Engine=InnoDB DEFAULT charset=utf8;



-- tabela dotyczaca klas w szkole
CREATE TABLE division(
	id_division INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_professor INT NOT NULL,-- połączenie z [users]
	division_code VARCHAR(20) NULL, -- kod klasy??
	div_start_date DATE NOT NULL,-- utworzenie klasy
	div_end_date DATE NULL,-- zakończenie klasy
	div_id_specialization INT NULL,-- połączenie z [specialization] (może być klasa bez specializacji?)
	
	created_at DATETIME NOT NULL,
	created_by INT NOT NULL,
	updated_at DATETIME NULL,
	updated_by INT NULL,
	PRIMARY KEY (id_division),
	CONSTRAINT FK_spec FOREIGN KEY (div_id_specialization)
		REFERENCES specialization(id_specialization) -- klucz obcy do tabeli specializacji
	)
Engine=InnoDB DEFAULT charset=utf8;

-- dodanie ostatniego klucza obcego do tabeli [users] okreslajaca klasę ucznia (jeżeli uczeń)
ALTER TABLE users
ADD CONSTRAINT FK_userDivision
FOREIGN KEY (user_id_division) REFERENCES division(id_division);







-- -- -- -- -- -- -- -- -- -
-- -- -- -Initial data
-- -- -- -- -- -- -- -- -- -
INSERT INTO dict_types (type_name,description)
	values ('User','Define user type'),
	values ('Country','Define ountry name'),
	values ('Workplace','Define workplace type'),
	values ('Gender','Define gender')

INSERT INTO dict (id_dict_type,short_description,description)
	values (1,'Admin',NULL), -- id 1
	values (1,'Professor',NULL),-- id 2
	values (1,'Student',NULL),-- id 3
	values (2,'PL',NULL),-- id 4
	values (2,'DE',NULL),-- id 5
	values (3,'University',NULL), -- id 6
	values (3,'Institution',NULL), -- id 7
	values (4,'Male',NULL), -- id 8
	values (4,'Female',NULL) -- id 9
	
INSERT INTO specialization (spec_short_name,spec_name)
	values ('Specjalizacja 1','Długi opis specjalizacji 1'),
	values ('Specjalizacja 2','Długi opis specjalizacji 2')
	
	
INSERT INTO  WORKPLACE(workplace_type,name,country)
	values (6,'Uniwersytet Rzeszowski',4), -- 6 bo university ma taki ID w DICT, 4 bo PL ma taki ID w DICT
	values (6,'Politechnika Rzeszowska',4),
	values (7,'Deutsche Bank',5)
	
INSERT INTO users(user_type_id,user_email,user_pass,first_name,last_name,gender,pesel,country,start_date,end_date,id_division,id_company,id_university)
	values (1,'admin@admin.pl',NULL,'Joachim','Kupsztal',9,NULL,4,'2019-11-25',NULL,NULL,NULL,NULL),
	values (2,'profesor@zst.pl',NULL,'Janusz','WiadomoJaki',8,NULL,4,'1939-09-01',NULL,NULL,NULL,NULL),
	values (3,'uczen@zst.pl',NULL,'Zygfryd','Koterski',8,NULL,4,'2019-09-01',NULL,NULL,NULL,NULL),
	values (3,'uczen2@zst.pl',NULL,'Beatka','Niemka',9,NULL,5,'2019-09-01',NULL,NULL,NULL,NULL)
	
INSERT INTO division(id_professor,division_code,start_date,end_date,id_specialization)
	values(2,'4B','2016-09-01','2020-05-30',2),
	values(2,'4C','2016-09-01','2020-05-30',1)

-- przypisuje juz stworzonym uczniom, klasę
ALTER TABLE users
SET id_division=1
where id_user in (3,4)

-- dodanie nowego ucznia z klasą i pracą na uniwerku
INSERT INTO users(user_type_id,user_email,user_pass,first_name,last_name,gender,pesel,country,start_date,end_date,id_division,id_company,id_university)
	values (3,'uczen3@zst.pl',NULL,'Adam','Ewski',8,NULL,4,'2018-09-01',NULL,1,NULL,2), -- pracuje na politechnice, ale nie pracował w instytucji
	values (3,'uczen4@zst.pl',NULL,'Cyprian','Smieszek',8,NULL,4,'2017-09-01',NULL,2,3,1) -- pracuje na uniwerku, pracował w banku (na przyklad, lub ciągnie dwa etaty)
	
	
	

-- przykład zapytania
-- pokaż uczniów, polaków, którzy pracują na uniwersytecie oraz nigdy nie mieli innej pracy
select u.* from
	users u 
where u.country=4 and id_company is not null and id_company is null

LUB

select u.* from
	users u 
	join dict d on d.id_dict = u.country
where d.short_description='PL' and id_company is not null and id_company is null



-- w aplikacji, wyświetl wszystkie kraje (lista)
select short_description from dict where id_dict_type=2

lub

select short_description from dict d join dict_types dt on dt.id_dictio_type=d.id_dict_type and dt.type_name='Country'