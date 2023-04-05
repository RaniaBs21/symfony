<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329232720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE topic (idtopic INT AUTO_INCREMENT NOT NULL, titretopic VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, accepter TINYINT(1) NOT NULL, nbsujet INT NOT NULL, iduser INT DEFAULT NULL, hide INT NOT NULL, imageName VARCHAR(255) DEFAULT NULL, id INT NOT NULL, INDEX fk_userid (iduser), INDEX utilisateur (id), PRIMARY KEY(idtopic)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, created_At DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, nom_carte VARCHAR(255) NOT NULL, numero_carte VARCHAR(255) NOT NULL, exp_mois INT NOT NULL, exp_annee INT NOT NULL, cvc INT NOT NULL, paymentIntent_id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id_utilisateur INT AUTO_INCREMENT NOT NULL, nom_utilisateur VARCHAR(30) NOT NULL, prenom_utilisateur VARCHAR(30) NOT NULL, adresse_utilisateur VARCHAR(30) NOT NULL, num_tel VARCHAR(8) NOT NULL, email VARCHAR(30) NOT NULL, password VARCHAR(30) NOT NULL, INDEX id_utilisateur (id_utilisateur), PRIMARY KEY(id_utilisateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement CHANGE Id_abon Id_abon INT AUTO_INCREMENT NOT NULL, CHANGE id_transaction id_transaction INT DEFAULT NULL, ADD PRIMARY KEY (Id_abon)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB6A25C826 FOREIGN KEY (id_transaction) REFERENCES transaction (id)');
        $this->addSql('CREATE INDEX id_transaction ON abonnement (id_transaction)');
        $this->addSql('CREATE INDEX id_cours ON abonnement (id_cours)');
        $this->addSql('ALTER TABLE admin ADD nom_u VARCHAR(255) DEFAULT NULL, ADD prenom_u VARCHAR(255) DEFAULT NULL, ADD age INT NOT NULL, ADD adresse VARCHAR(50) NOT NULL, ADD tel VARCHAR(15) NOT NULL, ADD role VARCHAR(30) NOT NULL, ADD genere INT NOT NULL, ADD pwd VARCHAR(20) NOT NULL, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES topic (id)');
        $this->addSql('ALTER TABLE cart CHANGE Id_Cart Id_Cart INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (Id_Cart)');
        $this->addSql('CREATE INDEX iduser ON cart (id)');
        $this->addSql('CREATE INDEX Id_Prod ON cart (Id_Prod)');
        $this->addSql('ALTER TABLE categorie_cours CHANGE Id_cat Id_cat INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (Id_cat)');
        $this->addSql('ALTER TABLE categorie_prod CHANGE id_cat_prod id_cat_prod INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_cat_prod)');
        $this->addSql('ALTER TABLE commande CHANGE Id_Cmd Id_Cmd INT AUTO_INCREMENT NOT NULL, CHANGE Id_Cart Id_Cart INT DEFAULT NULL, ADD PRIMARY KEY (Id_Cmd)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DEF0C0217 FOREIGN KEY (Id_Cart) REFERENCES cart (Id_Cart)');
        $this->addSql('CREATE INDEX fk_commande_cart ON commande (Id_Cart)');
        $this->addSql('ALTER TABLE commentaire CHANGE idcom idcom INT AUTO_INCREMENT NOT NULL, CHANGE nblike nblike INT NOT NULL, CHANGE nbdislike nbdislike INT NOT NULL, ADD PRIMARY KEY (idcom)');
        $this->addSql('CREATE INDEX fk_idsujet ON commentaire (idsujet)');
        $this->addSql('CREATE INDEX fk_idusercom ON commentaire (id)');
        $this->addSql('ALTER TABLE cours CHANGE Id_c Id_c INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (Id_c)');
        $this->addSql('CREATE INDEX Sous_categorie ON cours (Sous_categorie)');
        $this->addSql('CREATE INDEX utilisateur ON cours (id)');
        $this->addSql('ALTER TABLE dislikee CHANGE id_dislike id_dislike INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_dislike)');
        $this->addSql('CREATE INDEX fk_comdislike ON dislikee (id_commentaire)');
        $this->addSql('CREATE INDEX fk_userdislike ON dislikee (id)');
        $this->addSql('ALTER TABLE evenement CHANGE id_ev id_ev INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_ev)');
        $this->addSql('CREATE INDEX iduser ON evenement (id)');
        $this->addSql('ALTER TABLE level_cours CHANGE Id_level Id_level INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (Id_level)');
        $this->addSql('CREATE INDEX cours ON level_cours (Id_c)');
        $this->addSql('ALTER TABLE likee CHANGE id_like id_like INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_like)');
        $this->addSql('CREATE INDEX fk_com ON likee (id_commentaire)');
        $this->addSql('CREATE INDEX fk_user ON likee (id)');
        $this->addSql('ALTER TABLE participation CHANGE id_part id_part INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_part)');
        $this->addSql('CREATE INDEX idev ON participation (id_ev)');
        $this->addSql('CREATE INDEX iduser ON participation (id)');
        $this->addSql('ALTER TABLE points CHANGE id_points id_points INT AUTO_INCREMENT NOT NULL, CHANGE id id INT DEFAULT NULL, ADD PRIMARY KEY (id_points)');
        $this->addSql('ALTER TABLE points ADD CONSTRAINT FK_27BA8E29BF396750 FOREIGN KEY (id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX iduser ON points (id)');
        $this->addSql('ALTER TABLE produit CHANGE Id_Prod Id_Prod INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (Id_Prod)');
        $this->addSql('ALTER TABLE question_ass CHANGE Id_Q_Ass Id_Q_Ass INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (Id_Q_Ass)');
        $this->addSql('CREATE INDEX Id_Rec ON question_ass (Id_Rec)');
        $this->addSql('CREATE INDEX idreclamation ON question_ass (Id_Rec)');
        $this->addSql('ALTER TABLE question_quiz CHANGE id_quiz id_quiz INT DEFAULT NULL');
        $this->addSql('CREATE INDEX id_quiz_2 ON question_quiz (id_quiz)');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY quiz_ibfk_1');
        $this->addSql('ALTER TABLE quiz CHANGE id_quiz id_quiz INT AUTO_INCREMENT NOT NULL, CHANGE id id INT DEFAULT NULL');
        $this->addSql('DROP INDEX id ON quiz');
        $this->addSql('CREATE INDEX iduser ON quiz (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT quiz_ibfk_1 FOREIGN KEY (id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE reclamation CHANGE Id_Rec Id_Rec INT AUTO_INCREMENT NOT NULL, CHANGE id id INT DEFAULT NULL, ADD PRIMARY KEY (Id_Rec)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404BF396750 FOREIGN KEY (id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX iduser ON reclamation (id)');
        $this->addSql('ALTER TABLE reponse_ass CHANGE Id_Rep_Ass Id_Rep_Ass INT AUTO_INCREMENT NOT NULL, CHANGE Id_Rec Id_Rec INT DEFAULT NULL, ADD PRIMARY KEY (Id_Rep_Ass)');
        $this->addSql('ALTER TABLE reponse_ass ADD CONSTRAINT FK_13E7E092C54061A0 FOREIGN KEY (Id_Rec) REFERENCES reclamation (Id_Rec)');
        $this->addSql('CREATE INDEX idreclamation ON reponse_ass (Id_Rec)');
        $this->addSql('ALTER TABLE reponse_quiz DROP FOREIGN KEY reponse_quiz_ibfk_1');
        $this->addSql('ALTER TABLE reponse_quiz CHANGE id_quest id_quest INT DEFAULT NULL');
        $this->addSql('DROP INDEX id_quest ON reponse_quiz');
        $this->addSql('CREATE INDEX idquestion ON reponse_quiz (id_quest)');
        $this->addSql('ALTER TABLE reponse_quiz ADD CONSTRAINT reponse_quiz_ibfk_1 FOREIGN KEY (id_quest) REFERENCES question_quiz (id_quest)');
        $this->addSql('ALTER TABLE reponse_utilisateur CHANGE id_rep id_rep INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_rep)');
        $this->addSql('CREATE INDEX iduser ON reponse_utilisateur (id)');
        $this->addSql('CREATE INDEX idquiz ON reponse_utilisateur (id_quiz)');
        $this->addSql('CREATE INDEX idquest ON reponse_utilisateur (id_quest)');
        $this->addSql('ALTER TABLE sous_categorie CHANGE ID_sc ID_sc INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (ID_sc)');
        $this->addSql('CREATE INDEX categorie_cours ON sous_categorie (Id_cat)');
        $this->addSql('ALTER TABLE sujet CHANGE idsujet idsujet INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (idsujet)');
        $this->addSql('CREATE INDEX fk_iduser ON sujet (id)');
        $this->addSql('CREATE INDEX fk_idtopic ON sujet (idtopic)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB6A25C826');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE abonnement MODIFY Id_abon INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON abonnement');
        $this->addSql('DROP INDEX id_transaction ON abonnement');
        $this->addSql('DROP INDEX id_cours ON abonnement');
        $this->addSql('ALTER TABLE abonnement CHANGE id_transaction id_transaction INT NOT NULL, CHANGE Id_abon Id_abon INT NOT NULL');
        $this->addSql('ALTER TABLE admin DROP nom_u, DROP prenom_u, DROP age, DROP adresse, DROP tel, DROP role, DROP genere, DROP pwd, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE cart MODIFY Id_Cart INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON cart');
        $this->addSql('DROP INDEX iduser ON cart');
        $this->addSql('DROP INDEX Id_Prod ON cart');
        $this->addSql('ALTER TABLE cart CHANGE Id_Cart Id_Cart INT NOT NULL');
        $this->addSql('ALTER TABLE categorie_cours MODIFY Id_cat INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON categorie_cours');
        $this->addSql('ALTER TABLE categorie_cours CHANGE Id_cat Id_cat INT NOT NULL');
        $this->addSql('ALTER TABLE categorie_prod MODIFY id_cat_prod INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON categorie_prod');
        $this->addSql('ALTER TABLE categorie_prod CHANGE id_cat_prod id_cat_prod INT NOT NULL');
        $this->addSql('ALTER TABLE commande MODIFY Id_Cmd INT NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEF0C0217');
        $this->addSql('DROP INDEX `primary` ON commande');
        $this->addSql('DROP INDEX fk_commande_cart ON commande');
        $this->addSql('ALTER TABLE commande CHANGE Id_Cmd Id_Cmd INT NOT NULL, CHANGE Id_Cart Id_Cart INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire MODIFY idcom INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON commentaire');
        $this->addSql('DROP INDEX fk_idsujet ON commentaire');
        $this->addSql('DROP INDEX fk_idusercom ON commentaire');
        $this->addSql('ALTER TABLE commentaire CHANGE idcom idcom INT NOT NULL, CHANGE nblike nblike INT DEFAULT 0 NOT NULL, CHANGE nbdislike nbdislike INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE cours MODIFY Id_c INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON cours');
        $this->addSql('DROP INDEX Sous_categorie ON cours');
        $this->addSql('DROP INDEX utilisateur ON cours');
        $this->addSql('ALTER TABLE cours CHANGE Id_c Id_c INT NOT NULL');
        $this->addSql('ALTER TABLE dislikee MODIFY id_dislike INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON dislikee');
        $this->addSql('DROP INDEX fk_comdislike ON dislikee');
        $this->addSql('DROP INDEX fk_userdislike ON dislikee');
        $this->addSql('ALTER TABLE dislikee CHANGE id_dislike id_dislike INT NOT NULL');
        $this->addSql('ALTER TABLE evenement MODIFY id_ev INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON evenement');
        $this->addSql('DROP INDEX iduser ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE id_ev id_ev INT NOT NULL');
        $this->addSql('ALTER TABLE level_cours MODIFY Id_level INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON level_cours');
        $this->addSql('DROP INDEX cours ON level_cours');
        $this->addSql('ALTER TABLE level_cours CHANGE Id_level Id_level INT NOT NULL');
        $this->addSql('ALTER TABLE likee MODIFY id_like INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON likee');
        $this->addSql('DROP INDEX fk_com ON likee');
        $this->addSql('DROP INDEX fk_user ON likee');
        $this->addSql('ALTER TABLE likee CHANGE id_like id_like INT NOT NULL');
        $this->addSql('ALTER TABLE participation MODIFY id_part INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON participation');
        $this->addSql('DROP INDEX idev ON participation');
        $this->addSql('DROP INDEX iduser ON participation');
        $this->addSql('ALTER TABLE participation CHANGE id_part id_part INT NOT NULL');
        $this->addSql('ALTER TABLE points MODIFY id_points INT NOT NULL');
        $this->addSql('ALTER TABLE points DROP FOREIGN KEY FK_27BA8E29BF396750');
        $this->addSql('DROP INDEX `primary` ON points');
        $this->addSql('DROP INDEX iduser ON points');
        $this->addSql('ALTER TABLE points CHANGE id_points id_points INT NOT NULL, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE produit MODIFY Id_Prod INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON produit');
        $this->addSql('ALTER TABLE produit CHANGE Id_Prod Id_Prod INT NOT NULL');
        $this->addSql('ALTER TABLE question_ass MODIFY Id_Q_Ass INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON question_ass');
        $this->addSql('DROP INDEX Id_Rec ON question_ass');
        $this->addSql('DROP INDEX idreclamation ON question_ass');
        $this->addSql('ALTER TABLE question_ass CHANGE Id_Q_Ass Id_Q_Ass INT NOT NULL');
        $this->addSql('DROP INDEX id_quiz_2 ON question_quiz');
        $this->addSql('ALTER TABLE question_quiz CHANGE id_quiz id_quiz INT NOT NULL');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92BF396750');
        $this->addSql('ALTER TABLE quiz CHANGE id_quiz id_quiz INT NOT NULL, CHANGE id id INT NOT NULL');
        $this->addSql('DROP INDEX iduser ON quiz');
        $this->addSql('CREATE INDEX id ON quiz (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92BF396750 FOREIGN KEY (id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE reclamation MODIFY Id_Rec INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404BF396750');
        $this->addSql('DROP INDEX `primary` ON reclamation');
        $this->addSql('DROP INDEX iduser ON reclamation');
        $this->addSql('ALTER TABLE reclamation CHANGE id id INT NOT NULL, CHANGE Id_Rec Id_Rec INT NOT NULL');
        $this->addSql('ALTER TABLE reponse_ass MODIFY Id_Rep_Ass INT NOT NULL');
        $this->addSql('ALTER TABLE reponse_ass DROP FOREIGN KEY FK_13E7E092C54061A0');
        $this->addSql('DROP INDEX `primary` ON reponse_ass');
        $this->addSql('DROP INDEX idreclamation ON reponse_ass');
        $this->addSql('ALTER TABLE reponse_ass CHANGE Id_Rep_Ass Id_Rep_Ass INT NOT NULL, CHANGE Id_Rec Id_Rec INT NOT NULL');
        $this->addSql('ALTER TABLE reponse_quiz DROP FOREIGN KEY FK_9879B3D1AD92B927');
        $this->addSql('ALTER TABLE reponse_quiz CHANGE id_quest id_quest INT NOT NULL');
        $this->addSql('DROP INDEX idquestion ON reponse_quiz');
        $this->addSql('CREATE INDEX id_quest ON reponse_quiz (id_quest)');
        $this->addSql('ALTER TABLE reponse_quiz ADD CONSTRAINT FK_9879B3D1AD92B927 FOREIGN KEY (id_quest) REFERENCES question_quiz (id_quest)');
        $this->addSql('ALTER TABLE reponse_utilisateur MODIFY id_rep INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON reponse_utilisateur');
        $this->addSql('DROP INDEX iduser ON reponse_utilisateur');
        $this->addSql('DROP INDEX idquiz ON reponse_utilisateur');
        $this->addSql('DROP INDEX idquest ON reponse_utilisateur');
        $this->addSql('ALTER TABLE reponse_utilisateur CHANGE id_rep id_rep INT NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie MODIFY ID_sc INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON sous_categorie');
        $this->addSql('DROP INDEX categorie_cours ON sous_categorie');
        $this->addSql('ALTER TABLE sous_categorie CHANGE ID_sc ID_sc INT NOT NULL');
        $this->addSql('ALTER TABLE sujet MODIFY idsujet INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON sujet');
        $this->addSql('DROP INDEX fk_iduser ON sujet');
        $this->addSql('DROP INDEX fk_idtopic ON sujet');
        $this->addSql('ALTER TABLE sujet CHANGE idsujet idsujet INT NOT NULL');
    }
}
