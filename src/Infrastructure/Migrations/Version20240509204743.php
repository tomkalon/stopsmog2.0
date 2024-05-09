<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509204743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file_city (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE file_settings (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE file_city ADD CONSTRAINT FK_A4A76A5ABF396750 FOREIGN KEY (id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file_settings ADD CONSTRAINT FK_54152F58BF396750 FOREIGN KEY (id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE settings ADD map_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE settings ADD CONSTRAINT FK_E545A0C55F57134A FOREIGN KEY (map_image_id) REFERENCES file_settings (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E545A0C55F57134A ON settings (map_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file_city DROP FOREIGN KEY FK_A4A76A5ABF396750');
        $this->addSql('ALTER TABLE file_settings DROP FOREIGN KEY FK_54152F58BF396750');
        $this->addSql('DROP TABLE file_city');
        $this->addSql('DROP TABLE file_settings');
        $this->addSql('ALTER TABLE settings DROP FOREIGN KEY FK_E545A0C55F57134A');
        $this->addSql('DROP INDEX UNIQ_E545A0C55F57134A ON settings');
        $this->addSql('ALTER TABLE settings DROP map_image_id');
    }
}
