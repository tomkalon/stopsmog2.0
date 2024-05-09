<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509211031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file (name VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE settings ADD map_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE settings ADD CONSTRAINT FK_E545A0C55F57134A FOREIGN KEY (map_image_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E545A0C55F57134A ON settings (map_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE file');
        $this->addSql('ALTER TABLE settings DROP FOREIGN KEY FK_E545A0C55F57134A');
        $this->addSql('DROP INDEX UNIQ_E545A0C55F57134A ON settings');
        $this->addSql('ALTER TABLE settings DROP map_image_id');
    }
}
