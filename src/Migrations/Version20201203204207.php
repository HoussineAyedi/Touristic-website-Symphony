<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203204207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE circuit (id INT AUTO_INCREMENT NOT NULL, code_circuit VARCHAR(255) NOT NULL, des_circuit VARCHAR(255) NOT NULL, duree INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, code_dest INT NOT NULL, dest_test VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape_cr (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, circuit_id INT NOT NULL, duree INT NOT NULL, ordre INT NOT NULL, INDEX IDX_44B7FF76A73F0036 (ville_id), INDEX IDX_44B7FF76CF2182C8 (circuit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, dest_test_id INT NOT NULL, filename VARCHAR(255) NOT NULL, code_ville INT NOT NULL, des_ville VARCHAR(255) NOT NULL, INDEX IDX_43C3D9C3CE043D6D (dest_test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etape_cr ADD CONSTRAINT FK_44B7FF76A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE etape_cr ADD CONSTRAINT FK_44B7FF76CF2182C8 FOREIGN KEY (circuit_id) REFERENCES circuit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3CE043D6D FOREIGN KEY (dest_test_id) REFERENCES destination (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etape_cr DROP FOREIGN KEY FK_44B7FF76CF2182C8');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3CE043D6D');
        $this->addSql('ALTER TABLE etape_cr DROP FOREIGN KEY FK_44B7FF76A73F0036');
        $this->addSql('DROP TABLE circuit');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE etape_cr');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ville');
    }
}
