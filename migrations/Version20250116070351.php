<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116070351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP CONSTRAINT fk_232b318c296cd8ae');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT fk_232b318c7f656cdc');
        $this->addSql('DROP INDEX idx_232b318c7f656cdc');
        $this->addSql('DROP INDEX idx_232b318c296cd8ae');
        $this->addSql('ALTER TABLE game ADD home_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD away_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game DROP team_id');
        $this->addSql('ALTER TABLE game DROP opponent_id');
        $this->addSql('ALTER TABLE game DROP at_home');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9C4C13F6 FOREIGN KEY (home_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C45185D02 FOREIGN KEY (away_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_232B318C9C4C13F6 ON game (home_team_id)');
        $this->addSql('CREATE INDEX IDX_232B318C45185D02 ON game (away_team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C9C4C13F6');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C45185D02');
        $this->addSql('DROP INDEX IDX_232B318C9C4C13F6');
        $this->addSql('DROP INDEX IDX_232B318C45185D02');
        $this->addSql('ALTER TABLE game ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD opponent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD at_home BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE game DROP home_team_id');
        $this->addSql('ALTER TABLE game DROP away_team_id');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT fk_232b318c296cd8ae FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT fk_232b318c7f656cdc FOREIGN KEY (opponent_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_232b318c7f656cdc ON game (opponent_id)');
        $this->addSql('CREATE INDEX idx_232b318c296cd8ae ON game (team_id)');
    }
}
