<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831001143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE teacher_teaching_assignment (teacher_id INT NOT NULL, teaching_assignment_id INT NOT NULL, INDEX IDX_B1CE7FFA41807E1D (teacher_id), INDEX IDX_B1CE7FFAFE505E2C (teaching_assignment_id), PRIMARY KEY(teacher_id, teaching_assignment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE teacher_teaching_assignment ADD CONSTRAINT FK_B1CE7FFA41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_teaching_assignment ADD CONSTRAINT FK_B1CE7FFAFE505E2C FOREIGN KEY (teaching_assignment_id) REFERENCES teaching_assignment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5FE505E2C');
        $this->addSql('DROP INDEX IDX_B0F6A6D5FE505E2C ON teacher');
        $this->addSql('ALTER TABLE teacher DROP teaching_assignment_id');
        $this->addSql('ALTER TABLE teaching_assignment ADD teacher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teaching_assignment ADD CONSTRAINT FK_93BFC67E41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('CREATE INDEX IDX_93BFC67E41807E1D ON teaching_assignment (teacher_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher_teaching_assignment DROP FOREIGN KEY FK_B1CE7FFA41807E1D');
        $this->addSql('ALTER TABLE teacher_teaching_assignment DROP FOREIGN KEY FK_B1CE7FFAFE505E2C');
        $this->addSql('DROP TABLE teacher_teaching_assignment');
        $this->addSql('ALTER TABLE teacher ADD teaching_assignment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5FE505E2C FOREIGN KEY (teaching_assignment_id) REFERENCES teaching_assignment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B0F6A6D5FE505E2C ON teacher (teaching_assignment_id)');
        $this->addSql('ALTER TABLE teaching_assignment DROP FOREIGN KEY FK_93BFC67E41807E1D');
        $this->addSql('DROP INDEX IDX_93BFC67E41807E1D ON teaching_assignment');
        $this->addSql('ALTER TABLE teaching_assignment DROP teacher_id');
    }
}
