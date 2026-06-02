<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add missing code_postal column to specific devis tables
 */
final class Version20260602184000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add missing code_postal column to garage_devis, loueur_devis, negociants_devis, and auto_ecole_devis tables';
    }

    public function up(Schema $schema): void
    {
        // Add code_postal column to garage_devis table
        $garageTable = $schema->getTable('garage_devis');
        if (!$garageTable->hasColumn('code_postal')) {
            $garageTable->addColumn('code_postal', 'string', ['length' => 10, 'notnull' => false]);
        }

        // Add code_postal column to loueur_devis table
        $loueurTable = $schema->getTable('loueur_devis');
        if (!$loueurTable->hasColumn('code_postal')) {
            $loueurTable->addColumn('code_postal', 'string', ['length' => 10, 'notnull' => false]);
        }

        // Add code_postal column to negociants_devis table
        $negociantsTable = $schema->getTable('negociants_devis');
        if (!$negociantsTable->hasColumn('code_postal')) {
            $negociantsTable->addColumn('code_postal', 'string', ['length' => 10, 'notnull' => false]);
        }

        // Add code_postal column to auto_ecole_devis table
        $autoecoleTable = $schema->getTable('auto_ecole_devis');
        if (!$autoecoleTable->hasColumn('code_postal')) {
            $autoecoleTable->addColumn('code_postal', 'string', ['length' => 10, 'notnull' => false]);
        }
    }

    public function down(Schema $schema): void
    {
        // Remove code_postal column from garage_devis table
        $garageTable = $schema->getTable('garage_devis');
        if ($garageTable->hasColumn('code_postal')) {
            $garageTable->dropColumn('code_postal');
        }

        // Remove code_postal column from loueur_devis table
        $loueurTable = $schema->getTable('loueur_devis');
        if ($loueurTable->hasColumn('code_postal')) {
            $loueurTable->dropColumn('code_postal');
        }

        // Remove code_postal column from negociants_devis table
        $negociantsTable = $schema->getTable('negociants_devis');
        if ($negociantsTable->hasColumn('code_postal')) {
            $negociantsTable->dropColumn('code_postal');
        }

        // Remove code_postal column from auto_ecole_devis table
        $autoecoleTable = $schema->getTable('auto_ecole_devis');
        if ($autoecoleTable->hasColumn('code_postal')) {
            $autoecoleTable->dropColumn('code_postal');
        }
    }
}