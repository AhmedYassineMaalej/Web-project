DROP DATABASE IF EXISTS website_db;
CREATE DATABASE website_db;

USE website_db;


CREATE TABLE IF NOT EXISTS Users (
    ID          INT          NOT NULL AUTO_INCREMENT,
    Username    VARCHAR(100) NOT NULL UNIQUE,
    Role        VARCHAR(50)  NOT NULL DEFAULT 'user',
    Pwd         VARCHAR(255) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Category (
    ID    INT          NOT NULL AUTO_INCREMENT,
    Name  VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY (ID)
);


CREATE TABLE IF NOT EXISTS Provider (
    ID    INT          NOT NULL AUTO_INCREMENT,
    Name  VARCHAR(100) NOT NULL,
    Icon  VARCHAR(255),
    Link  VARCHAR(500),
    IsForeign BOOLEAN,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Product (
    ID          INT          NOT NULL AUTO_INCREMENT,
    Reference   VARCHAR(100) NOT NULL UNIQUE,
    Name        VARCHAR(100) NOT NULL,
    Image       VARCHAR(500),
    CategoryID  INT,
    PRIMARY KEY (ID),
    CONSTRAINT fk_product_category
        FOREIGN KEY (CategoryID) REFERENCES Category(ID)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS ProductInfo (
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


CREATE TABLE IF NOT EXISTS ProductOffer (
    ID         INT            NOT NULL AUTO_INCREMENT,
    ProductID  INT   NOT NULL,          
    Link       VARCHAR(500),
    Price      DECIMAL(10, 2) NOT NULL,
    ProviderID INT            NOT NULL,
    PRIMARY KEY (ID),
    CONSTRAINT fk_productoffer_product
        FOREIGN KEY (ProductID) REFERENCES Product(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_productoffer_provider
        FOREIGN KEY (ProviderID) REFERENCES Provider(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS Bookmark (
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



CREATE TABLE if not exists Cart (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    total_price int default 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_cart (user_id)
);

CREATE TABLE if not exists CartItem (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cart_id INT NOT NULL,
    product_offer_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    totalprice DECIMAL(10, 2) default 0 NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cart_id) REFERENCES Cart(id) ON DELETE CASCADE,
    FOREIGN KEY (product_offer_id) REFERENCES ProductOffer(id) ON DELETE CASCADE,
    UNIQUE KEY unique_cart_item (cart_id, product_offer_id)
);
CREATE TABLE IF NOT EXISTS recommendation (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    product_id1 INT,
    product_id2 INT,
    weight INT CHECK (weight >= 0),
    CONSTRAINT fk_recommendation_product1 FOREIGN KEY (product_id1) REFERENCES product(id),
    CONSTRAINT fk_recommendation_product2 FOREIGN KEY (product_id2) REFERENCES product(id),
    CONSTRAINT fk_recommendation_category FOREIGN KEY (category_id) REFERENCES category(id),
    CONSTRAINT unique_recommendation UNIQUE KEY (category_id, product_id1, product_id2)
);
