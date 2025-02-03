<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250115150258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE test_players_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE assist_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE goal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_of_goal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE assist (id INT NOT NULL, player_id INT DEFAULT NULL, goal_id INT DEFAULT NULL, team_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A1EE878E99E6F5DF ON assist (player_id)');
        $this->addSql('CREATE INDEX IDX_A1EE878E667D1AFE ON assist (goal_id)');
        $this->addSql('CREATE INDEX IDX_A1EE878E296CD8AE ON assist (team_id)');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, team_id INT DEFAULT NULL, opponent_id INT DEFAULT NULL, tourney_id INT DEFAULT NULL, at_home BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232B318C296CD8AE ON game (team_id)');
        $this->addSql('CREATE INDEX IDX_232B318C7F656CDC ON game (opponent_id)');
        $this->addSql('CREATE INDEX IDX_232B318CECAE3834 ON game (tourney_id)');
        $this->addSql('CREATE TABLE goal (id INT NOT NULL, player_id INT NOT NULL, game_id INT DEFAULT NULL, team_id INT DEFAULT NULL, type_of_goal_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FCDCEB2E99E6F5DF ON goal (player_id)');
        $this->addSql('CREATE INDEX IDX_FCDCEB2EE48FD905 ON goal (game_id)');
        $this->addSql('CREATE INDEX IDX_FCDCEB2E296CD8AE ON goal (team_id)');
        $this->addSql('CREATE INDEX IDX_FCDCEB2E860B3D6A ON goal (type_of_goal_id)');
        $this->addSql('CREATE TABLE type_of_goal (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE assist ADD CONSTRAINT FK_A1EE878E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assist ADD CONSTRAINT FK_A1EE878E667D1AFE FOREIGN KEY (goal_id) REFERENCES goal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assist ADD CONSTRAINT FK_A1EE878E296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C7F656CDC FOREIGN KEY (opponent_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CECAE3834 FOREIGN KEY (tourney_id) REFERENCES tourney (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2EE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E860B3D6A FOREIGN KEY (type_of_goal_id) REFERENCES type_of_goal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE test_players');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE assist_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE goal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_of_goal_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE test_players_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE test_players (id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, age INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE assist DROP CONSTRAINT FK_A1EE878E99E6F5DF');
        $this->addSql('ALTER TABLE assist DROP CONSTRAINT FK_A1EE878E667D1AFE');
        $this->addSql('ALTER TABLE assist DROP CONSTRAINT FK_A1EE878E296CD8AE');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C296CD8AE');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C7F656CDC');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318CECAE3834');
        $this->addSql('ALTER TABLE goal DROP CONSTRAINT FK_FCDCEB2E99E6F5DF');
        $this->addSql('ALTER TABLE goal DROP CONSTRAINT FK_FCDCEB2EE48FD905');
        $this->addSql('ALTER TABLE goal DROP CONSTRAINT FK_FCDCEB2E296CD8AE');
        $this->addSql('ALTER TABLE goal DROP CONSTRAINT FK_FCDCEB2E860B3D6A');
        $this->addSql('DROP TABLE assist');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE goal');
        $this->addSql('DROP TABLE type_of_goal');
    }
}
