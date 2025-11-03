<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251103143051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make description field nullable in sensor table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sensor CHANGE description description VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sensor CHANGE description description VARCHAR(255) NOT NULL');
    }
}
