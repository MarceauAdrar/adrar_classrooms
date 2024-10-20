<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241003172434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concessionnaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(75) NOT NULL, groupe VARCHAR(255) NOT NULL, adresse_numero INT NOT NULL, adresse_rue VARCHAR(150) NOT NULL, adresse_ville VARCHAR(100) NOT NULL, adresse_cp VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, couleur VARCHAR(6) NOT NULL, marque VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule_concessionnaire (id INT AUTO_INCREMENT NOT NULL, concessionnaire_id INT NOT NULL, vehicule_id INT NOT NULL, INDEX IDX_63C6B5278740E698 (concessionnaire_id), INDEX IDX_63C6B5274A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicule_concessionnaire ADD CONSTRAINT FK_63C6B5278740E698 FOREIGN KEY (concessionnaire_id) REFERENCES concessionnaire (id)');
        $this->addSql('ALTER TABLE vehicule_concessionnaire ADD CONSTRAINT FK_63C6B5274A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicule_concessionnaire DROP FOREIGN KEY FK_63C6B5278740E698');
        $this->addSql('ALTER TABLE vehicule_concessionnaire DROP FOREIGN KEY FK_63C6B5274A4A3511');
        $this->addSql('DROP TABLE concessionnaire');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE vehicule_concessionnaire');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
