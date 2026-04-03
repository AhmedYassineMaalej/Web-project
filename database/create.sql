DROP DATABASE website_db;
CREATE DATABASE website_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE website_db;


CREATE TABLE Users (
    ID          INT          NOT NULL AUTO_INCREMENT,
    Username    VARCHAR(100) NOT NULL UNIQUE,
    Role        VARCHAR(50)  NOT NULL DEFAULT 'user',
    Pwd         VARCHAR(255) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE Category (
    ID    INT          NOT NULL AUTO_INCREMENT,
    Name  VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY (ID)
);


CREATE TABLE Provider (
    ID    INT          NOT NULL AUTO_INCREMENT,
    Name  VARCHAR(100) NOT NULL,
    Icon  VARCHAR(255),
    Link  VARCHAR(500),
    PRIMARY KEY (ID)
);

CREATE TABLE Product (
    ID          INT          NOT NULL AUTO_INCREMENT,
    Reference   VARCHAR(100) NOT NULL UNIQUE,
    Description TEXT,
    Image       VARCHAR(500),
    CategoryID  INT,                          
    PRIMARY KEY (ID),
    CONSTRAINT fk_product_category
        FOREIGN KEY (CategoryID) REFERENCES Category(ID)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);


CREATE TABLE ProductInfo (
    ID        INT          NOT NULL AUTO_INCREMENT,
    ProductID INT          NOT NULL,
    `Key`     VARCHAR(100) NOT NULL,
    Value     TEXT,
    PRIMARY KEY (ID),
    CONSTRAINT fk_productinfo_product
        FOREIGN KEY (ProductID) REFERENCES Product(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE ProductOffer (
    ID         INT            NOT NULL AUTO_INCREMENT,
    Reference  VARCHAR(100)   NOT NULL,          
    Link       VARCHAR(500),
    Price      DECIMAL(10, 2) NOT NULL,
    ProviderID INT            NOT NULL,
    PRIMARY KEY (ID),
    CONSTRAINT fk_productoffer_product
        FOREIGN KEY (Reference) REFERENCES Product(Reference)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_productoffer_provider
        FOREIGN KEY (ProviderID) REFERENCES Provider(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Bookmark (
    UserID    INT NOT NULL,
    ProductID INT NOT NULL,
    PRIMARY KEY (UserID, ProductID),
    CONSTRAINT fk_bookmark_user
        FOREIGN KEY (UserID) REFERENCES Users(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_bookmark_product
        FOREIGN KEY (ProductID) REFERENCES Product(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
