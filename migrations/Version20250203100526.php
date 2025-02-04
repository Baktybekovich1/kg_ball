<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250203100526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP CONSTRAINT fk_232b318c9c4c13f6');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT fk_232b318c45185d02');
        $this->addSql('DROP INDEX idx_232b318c45185d02');
        $this->addSql('DROP INDEX idx_232b318c9c4c13f6');
        $this->addSql('ALTER TABLE game ADD winner_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD loser_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game DROP home_team_id');
        $this->addSql('ALTER TABLE game DROP away_team_id');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CC5237001 FOREIGN KEY (winner_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C77A62071 FOREIGN KEY (loser_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_232B318CC5237001 ON game (winner_team_id)');
        $this->addSql('CREATE INDEX IDX_232B318C77A62071 ON game (loser_team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318CC5237001');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C77A62071');
        $this->addSql('DROP INDEX IDX_232B318CC5237001');
        $this->addSql('DROP INDEX IDX_232B318C77A62071');
        $this->addSql('ALTER TABLE game ADD home_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD away_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game DROP winner_team_id');
        $this->addSql('ALTER TABLE game DROP loser_team_id');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT fk_232b318c9c4c13f6 FOREIGN KEY (home_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT fk_232b318c45185d02 FOREIGN KEY (away_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_232b318c45185d02 ON game (away_team_id)');
        $this->addSql('CREATE INDEX idx_232b318c9c4c13f6 ON game (home_team_id)');
    }
}
