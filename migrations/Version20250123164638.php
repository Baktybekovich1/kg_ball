<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250123164638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE award_for_player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE award_for_team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_award_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE award_for_player (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE award_for_team (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE team_award (id INT NOT NULL, team_id INT DEFAULT NULL, award_for_team_id INT DEFAULT NULL, turney_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4D5D67A7296CD8AE ON team_award (team_id)');
        $this->addSql('CREATE INDEX IDX_4D5D67A7118CB4A5 ON team_award (award_for_team_id)');
        $this->addSql('CREATE INDEX IDX_4D5D67A7381ABDA2 ON team_award (turney_id)');
        $this->addSql('ALTER TABLE team_award ADD CONSTRAINT FK_4D5D67A7296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_award ADD CONSTRAINT FK_4D5D67A7118CB4A5 FOREIGN KEY (award_for_team_id) REFERENCES award_for_team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_award ADD CONSTRAINT FK_4D5D67A7381ABDA2 FOREIGN KEY (turney_id) REFERENCES tourney (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE award_for_player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE award_for_team_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_award_id_seq CASCADE');
        $this->addSql('ALTER TABLE team_award DROP CONSTRAINT FK_4D5D67A7296CD8AE');
        $this->addSql('ALTER TABLE team_award DROP CONSTRAINT FK_4D5D67A7118CB4A5');
        $this->addSql('ALTER TABLE team_award DROP CONSTRAINT FK_4D5D67A7381ABDA2');
        $this->addSql('DROP TABLE award_for_player');
        $this->addSql('DROP TABLE award_for_team');
        $this->addSql('DROP TABLE team_award');
    }
}
