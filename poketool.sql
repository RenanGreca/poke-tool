DROP DATABASE IF EXISTS poketool;
CREATE DATABASE poketool;

USE poketool;

CREATE TABLE Pokemon (
    dexno INTEGER NOT NULL,
    name CHAR(20) NOT NULL,
    type1 INTEGER NOT NULL,
    type2 INTEGER,
    PRIMARY KEY dexno
);

CREATE TABLE Pokedex(
    dexno INTEGER NOT NULL,
    name VARCHAR(16) NOT NULL,
    game VARCHAR(16) NOT NULL,
    uid INTEGER NOT NULL,
    PRIMARY KEY (uid, dexno),
    CONSTRAINT FOREIGN KEY (dexno) REFERENCES Pokemon(dexno) ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY (uid) REFERENCES User(uid) ON DELETE CASCADE
);

#CREATE INDEX poke_index ON Pokedex (uid, dexno)

CREATE TABLE Capture (
    pid INTEGER NOT NULL, #pokemon
    aid INTEGER NOT NULL, #area
    mid INTEGER NOT NULL, #method
    rid INTEGER NOT NULL, #region
    tid INTEGER NOT NULL, #time
    INDEX (pid, aid, rid),
    PRIMARY KEY ()
);

CREATE INDEX poke_capt ON Capture(pid) USING HASH;
CREATE INDEX area_capt ON Capture(aid, rid) USING HASH;

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