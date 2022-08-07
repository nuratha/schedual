DROP DATABASE scheducon;
CREATE DATABASE scheducon;
USE scheducon;

-- TABLES --

CREATE TABLE userLog (
    user_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(128) NOT NULL UNIQUE,
    user_email VARCHAR(128) NOT NULL,
    user_pswd VARCHAR(128) NOT NULL,
    ava_lv INT NOT NULL DEFAULT '1',
    ava_hp INT NOT NULL DEFAULT '100',
    total_exp INT NOT NULL DEFAULT '0',
    w_1 INT NOT NULL DEFAULT '0',
    w_2 INT NOT NULL DEFAULT '0',
    w_3 INT NOT NULL DEFAULT '0',
    w_4 INT NOT NULL DEFAULT '0',
    rank CHAR NOT NULL DEFAULT 'F'
);

CREATE TABLE complog (
    cid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cstatus VARCHAR(50) NOT NULL DEFAULT 'ACTVE'
);

CREATE TABLE calclog (
    tid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tname VARCHAR(50) NOT NULL DEFAULT 'QUEST',
    gain_hp INT NOT NULL DEFAULT '10',
    lose_hp INT NOT NULL DEFAULT '10',
    gain_exp INT NOT NULL DEFAULT '20'
);

CREATE TABLE questLog (
    q_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_ID INT NOT NULL,
    tid INT NOT NULL,
    cid INT NOT NULL DEFAULT '1',
    q_name VARCHAR(50) NOT NULL DEFAULT 'Untitled',
    q_start TIME NOT NULL,
    q_end TIME NOT NULL,
    q_day VARCHAR(10) NOT NULL,
    q_desc VARCHAR(50) NOT NULL DEFAULT 'No description'
);

-- FK --
ALTER TABLE questLog
    ADD FOREIGN KEY (user_ID) REFERENCES userLog(user_ID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE questLog
    ADD FOREIGN KEY (tid) REFERENCES calclog(tid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE questLog
    ADD FOREIGN KEY (cid) REFERENCES complog(cid) ON DELETE CASCADE ON UPDATE CASCADE;
  
-- Sample data --
INSERT INTO userLog(user_name, user_email, user_pswd, ava_lv, ava_hp, total_exp, w_1, w_2 , w_3, w_4, rank) 
	VALUES ('Matt', 'matthew@gmail.com', 'abc123', DEFAULT(ava_lv), DEFAULT(ava_hp), DEFAULT(total_exp), DEFAULT(w_1), DEFAULT(w_2), DEFAULT(w_3), DEFAULT(w_4), DEFAULT(rank));
    
INSERT INTO complog(cstatus)
	VALUES ('ACTIVE'),
    		('COMPLETED'),
           	('MISS');

INSERT INTO calclog(tname, gain_hp, lose_hp , gain_exp)
	VALUES ('quest', 0, DEFAULT(lose_hp), DEFAULT(gain_exp)),
           ('idle', DEFAULT(gain_hp), 0, 0);

INSERT INTO questLog(user_ID, tid, cid, q_name, q_start, q_end, q_day, q_desc) 
	VALUES (1, 1, DEFAULT(cid), 'Chem test', '09:30', '11:30', 'Monday', 'Chapters 1-4'),
            (1, 1, DEFAULT(cid), 'Club meeting', '12:30', '13:30', 'Monday', 'Chapters 1-4'),
            (1, 2, DEFAULT(cid), 'Lunch break', '13:30', '14:30', 'Monday', DEFAULT(q_desc));