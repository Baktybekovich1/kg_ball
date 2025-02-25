<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208060419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tourney_team_prizes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tourney_team_prizes (id INT NOT NULL, first_position_id INT DEFAULT NULL, second_position_id INT DEFAULT NULL, third_position_id INT DEFAULT NULL, tourney_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ACDBB15643712384 ON tourney_team_prizes (first_position_id)');
        $this->addSql('CREATE INDEX IDX_ACDBB156B461B258 ON tourney_team_prizes (second_position_id)');
        $this->addSql('CREATE INDEX IDX_ACDBB1569DEAC5B2 ON tourney_team_prizes (third_position_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ACDBB156ECAE3834 ON tourney_team_prizes (tourney_id)');
        $this->addSql('ALTER TABLE tourney_team_prizes ADD CONSTRAINT FK_ACDBB15643712384 FOREIGN KEY (first_position_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tourney_team_prizes ADD CONSTRAINT FK_ACDBB156B461B258 FOREIGN KEY (second_position_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tourney_team_prizes ADD CONSTRAINT FK_ACDBB1569DEAC5B2 FOREIGN KEY (third_position_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tourney_team_prizes ADD CONSTRAINT FK_ACDBB156ECAE3834 FOREIGN KEY (tourney_id) REFERENCES tourney (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tourney_team_prizes_id_seq CASCADE');
        $this->addSql('ALTER TABLE tourney_team_prizes DROP CONSTRAINT FK_ACDBB15643712384');
        $this->addSql('ALTER TABLE tourney_team_prizes DROP CONSTRAINT FK_ACDBB156B461B258');
        $this->addSql('ALTER TABLE tourney_team_prizes DROP CONSTRAINT FK_ACDBB1569DEAC5B2');
        $this->addSql('ALTER TABLE tourney_team_prizes DROP CONSTRAINT FK_ACDBB156ECAE3834');
        $this->addSql('DROP TABLE tourney_team_prizes');
    }
}
