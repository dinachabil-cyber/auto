<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add missing activite column to specific devis tables
 */
final class Version20260602183409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add missing activite column to garage_devis, loueur_devis, negociants_devis, and auto_ecole_devis tables';
    }

    public function up(Schema $schema): void
    {
        // Add activite column to garage_devis table
        $garageTable = $schema->getTable('garage_devis');
        if (!$garageTable->hasColumn('activite')) {
            $garageTable->addColumn('activite', 'string', ['length' => 255, 'notnull' => false]);
        }

        // Add activite column to loueur_devis table
        $loueurTable = $schema->getTable('loueur_devis');
        if (!$loueurTable->hasColumn('activite')) {
            $loueurTable->addColumn('activite', 'string', ['length' => 255, 'notnull' => false]);
        }

        // Add activite column to negociants_devis table
        $negociantsTable = $schema->getTable('negociants_devis');
        if (!$negociantsTable->hasColumn('activite')) {
            $negociantsTable->addColumn('activite', 'string', ['length' => 255, 'notnull' => false]);
        }

        // Add activite column to auto_ecole_devis table
        $autoecoleTable = $schema->getTable('auto_ecole_devis');
        if (!$autoecoleTable->hasColumn('activite')) {
            $autoecoleTable->addColumn('activite', 'string', ['length' => 255, 'notnull' => false]);
        }
    }

    public function down(Schema $schema): void
    {
        // Remove activite column from garage_devis table
        $garageTable = $schema->getTable('garage_devis');
        if ($garageTable->hasColumn('activite')) {
            $garageTable->dropColumn('activite');
        }

        // Remove activite column from loueur_devis table
        $loueurTable = $schema->getTable('loueur_devis');
        if ($loueurTable->hasColumn('activite')) {
            $loueurTable->dropColumn('activite');
        }

        // Remove activite column from negociants_devis table
        $negociantsTable = $schema->getTable('negociants_devis');
        if ($negociantsTable->hasColumn('activite')) {
            $negociantsTable->dropColumn('activite');
        }

        // Remove activite column from auto_ecole_devis table
        $autoecoleTable = $schema->getTable('auto_ecole_devis');
        if ($autoecoleTable->hasColumn('activite')) {
            $autoecoleTable->dropColumn('activite');
        }
    }
}