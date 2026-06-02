<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260602150102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE devis_reponses DROP FOREIGN KEY `FK_7C1EDD8241DEFADA`');
        $this->addSql('DROP TABLE devis_reponses');
        $this->addSql('DROP INDEX IDX_AC7850F2E564F0BF ON auto_ecole_devis');
        $this->addSql('DROP INDEX IDX_AC7850F26C6E55B5A625945B ON auto_ecole_devis');
        $this->addSql('DROP INDEX IDX_AC7850F28B8E8428 ON auto_ecole_devis');
        $this->addSql('DROP INDEX IDX_AC7850F2E7927C74 ON auto_ecole_devis');
        $this->addSql('ALTER TABLE auto_ecole_devis ADD activite VARCHAR(255) DEFAULT NULL, ADD code_postal VARCHAR(10) DEFAULT NULL, DROP updated_at, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\' NOT NULL');
        $this->addSql('DROP INDEX IDX_8B27C52BE564F0BF ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B6C6E55B5A625945B ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B8B8E8428 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BE7927C74 ON devis');
        $this->addSql('ALTER TABLE devis DROP updated_at, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\' NOT NULL');
        $this->addSql('DROP INDEX IDX_BC9C88A6E564F0BF ON garage_devis');
        $this->addSql('DROP INDEX IDX_BC9C88A66C6E55B5A625945B ON garage_devis');
        $this->addSql('DROP INDEX IDX_BC9C88A68B8E8428 ON garage_devis');
        $this->addSql('DROP INDEX IDX_BC9C88A6E7927C74 ON garage_devis');
        $this->addSql('ALTER TABLE garage_devis ADD activite VARCHAR(255) DEFAULT NULL, ADD code_postal VARCHAR(10) DEFAULT NULL, DROP updated_at, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\' NOT NULL');
        $this->addSql('DROP INDEX IDX_BCAFD9CDE7927C74 ON loueur_devis');
        $this->addSql('DROP INDEX IDX_BCAFD9CDE564F0BF ON loueur_devis');
        $this->addSql('DROP INDEX IDX_BCAFD9CD6C6E55B5A625945B ON loueur_devis');
        $this->addSql('DROP INDEX IDX_BCAFD9CD8B8E8428 ON loueur_devis');
        $this->addSql('ALTER TABLE loueur_devis ADD activite VARCHAR(255) DEFAULT NULL, ADD code_postal VARCHAR(10) DEFAULT NULL, DROP updated_at, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\' NOT NULL');
        $this->addSql('DROP INDEX IDX_DFC41F666C6E55B5A625945B ON negociants_devis');
        $this->addSql('DROP INDEX IDX_DFC41F668B8E8428 ON negociants_devis');
        $this->addSql('DROP INDEX IDX_DFC41F66E7927C74 ON negociants_devis');
        $this->addSql('DROP INDEX IDX_DFC41F66E564F0BF ON negociants_devis');
        $this->addSql('ALTER TABLE negociants_devis ADD activite VARCHAR(255) DEFAULT NULL, ADD code_postal VARCHAR(10) DEFAULT NULL, DROP updated_at, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE devis_reponses (id INT AUTO_INCREMENT NOT NULL, devis_id INT DEFAULT NULL, compagnie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_520_ci`, type_garantie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_520_ci`, prime_annuelle NUMERIC(10, 2) DEFAULT NULL, prime_mensuelle NUMERIC(10, 2) DEFAULT NULL, garanties LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_520_ci`, franchise VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_520_ci`, delai_carence_mois INT DEFAULT NULL, conditions_particulieres LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_520_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_7C1EDD8241DEFADA (devis_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_520_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE devis_reponses ADD CONSTRAINT `FK_7C1EDD8241DEFADA` FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE auto_ecole_devis ADD updated_at DATETIME DEFAULT NULL, DROP activite, DROP code_postal, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\'');
        $this->addSql('CREATE INDEX IDX_AC7850F2E564F0BF ON auto_ecole_devis (statut)');
        $this->addSql('CREATE INDEX IDX_AC7850F26C6E55B5A625945B ON auto_ecole_devis (nom, prenom)');
        $this->addSql('CREATE INDEX IDX_AC7850F28B8E8428 ON auto_ecole_devis (created_at)');
        $this->addSql('CREATE INDEX IDX_AC7850F2E7927C74 ON auto_ecole_devis (email)');
        $this->addSql('ALTER TABLE devis ADD updated_at DATETIME DEFAULT NULL, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\'');
        $this->addSql('CREATE INDEX IDX_8B27C52BE564F0BF ON devis (statut)');
        $this->addSql('CREATE INDEX IDX_8B27C52B6C6E55B5A625945B ON devis (nom, prenom)');
        $this->addSql('CREATE INDEX IDX_8B27C52B8B8E8428 ON devis (created_at)');
        $this->addSql('CREATE INDEX IDX_8B27C52BE7927C74 ON devis (email)');
        $this->addSql('ALTER TABLE garage_devis ADD updated_at DATETIME DEFAULT NULL, DROP activite, DROP code_postal, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\'');
        $this->addSql('CREATE INDEX IDX_BC9C88A6E564F0BF ON garage_devis (statut)');
        $this->addSql('CREATE INDEX IDX_BC9C88A66C6E55B5A625945B ON garage_devis (nom, prenom)');
        $this->addSql('CREATE INDEX IDX_BC9C88A68B8E8428 ON garage_devis (created_at)');
        $this->addSql('CREATE INDEX IDX_BC9C88A6E7927C74 ON garage_devis (email)');
        $this->addSql('ALTER TABLE loueur_devis ADD updated_at DATETIME DEFAULT NULL, DROP activite, DROP code_postal, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\'');
        $this->addSql('CREATE INDEX IDX_BCAFD9CDE7927C74 ON loueur_devis (email)');
        $this->addSql('CREATE INDEX IDX_BCAFD9CDE564F0BF ON loueur_devis (statut)');
        $this->addSql('CREATE INDEX IDX_BCAFD9CD6C6E55B5A625945B ON loueur_devis (nom, prenom)');
        $this->addSql('CREATE INDEX IDX_BCAFD9CD8B8E8428 ON loueur_devis (created_at)');
        $this->addSql('ALTER TABLE negociants_devis ADD updated_at DATETIME DEFAULT NULL, DROP activite, DROP code_postal, CHANGE statut statut VARCHAR(255) DEFAULT \'nouveau\'');
        $this->addSql('CREATE INDEX IDX_DFC41F666C6E55B5A625945B ON negociants_devis (nom, prenom)');
        $this->addSql('CREATE INDEX IDX_DFC41F668B8E8428 ON negociants_devis (created_at)');
        $this->addSql('CREATE INDEX IDX_DFC41F66E7927C74 ON negociants_devis (email)');
        $this->addSql('CREATE INDEX IDX_DFC41F66E564F0BF ON negociants_devis (statut)');
    }
}
