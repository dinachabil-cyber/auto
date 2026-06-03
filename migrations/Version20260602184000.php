<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260602184000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create professionel table and drop old devis tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS professionel (
            id INT AUTO_INCREMENT NOT NULL,
            nom VARCHAR(255) NOT NULL,
            prenom VARCHAR(255) NOT NULL,
            product VARCHAR(50) DEFAULT NULL,
            demarrage VARCHAR(255) DEFAULT NULL,
            raison_sociale VARCHAR(255) DEFAULT NULL,
            activite VARCHAR(255) DEFAULT NULL,
            assure VARCHAR(255) DEFAULT NULL,
            code_postal VARCHAR(255) DEFAULT NULL,
            ancienne VARCHAR(255) DEFAULT NULL,
            motif VARCHAR(255) DEFAULT NULL,
            email VARCHAR(255) NOT NULL,
            tele VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT NULL,
            PRIMARY KEY(id)
        ) ENGINE=InnoDB');

        $this->addSql('SET FOREIGN_KEY_CHECKS=0');
        $this->addSql('DROP TABLE IF EXISTS devis_reponses');
        $this->addSql('DROP TABLE IF EXISTS devis');
        $this->addSql('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE professionel');

        $this->addSql('CREATE TABLE devis (
            id INT AUTO_INCREMENT NOT NULL,
            nom VARCHAR(255) NOT NULL,
            prenom VARCHAR(255) NOT NULL,
            raison_sociale VARCHAR(255) DEFAULT NULL,
            activite VARCHAR(255) DEFAULT NULL,
            demarrage VARCHAR(3) DEFAULT NULL,
            assure VARCHAR(3) DEFAULT NULL,
            ancienne VARCHAR(3) DEFAULT NULL,
            motif_resiliation VARCHAR(255) DEFAULT NULL,
            code_postal VARCHAR(10) DEFAULT NULL,
            email VARCHAR(255) DEFAULT NULL,
            telephone VARCHAR(20) DEFAULT NULL,
            statut VARCHAR(255) DEFAULT \'nouveau\',
            notes LONGTEXT DEFAULT NULL,
            created_at DATETIME DEFAULT NULL,
            updated_at DATETIME DEFAULT NULL,
            PRIMARY KEY(id)
        ) ENGINE=InnoDB');

        $this->addSql('CREATE TABLE devis_reponses (
            id INT AUTO_INCREMENT NOT NULL,
            devis_id INT DEFAULT NULL,
            compagnie VARCHAR(255) NOT NULL,
            type_garantie VARCHAR(255) DEFAULT NULL,
            prime_annuelle DECIMAL(10,2) DEFAULT NULL,
            prime_mensuelle DECIMAL(10,2) DEFAULT NULL,
            garanties LONGTEXT DEFAULT NULL,
            franchise VARCHAR(255) DEFAULT NULL,
            delai_carence_mois INT DEFAULT NULL,
            conditions_particulieres LONGTEXT DEFAULT NULL,
            created_at DATETIME DEFAULT NULL,
            updated_at DATETIME DEFAULT NULL,
            PRIMARY KEY(id)
        ) ENGINE=InnoDB');

        $this->addSql('ALTER TABLE devis_reponses ADD CONSTRAINT FK_7C1EDD8241DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
    }
}