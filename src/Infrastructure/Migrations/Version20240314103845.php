<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314103845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE sensor ADD sensor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B0A247991F FOREIGN KEY (sensor_id) REFERENCES city (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_BC8617B0A247991F ON sensor (sensor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE city');
        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B0A247991F');
        $this->addSql('DROP INDEX IDX_BC8617B0A247991F ON sensor');
        $this->addSql('ALTER TABLE sensor DROP sensor_id');
    }
}
