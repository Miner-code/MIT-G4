DROP DATABASE IF EXISTS UNEA;

CREATE DATABASE IF NOT EXISTS UNEA;
USE UNEA;
# -----------------------------------------------------------------------------
#       TABLE : Commentaire
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Commentaire
 (
   num_com INTEGER(2) NOT NULL  ,
   num_imp INTEGER(2) NOT NULL  ,
   cont_com VARCHAR(255) NULL  
   , PRIMARY KEY (num_com) 
 )  ENGINE=InnoDB DEFAULT CHARSET=latin1
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : User
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS User
 (
   num_user INTEGER(2) NOT NULL  ,
   num_etab INTEGER(2) NOT NULL  ,
   nom_user CHAR(32) NOT NULL  ,
   prenom_user CHAR(32) NOT NULL  ,
   mail_user CHAR(32) NOT NULL  ,
   dtn_user DATE NULL  ,
   mdp_user CHAR(50) NOT NULL  ,
   img_user VARCHAR(128) NULL  ,
   role_user SMALLINT(1) NOT NULL  
   , PRIMARY KEY (num_user) 
 )  ENGINE=InnoDB DEFAULT CHARSET=latin1
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : Etablissement
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Etablissement
 (
   num_etab INTEGER(2) NOT NULL  ,
   num_Ville INTEGER(2) NOT NULL  ,
   nom_etab VARCHAR(128) NULL  ,
   adresse_etab VARCHAR(128) NULL  
   , PRIMARY KEY (num_etab) 
 )  ENGINE=InnoDB DEFAULT CHARSET=latin1
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : Impression
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Impression
 (
   num_imp INTEGER(2) NOT NULL  ,
   num_Theme INTEGER(2) NOT NULL  ,
   num_user INTEGER(2) NOT NULL  ,
   titre_imp VARCHAR(128) NOT NULL  ,
   contenu_imp VARCHAR(255) NOT NULL  
   , PRIMARY KEY (num_imp) 
 )  ENGINE=InnoDB DEFAULT CHARSET=latin1
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : Ville
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Ville
 (
   num_ville INTEGER(2) NOT NULL  ,
   nom_ville CHAR(32) NULL  ,
   cp_ville INTEGER(5) NULL  
   , PRIMARY KEY (num_ville) 
 )  ENGINE=InnoDB DEFAULT CHARSET=latin1
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : Theme
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Theme
 (
   num_theme INTEGER(2) NOT NULL  ,
   libele_theme VARCHAR(128) NULL  
   , PRIMARY KEY (num_theme) 
 )  ENGINE=InnoDB DEFAULT CHARSET=latin1
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : Cursus
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Cursus
 (
   num_cursus INTEGER(2) NOT NULL  ,
   libele_cursus VARCHAR(128) NOT NULL  ,
   spe_cursus VARCHAR(128) NOT NULL  ,
   date_obtention DATE NULL  
   , PRIMARY KEY (num_cursus) 
 )  ENGINE=InnoDB DEFAULT CHARSET=latin1
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : Participer
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Participer
 (
   num_user INTEGER(2) NOT NULL  ,
   num_cursus INTEGER(2) NOT NULL  
   , PRIMARY KEY (num_user,num_cursus) 
 )  ENGINE=InnoDB DEFAULT CHARSET=latin1
 comment = "";


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE Commentaire 
  ADD FOREIGN KEY FK_Commentaire_Impression (num_imp)
      REFERENCES Impression (num_imp) ;


ALTER TABLE User 
  ADD FOREIGN KEY FK_User_Etablissement (num_etab)
      REFERENCES Etablissement (num_etab) ;


ALTER TABLE Etablissement 
  ADD FOREIGN KEY FK_Etablissement_Ville (num_ville)
      REFERENCES Ville (num_ville) ;


ALTER TABLE Impression 
  ADD FOREIGN KEY FK_Impression_Theme (num_Theme)
      REFERENCES Theme (num_Theme) ;


ALTER TABLE Impression 
  ADD FOREIGN KEY FK_Impression_User (num_user)
      REFERENCES User (num_user) ;


ALTER TABLE Participer 
  ADD FOREIGN KEY FK_Participer_User (num_user)
      REFERENCES User (num_user) ;


ALTER TABLE Participer 
  ADD FOREIGN KEY FK_Participer_Cursus (num_cursus)
      REFERENCES Cursus (num_cursus) ;

