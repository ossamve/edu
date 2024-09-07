<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240830153059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE teaching_assignment (id INT AUTO_INCREMENT NOT NULL, cours_id INT DEFAULT NULL, room_id INT DEFAULT NULL, INDEX IDX_93BFC67E7ECF78B0 (cours_id), INDEX IDX_93BFC67E54177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE teaching_assignment ADD CONSTRAINT FK_93BFC67E7ECF78B0 FOREIGN KEY (cours_id) REFERENCES courses (id)');
        $this->addSql('ALTER TABLE teaching_assignment ADD CONSTRAINT FK_93BFC67E54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE courses DROP coef');
        $this->addSql('ALTER TABLE teacher ADD teaching_assignment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5FE505E2C FOREIGN KEY (teaching_assignment_id) REFERENCES teaching_assignment (id)');
        $this->addSql('CREATE INDEX IDX_B0F6A6D5FE505E2C ON teacher (teaching_assignment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5FE505E2C');
        $this->addSql('ALTER TABLE teaching_assignment DROP FOREIGN KEY FK_93BFC67E7ECF78B0');
        $this->addSql('ALTER TABLE teaching_assignment DROP FOREIGN KEY FK_93BFC67E54177093');
        $this->addSql('DROP TABLE teaching_assignment');
        $this->addSql('ALTER TABLE courses ADD coef INT NOT NULL');
        $this->addSql('DROP INDEX IDX_B0F6A6D5FE505E2C ON teacher');
        $this->addSql('ALTER TABLE teacher DROP teaching_assignment_id');
    }
}
