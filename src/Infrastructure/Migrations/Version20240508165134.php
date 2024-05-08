<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508165134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file_city (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE file_city ADD CONSTRAINT FK_A4A76A5ABF396750 FOREIGN KEY (id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE city CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE file CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE measurement CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE sensor CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE id id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file_city DROP FOREIGN KEY FK_A4A76A5ABF396750');
        $this->addSql('DROP TABLE file_city');
        $this->addSql('ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE city CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE file CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE measurement CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE sensor CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
