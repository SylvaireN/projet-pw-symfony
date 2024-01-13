<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240113092833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mail_edus (id INT AUTO_INCREMENT NOT NULL, educateurid_id INT DEFAULT NULL, datenvoi DATE NOT NULL, objet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_545D858D28ED47D2 (educateurid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mail_edus ADD CONSTRAINT FK_545D858D28ED47D2 FOREIGN KEY (educateurid_id) REFERENCES educateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mail_edus DROP FOREIGN KEY FK_545D858D28ED47D2');
        $this->addSql('DROP TABLE mail_edus');
    }
}
