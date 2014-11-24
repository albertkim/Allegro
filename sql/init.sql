CREATE TABLE Customer
(cid INT NOT NULL AUTO_INCREMENT,
password VARCHAR(100),
username CHAR(100),
name CHAR(100),
address VARCHAR(100),
phone VARCHAR(20),
UNIQUE(username),
PRIMARY KEY (cid)
);

CREATE TABLE Item
(upc INT NOT NULL AUTO_INCREMENT,
title VARCHAR(100),
category CHAR(100),
company VARCHAR(100),
year INT,
price FLOAT,
stock INT,
PRIMARY KEY (upc)
);

CREATE TABLE LeadSinger 
(upc INT NOT NULL AUTO_INCREMENT,
name CHAR(100),
PRIMARY KEY (upc, name)
);

ALTER TABLE LeadSinger
ADD FOREIGN KEY (upc)
REFERENCES Item(upc)
ON DELETE CASCADE
ON UPDATE CASCADE;

CREATE TABLE HasSong
(upc INT NOT NULL AUTO_INCREMENT,
title VARCHAR(100),
PRIMARY KEY (upc,title)
);

ALTER TABLE HasSong
ADD FOREIGN KEY (upc)
REFERENCES Item(upc)
ON DELETE CASCADE
ON UPDATE CASCADE;

CREATE TABLE Orders (
receiptId INT AUTO_INCREMENT,
date DATE,
cid INT NOT NULL,
card_num INT,
expiryDate DATE,
expectedDate DATE,
deliveredDate DATE,
PRIMARY KEY (receiptId)
);

ALTER TABLE Orders
ADD FOREIGN KEY (cid)
REFERENCES Customer(cid);

CREATE TABLE PurchaseItem
(receiptId INT,
upc INT NOT NULL,
quantity INT,
PRIMARY KEY (receiptId, upc)
);

ALTER TABLE PurchaseItem
ADD FOREIGN KEY (upc)
REFERENCES Item(upc);

CREATE TABLE  Return_Back
(retid INT NOT NULL AUTO_INCREMENT,
date DATE,
receptId INT,
PRIMARY KEY(retid)
);

CREATE TABLE ReturnItem
(retid INT NOT NULL AUTO_INCREMENT,
upc INT NOT NULL,
quantity INT,
PRIMARY KEY (retid,upc)
);

ALTER TABLE ReturnItem
ADD FOREIGN KEY (retid)
REFERENCES Return_Back(retid);

ALTER TABLE ReturnItem
ADD FOREIGN KEY (upc)
REFERENCES Item(upc);