<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831073741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_assignment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assignment ADD type_assignment_id INT NOT NULL');
        $this->addSql('ALTER TABLE assignment ADD CONSTRAINT FK_30C544BAA17EB5CD FOREIGN KEY (type_assignment_id) REFERENCES type_assignment (id)');
        $this->addSql('CREATE INDEX IDX_30C544BAA17EB5CD ON assignment (type_assignment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assignment DROP FOREIGN KEY FK_30C544BAA17EB5CD');
        $this->addSql('DROP TABLE type_assignment');
        $this->addSql('DROP INDEX IDX_30C544BAA17EB5CD ON assignment');
        $this->addSql('ALTER TABLE assignment DROP type_assignment_id');
    }
}
