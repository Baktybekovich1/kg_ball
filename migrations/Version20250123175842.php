<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250123175842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_award DROP CONSTRAINT fk_4d5d67a7381abda2');
        $this->addSql('DROP INDEX idx_4d5d67a7381abda2');
        $this->addSql('ALTER TABLE team_award RENAME COLUMN turney_id TO tourney_id');
        $this->addSql('ALTER TABLE team_award ADD CONSTRAINT FK_4D5D67A7ECAE3834 FOREIGN KEY (tourney_id) REFERENCES tourney (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4D5D67A7ECAE3834 ON team_award (tourney_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE team_award DROP CONSTRAINT FK_4D5D67A7ECAE3834');
        $this->addSql('DROP INDEX IDX_4D5D67A7ECAE3834');
        $this->addSql('ALTER TABLE team_award RENAME COLUMN tourney_id TO turney_id');
        $this->addSql('ALTER TABLE team_award ADD CONSTRAINT fk_4d5d67a7381abda2 FOREIGN KEY (turney_id) REFERENCES tourney (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_4d5d67a7381abda2 ON team_award (turney_id)');
    }
}
