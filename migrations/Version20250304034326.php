<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304034326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE award_for_team_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_award_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON "user" (username)');
        $this->addSql('ALTER TABLE team_award DROP CONSTRAINT fk_4d5d67a7296cd8ae');
        $this->addSql('ALTER TABLE team_award DROP CONSTRAINT fk_4d5d67a7118cb4a5');
        $this->addSql('ALTER TABLE team_award DROP CONSTRAINT fk_4d5d67a7ecae3834');
        $this->addSql('DROP TABLE team_award');
        $this->addSql('DROP TABLE award_for_team');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE award_for_team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_award_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE team_award (id INT NOT NULL, team_id INT DEFAULT NULL, award_for_team_id INT DEFAULT NULL, tourney_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_4d5d67a7ecae3834 ON team_award (tourney_id)');
        $this->addSql('CREATE INDEX idx_4d5d67a7118cb4a5 ON team_award (award_for_team_id)');
        $this->addSql('CREATE INDEX idx_4d5d67a7296cd8ae ON team_award (team_id)');
        $this->addSql('CREATE TABLE award_for_team (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE team_award ADD CONSTRAINT fk_4d5d67a7296cd8ae FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_award ADD CONSTRAINT fk_4d5d67a7118cb4a5 FOREIGN KEY (award_for_team_id) REFERENCES award_for_team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_award ADD CONSTRAINT fk_4d5d67a7ecae3834 FOREIGN KEY (tourney_id) REFERENCES tourney (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "user"');
    }
}
