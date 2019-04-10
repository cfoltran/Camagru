#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: USERS
#------------------------------------------------------------

CREATE TABLE USERS(
        id_user   Int  Auto_increment  NOT NULL ,
        firstname Varchar (50) NOT NULL ,
        lastname  Varchar (50) NOT NULL ,
        login     Varchar (50) NOT NULL ,
        email     Varchar (50) NOT NULL ,
        passwd  Varchar (500) NOT NULL
	,CONSTRAINT USERS_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PHOTOS
#------------------------------------------------------------

CREATE TABLE PHOTOS(
        id_photo Int  Auto_increment  NOT NULL ,
        photo    MEDIUMTEXT NOT NULL ,
        date     Date NOT NULL
	,CONSTRAINT PHOTOS_PK PRIMARY KEY (id_photo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: posts
#------------------------------------------------------------

CREATE TABLE posts(
        id_photo Int NOT NULL ,
        id_user  Int NOT NULL
	,CONSTRAINT posts_PK PRIMARY KEY (id_photo,id_user)

	,CONSTRAINT posts_PHOTOS_FK FOREIGN KEY (id_photo) REFERENCES PHOTOS(id_photo)
	,CONSTRAINT posts_USERS0_FK FOREIGN KEY (id_user) REFERENCES USERS(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comments
#------------------------------------------------------------

CREATE TABLE comments(
        id_photo Int NOT NULL ,
        id_user  Int NOT NULL ,
        comment  Varchar (500) NOT NULL
	,CONSTRAINT comments_PK PRIMARY KEY (id_photo,id_user)

	,CONSTRAINT comments_PHOTOS_FK FOREIGN KEY (id_photo) REFERENCES PHOTOS(id_photo)
	,CONSTRAINT comments_USERS0_FK FOREIGN KEY (id_user) REFERENCES USERS(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: likes
#------------------------------------------------------------

CREATE TABLE likes(
        id_photo Int NOT NULL ,
        id_user  Int NOT NULL ,
        likes    Boolean NOT NULL
	,CONSTRAINT likes_PK PRIMARY KEY (id_photo,id_user)

	,CONSTRAINT likes_PHOTOS_FK FOREIGN KEY (id_photo) REFERENCES PHOTOS(id_photo)
	,CONSTRAINT likes_USERS0_FK FOREIGN KEY (id_user) REFERENCES USERS(id_user)
)ENGINE=InnoDB;

