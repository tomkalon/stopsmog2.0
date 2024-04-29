<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314124254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B0A247991F');
        $this->addSql('DROP INDEX IDX_BC8617B0A247991F ON sensor');
        $this->addSql('ALTER TABLE sensor CHANGE sensor_id city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B08BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_BC8617B08BAC62AF ON sensor (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sensor DROP FOREIGN KEY FK_BC8617B08BAC62AF');
        $this->addSql('DROP INDEX IDX_BC8617B08BAC62AF ON sensor');
        $this->addSql('ALTER TABLE sensor CHANGE city_id sensor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B0A247991F FOREIGN KEY (sensor_id) REFERENCES city (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_BC8617B0A247991F ON sensor (sensor_id)');
    }
}
