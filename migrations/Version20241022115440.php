<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241022115440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52E591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(255) NOT NULL, ADD activated TINYINT(1) NOT NULL, ADD code INT DEFAULT NULL, ADD uuid VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user_chapter ADD CONSTRAINT FK_A18CAB24A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_chapter ADD CONSTRAINT FK_A18CAB24579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52E591CC992');
        $this->addSql('ALTER TABLE user_chapter DROP FOREIGN KEY FK_A18CAB24A76ED395');
        $this->addSql('ALTER TABLE user_chapter DROP FOREIGN KEY FK_A18CAB24579F4768');
        $this->addSql('ALTER TABLE user DROP email, DROP activated, DROP code, DROP uuid');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B027A76ED395');
    }
}
