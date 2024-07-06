/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     07/07/2024 1:12:35 AM                         */
/*==============================================================*/


drop table if exists UTILISATEUR;

drop table if exists CONGE;

drop table if exists DEPARTEMENT;

drop table if exists POSTE;

/*==============================================================*/
/* Table: UTILISATEUR                                                  */
/*==============================================================*/
create table UTILISATEUR
(
   MATRICULE            int not null,
   ID_POSTE             int not null,
   NOM                  varchar(255),
   PRENOM               varchar(255),
   ROLE                 varchar(255),
   NUMERO_TELEPHONE     varchar(255),
   MAIL                 varchar(255),
   MOT_DE_PASSE         varchar(255),
   SOLDE_CONGE          int not null,
   MANAGER_MATRICULE    int  null,
   primary key (MATRICULE)
);

/*==============================================================*/
/* Table: CONGE                                                 */
/*==============================================================*/
create table CONGE
(
   ID_CONGE             int not null AUTO_INCREMENT,
   MATRICULE            int not null,
   DATE_DEBUT           date,
   DATE_FIN             date,
   NOMBRE_JOUR          int,
   TYPE_CONGE           varchar(255),
   ETAT                 varchar(255),
   primary key (ID_CONGE)
);

/*==============================================================*/
/* Table: DEPARTEMENT                                           */
/*==============================================================*/
create table DEPARTEMENT
(
   ID_DEPARTEMENT          int not null,
   NOM_DEPARTEMENT         varchar(255),
   primary key (ID_DEPARTEMENT)
);

/*==============================================================*/
/* Table: POSTE                                                 */
/*==============================================================*/
create table POSTE
(
   ID_POSTE           int not null,
   ID_DEPARTEMENT     int,
   NOM_POSTE          varchar(255),
   primary key (ID_POSTE)
);

alter table UTILISATEUR add constraint FK_TRAVAILLER foreign key (ID_POSTE)
      references POSTE (ID_POSTE) on delete restrict on update restrict;

alter table UTILISATEUR add constraint FK_MANAGER foreign key (MANAGER_MATRICULE)
      references UTILISATEUR (MATRICULE) on delete restrict on update restrict;

alter table CONGE add constraint FK_DEMANDER foreign key (MATRICULE)
      references UTILISATEUR (MATRICULE) on delete restrict on update restrict;

alter table POSTE add constraint FK_AVOIR foreign key (ID_DEPARTEMENT)
      references DEPARTEMENT (ID_DEPARTEMENT) on delete restrict on update restrict;

/*==============================================================*/
/* Insert fake data into tables                                 */
/*==============================================================*/

/* Insert fake data into DEPARTEMENT table */
insert into DEPARTEMENT (ID_DEPARTEMENT, NOM_DEPARTEMENT) values
(1, 'Human Resources'),
(2, 'IT Department');

/* Insert fake data into POSTE table */
insert into POSTE (ID_POSTE, ID_DEPARTEMENT, NOM_POSTE) values
(1, 1, 'Manager'),
(2, 2, 'Developer'),
(3, 2, 'Designer');

/* Insert fake data into UTILISATEUR table with specific MATRICULE values */
insert into UTILISATEUR (MATRICULE, ID_POSTE, NOM, PRENOM, ROLE, NUMERO_TELEPHONE, MAIL, MOT_DE_PASSE, SOLDE_CONGE) values
(700532, 1, 'John', 'Doe', 'Manager', '123-456-7890', 'john.doe@example.com', '$2y$10$MQXAr3BwzMC.D6f1.AIIcOcPARz//LCS64ZFapWQUdXphbMQ/koEm', 25),
(700453, 2, 'Jane', 'Smith', 'Employe', '234-567-8901', 'jane.smith@example.com', '$2y$10$MQXAr3BwzMC.D6f1.AIIcOcPARz//LCS64ZFapWQUdXphbMQ/koEm', 20),
(700489, 3, 'Michael', 'Johnson', 'Responsable_RH', '345-678-9012', 'michael.johnson@example.com', '$2y$10$MQXAr3BwzMC.D6f1.AIIcOcPARz//LCS64ZFapWQUdXphbMQ/koEm', 15);

/* Insert fake data into CONGE table referencing specific MATRICULE values */
insert into CONGE (ID_CONGE, MATRICULE, DATE_DEBUT, DATE_FIN, NOMBRE_JOUR, TYPE_CONGE, ETAT) values
(1, 700532, '2024-06-01', '2024-06-05', 5, 'Vacation', 'Approved'),
(2, 700453, '2024-07-10', '2024-07-12', 3, 'Sick Leave', 'Pending'),
(3, 700489, '2024-08-15', '2024-08-18', 4, 'Maternity Leave', 'Rejected');