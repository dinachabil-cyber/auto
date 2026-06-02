<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260601200000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial tables for assurance devis';
    }

    public function up(Schema $schema): void
    {
        // devis table
        $devisTable = $schema->createTable('devis');
        $devisTable->addColumn('id', 'integer', ['autoincrement' => true]);
        $devisTable->addColumn('nom', 'string', ['length' => 255]);
        $devisTable->addColumn('prenom', 'string', ['length' => 255]);
        $devisTable->addColumn('raison_sociale', 'string', ['length' => 255, 'notnull' => false]);
        $devisTable->addColumn('activite', 'string', ['length' => 255, 'notnull' => false]);
        $devisTable->addColumn('demarrage', 'string', ['length' => 3, 'notnull' => false]);
        $devisTable->addColumn('assure', 'string', ['length' => 3, 'notnull' => false]);
        $devisTable->addColumn('ancienne', 'string', ['length' => 3, 'notnull' => false]);
        $devisTable->addColumn('motif_resiliation', 'string', ['length' => 255, 'notnull' => false]);
        $devisTable->addColumn('code_postal', 'string', ['length' => 10, 'notnull' => false]);
        $devisTable->addColumn('email', 'string', ['length' => 255, 'notnull' => false]);
        $devisTable->addColumn('telephone', 'string', ['length' => 20, 'notnull' => false]);
        $devisTable->addColumn('statut', 'string', ['length' => 255, 'notnull' => false, 'default' => 'nouveau']);
        $devisTable->addColumn('notes', 'text', ['notnull' => false]);
        $devisTable->addColumn('created_at', 'datetime', ['notnull' => false]);
        $devisTable->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $devisTable->setPrimaryKey(['id']);
        $devisTable->addIndex(['nom', 'prenom'], null);
        $devisTable->addIndex(['email'], null);
        $devisTable->addIndex(['statut'], null);
        $devisTable->addIndex(['created_at'], null);

        // devis_reponses table
        $reponsesTable = $schema->createTable('devis_reponses');
        $reponsesTable->addColumn('id', 'integer', ['autoincrement' => true]);
        $reponsesTable->addColumn('devis_id', 'integer', ['notnull' => false]);
        $reponsesTable->addColumn('compagnie', 'string', ['length' => 255]);
        $reponsesTable->addColumn('type_garantie', 'string', ['length' => 255, 'notnull' => false]);
        $reponsesTable->addColumn('prime_annuelle', 'decimal', ['precision' => 10, 'scale' => 2, 'notnull' => false]);
        $reponsesTable->addColumn('prime_mensuelle', 'decimal', ['precision' => 10, 'scale' => 2, 'notnull' => false]);
        $reponsesTable->addColumn('garanties', 'text', ['notnull' => false]);
        $reponsesTable->addColumn('franchise', 'string', ['length' => 255, 'notnull' => false]);
        $reponsesTable->addColumn('delai_carence_mois', 'integer', ['notnull' => false]);
        $reponsesTable->addColumn('conditions_particulieres', 'text', ['notnull' => false]);
        $reponsesTable->addColumn('created_at', 'datetime', ['notnull' => false]);
        $reponsesTable->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $reponsesTable->setPrimaryKey(['id']);
        $reponsesTable->addForeignKeyConstraint('devis', ['devis_id'], ['id'], ['onDelete' => 'CASCADE']);

        // garage_devis table (same as devis but without code_postal and activite)
        $garageTable = $schema->createTable('garage_devis');
        $garageTable->addColumn('id', 'integer', ['autoincrement' => true]);
        $garageTable->addColumn('nom', 'string', ['length' => 255]);
        $garageTable->addColumn('prenom', 'string', ['length' => 255]);
        $garageTable->addColumn('raison_sociale', 'string', ['length' => 255, 'notnull' => false]);
        $garageTable->addColumn('demarrage', 'string', ['length' => 3, 'notnull' => false]);
        $garageTable->addColumn('assure', 'string', ['length' => 3, 'notnull' => false]);
        $garageTable->addColumn('ancienne', 'string', ['length' => 3, 'notnull' => false]);
        $garageTable->addColumn('motif_resiliation', 'string', ['length' => 255, 'notnull' => false]);
        $garageTable->addColumn('email', 'string', ['length' => 255, 'notnull' => false]);
        $garageTable->addColumn('telephone', 'string', ['length' => 20, 'notnull' => false]);
        $garageTable->addColumn('statut', 'string', ['length' => 255, 'notnull' => false, 'default' => 'nouveau']);
        $garageTable->addColumn('notes', 'text', ['notnull' => false]);
        $garageTable->addColumn('created_at', 'datetime', ['notnull' => false]);
        $garageTable->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $garageTable->setPrimaryKey(['id']);
        $garageTable->addIndex(['nom', 'prenom'], null);
        $garageTable->addIndex(['email'], null);
        $garageTable->addIndex(['statut'], null);
        $garageTable->addIndex(['created_at'], null);

        // loueur_devis table (same as garage_devis)
        $loueurTable = $schema->createTable('loueur_devis');
        $loueurTable->addColumn('id', 'integer', ['autoincrement' => true]);
        $loueurTable->addColumn('nom', 'string', ['length' => 255]);
        $loueurTable->addColumn('prenom', 'string', ['length' => 255]);
        $loueurTable->addColumn('raison_sociale', 'string', ['length' => 255, 'notnull' => false]);
        $loueurTable->addColumn('demarrage', 'string', ['length' => 3, 'notnull' => false]);
        $loueurTable->addColumn('assure', 'string', ['length' => 3, 'notnull' => false]);
        $loueurTable->addColumn('ancienne', 'string', ['length' => 3, 'notnull' => false]);
        $loueurTable->addColumn('motif_resiliation', 'string', ['length' => 255, 'notnull' => false]);
        $loueurTable->addColumn('email', 'string', ['length' => 255, 'notnull' => false]);
        $loueurTable->addColumn('telephone', 'string', ['length' => 20, 'notnull' => false]);
        $loueurTable->addColumn('statut', 'string', ['length' => 255, 'notnull' => false, 'default' => 'nouveau']);
        $loueurTable->addColumn('notes', 'text', ['notnull' => false]);
        $loueurTable->addColumn('created_at', 'datetime', ['notnull' => false]);
        $loueurTable->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $loueurTable->setPrimaryKey(['id']);
        $loueurTable->addIndex(['nom', 'prenom'], null);
        $loueurTable->addIndex(['email'], null);
        $loueurTable->addIndex(['statut'], null);
        $loueurTable->addIndex(['created_at'], null);

        // negociants_devis table (same as garage_devis)
        $negociantsTable = $schema->createTable('negociants_devis');
        $negociantsTable->addColumn('id', 'integer', ['autoincrement' => true]);
        $negociantsTable->addColumn('nom', 'string', ['length' => 255]);
        $negociantsTable->addColumn('prenom', 'string', ['length' => 255]);
        $negociantsTable->addColumn('raison_sociale', 'string', ['length' => 255, 'notnull' => false]);
        $negociantsTable->addColumn('demarrage', 'string', ['length' => 3, 'notnull' => false]);
        $negociantsTable->addColumn('assure', 'string', ['length' => 3, 'notnull' => false]);
        $negociantsTable->addColumn('ancienne', 'string', ['length' => 3, 'notnull' => false]);
        $negociantsTable->addColumn('motif_resiliation', 'string', ['length' => 255, 'notnull' => false]);
        $negociantsTable->addColumn('email', 'string', ['length' => 255, 'notnull' => false]);
        $negociantsTable->addColumn('telephone', 'string', ['length' => 20, 'notnull' => false]);
        $negociantsTable->addColumn('statut', 'string', ['length' => 255, 'notnull' => false, 'default' => 'nouveau']);
        $negociantsTable->addColumn('notes', 'text', ['notnull' => false]);
        $negociantsTable->addColumn('created_at', 'datetime', ['notnull' => false]);
        $negociantsTable->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $negociantsTable->setPrimaryKey(['id']);
        $negociantsTable->addIndex(['nom', 'prenom'], null);
        $negociantsTable->addIndex(['email'], null);
        $negociantsTable->addIndex(['statut'], null);
        $negociantsTable->addIndex(['created_at'], null);

        // auto_ecole_devis table (same as garage_devis)
        $autoecoleTable = $schema->createTable('auto_ecole_devis');
        $autoecoleTable->addColumn('id', 'integer', ['autoincrement' => true]);
        $autoecoleTable->addColumn('nom', 'string', ['length' => 255]);
        $autoecoleTable->addColumn('prenom', 'string', ['length' => 255]);
        $autoecoleTable->addColumn('raison_sociale', 'string', ['length' => 255, 'notnull' => false]);
        $autoecoleTable->addColumn('demarrage', 'string', ['length' => 3, 'notnull' => false]);
        $autoecoleTable->addColumn('assure', 'string', ['length' => 3, 'notnull' => false]);
        $autoecoleTable->addColumn('ancienne', 'string', ['length' => 3, 'notnull' => false]);
        $autoecoleTable->addColumn('motif_resiliation', 'string', ['length' => 255, 'notnull' => false]);
        $autoecoleTable->addColumn('email', 'string', ['length' => 255, 'notnull' => false]);
        $autoecoleTable->addColumn('telephone', 'string', ['length' => 20, 'notnull' => false]);
        $autoecoleTable->addColumn('statut', 'string', ['length' => 255, 'notnull' => false, 'default' => 'nouveau']);
        $autoecoleTable->addColumn('notes', 'text', ['notnull' => false]);
        $autoecoleTable->addColumn('created_at', 'datetime', ['notnull' => false]);
        $autoecoleTable->addColumn('updated_at', 'datetime', ['notnull' => false]);
        $autoecoleTable->setPrimaryKey(['id']);
        $autoecoleTable->addIndex(['nom', 'prenom'], null);
        $autoecoleTable->addIndex(['email'], null);
        $autoecoleTable->addIndex(['statut'], null);
        $autoecoleTable->addIndex(['created_at'], null);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('devis_reponses');
        $schema->dropTable('auto_ecole_devis');
        $schema->dropTable('negociants_devis');
        $schema->dropTable('loueur_devis');
        $schema->dropTable('garage_devis');
        $schema->dropTable('devis');
    }
}