DROP DATABASE IF EXISTS poketool;
CREATE DATABASE poketool;

GRANT ALL PRIVILEGES ON poketool.* TO 'test'@'localhost' IDENTIFIED BY 'test'; #test passcode is test;

USE poketool;

CREATE TABLE Pokemon(
    dexno INTEGER NOT NULL,
    name CHAR(20) NOT NULL,
    type1 INTEGER NULL, 
    type2 INTEGER NULL,
    PRIMARY KEY (dexno)
);

CREATE TABLE Users(
    uid INTEGER NOT NULL,
    name VARCHAR(16) NOT NULL,
    PRIMARY KEY (uid)
);

CREATE TABLE Pokedex(
    dexno INTEGER NOT NULL,
    game VARCHAR(16) NOT NULL,
    uid INTEGER NOT NULL,
    PRIMARY KEY (uid, dexno),
    CONSTRAINT FOREIGN KEY (dexno) REFERENCES Pokemon(dexno) ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY (uid) REFERENCES Users(uid) ON DELETE CASCADE
);

CREATE TABLE Region (
    rid INTEGER NOT NULL,
    name CHAR(10) NOT NULL,
    PRIMARY KEY (rid)
);

CREATE TABLE Location (
    lid INTEGER NOT NULL,
    rid INTEGER NOT NULL,
    name CHAR(30) NOT NULL,
    PRIMARY KEY (lid),
    CONSTRAINT FOREIGN KEY (rid) REFERENCES Region(rid) ON DELETE CASCADE
);

CREATE TABLE Area (
    aid INTEGER NOT NULL,
    lid INTEGER NOT NULL,
    name CHAR(30) NULL,
    PRIMARY KEY (aid),
    CONSTRAINT FOREIGN KEY (lid) REFERENCES Location(lid) ON DELETE CASCADE
);

CREATE TABLE Game (
    gid INTEGER NOT NULL,
    gen INTEGER NOT NULL,
    name CHAR(20) NOT NULL,
    plat CHAR(15) NULL,
    PRIMARY KEY (gid)
);

# Contains the 18 possible types
CREATE TABLE Type (
    tid INTEGER NOT NULL,
    name CHAR(10) NOT NULL,
    PRIMARY KEY (tid)
);

# Contains the type matchups
CREATE TABLE Matchup (
    atk_tid INTEGER NOT NULL,
    def_tid INTEGER NOT NULL,
    multiplier INTEGER NOT NULL,
    PRIMARY KEY (atk_tid, def_tid),
    CONSTRAINT FOREIGN KEY (atk_tid) REFERENCES Type(tid) ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY (def_tid) REFERENCES Type(tid) ON DELETE CASCADE
);

# Contains the possible methods of capture
CREATE TABLE CatchMethod (
    mid INTEGER NOT NULL,
    description VARCHAR(50) NOT NULL,
    PRIMARY KEY (mid)
);

CREATE TABLE Capture (
    #cid INTEGER NOT NULL, #id
    pid INTEGER NOT NULL, #pokemon
    aid INTEGER NOT NULL, #area
    mid INTEGER NULL, #method
    gid INTEGER NOT NULL, #game
    fid INTEGER NULL, #frequency
    min_level INTEGER NULL,
    max_level INTEGER NULL,
    PRIMARY KEY (pid, aid, gid),
    CONSTRAINT FOREIGN KEY (pid) REFERENCES Pokemon(dexno) ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY (aid) REFERENCES Area(aid) ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY (gid) REFERENCES Game(gid) ON DELETE CASCADE
);

#Index Creation
#CREATE INDEX poke_index ON Pokedex (uid, dexno);
CREATE INDEX poke_capt ON Capture(pid, gid) USING HASH; #Includes gid for game-diffs
CREATE INDEX area_capt ON Capture(aid) USING HASH;

# Listed below are some test data sets.
/*
INSERT INTO Game (gid, gen, name, plat) VALUES (1, 1, "Pokemon Red", "GameBoy");
INSERT INTO Game (gid, gen, name, plat) VALUES (2, 1, "Pokemon Green", "GameBoy");
INSERT INTO Game (gid, gen, name, plat) VALUES (3, 1, "Pokemon Blue", "GameBoy");
INSERT INTO Game (gid, gen, name, plat) VALUES (4, 1, "Pokemon Yellow", "GameBoyColor");
INSERT INTO Game (gid, gen, name, plat) VALUES (5, 2, "Pokemon Gold", "GameBoyColor");
INSERT INTO Game (gid, gen, name, plat) VALUES (6, 2, "Pokemon Silver", "GameBoyColor");
INSERT INTO Game (gid, gen, name, plat) VALUES (7, 2, "Pokemon Crystal", "GameBoyColor");

INSERT INTO Pokemon(dexno, name, type1, type2) VALUES (1, "Bulbasaur", 1, NULL);
INSERT INTO Pokemon(dexno, name, type1, type2) VALUES (2, "Ivysaur", 1, NULL);
INSERT INTO Pokemon(dexno, name, type1, type2) VALUES (3, "Venusaur", 1, NULL);
*/
INSERT INTO Users(uid, name) VALUES (1, "test");
