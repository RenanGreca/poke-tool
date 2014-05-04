DROP DATABASE IF EXISTS poketool;
CREATE DATABASE poketool;

GRANT ALL PRIVILEGES ON poketool.* TO 'test'@'localhost'; #test passcode is test;

USE poketool;

CREATE TABLE Pokemon(
    dexno INTEGER NOT NULL,
    name CHAR(20) NOT NULL,
    type1 INTEGER NOT NULL,
    type2 INTEGER,
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

CREATE TABLE Capture (
    pid INTEGER NOT NULL, #pokemon
    aid INTEGER NOT NULL, #area
    mid INTEGER NOT NULL, #method
    rid INTEGER NOT NULL, #region
    gid INTEGER NOT NULL, #game
    tid INTEGER NOT NULL, #time
    PRIMARY KEY (pid,aid,mid,rid,gid,tid)
);

CREATE TABLE Area (
    aid INTEGER NOT NULL,
    rid INTEGER NOT NULL,
    name CHAR(20) NOT NULL
);

CREATE TABLE Region (
    rid INTEGER NOT NULL,
    name CHAR(10) NOT NULL
);

CREATE TABLE Game (
    gid INTEGER NOT NULL,
    gen INTEGER NOT NULL,
    name CHAR(15) NOT NULL,
    plat CHAR(15) NOT NULL,
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

#Index Creation
#CREATE INDEX poke_index ON Pokedex (uid, dexno);
CREATE INDEX poke_capt ON Capture(pid, gid) USING HASH; #Includes gid for game-diffs
CREATE INDEX area_capt ON Capture(aid, rid) USING HASH;

# Listed below are some test data sets.

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

INSERT INTO Capture(pid, aid, mid, rid, gid, tid) VALUES (1,2,3,4,1,6);
INSERT INTO Capture(pid, aid, mid, rid, gid, tid) VALUES (2,2,3,4,1,6);
INSERT INTO Capture(pid, aid, mid, rid, gid, tid) VALUES (2,2,3,4,1,1);
INSERT INTO Capture(pid, aid, mid, rid, gid, tid) VALUES (3,2,3,4,1,1);

INSERT INTO Users(uid, name) VALUES (1, "test");
