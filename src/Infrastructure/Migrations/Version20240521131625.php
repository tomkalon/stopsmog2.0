<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521131625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city ADD map_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B023453C55F64 FOREIGN KEY (map_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B023453C55F64 ON city (map_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B023453C55F64');
        $this->addSql('DROP INDEX UNIQ_2D5B023453C55F64 ON city');
        $this->addSql('ALTER TABLE city DROP map_id');
    }
}
