<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250605085120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tourney_player_prizes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tourney_player_prizes (id INT NOT NULL, tourney_id INT DEFAULT NULL, bombardier_id INT DEFAULT NULL, assistant_id INT DEFAULT NULL, ethe_best_id INT NOT NULL, goalkeeper_id INT DEFAULT NULL, defender_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B57380D5ECAE3834 ON tourney_player_prizes (tourney_id)');
        $this->addSql('CREATE INDEX IDX_B57380D589C46CFA ON tourney_player_prizes (bombardier_id)');
        $this->addSql('CREATE INDEX IDX_B57380D5E05387EF ON tourney_player_prizes (assistant_id)');
        $this->addSql('CREATE INDEX IDX_B57380D55A22EFD0 ON tourney_player_prizes (ethe_best_id)');
        $this->addSql('CREATE INDEX IDX_B57380D5E1C697D6 ON tourney_player_prizes (goalkeeper_id)');
        $this->addSql('CREATE INDEX IDX_B57380D54A3E3B6F ON tourney_player_prizes (defender_id)');
        $this->addSql('ALTER TABLE tourney_player_prizes ADD CONSTRAINT FK_B57380D5ECAE3834 FOREIGN KEY (tourney_id) REFERENCES tourney (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tourney_player_prizes ADD CONSTRAINT FK_B57380D589C46CFA FOREIGN KEY (bombardier_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tourney_player_prizes ADD CONSTRAINT FK_B57380D5E05387EF FOREIGN KEY (assistant_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tourney_player_prizes ADD CONSTRAINT FK_B57380D55A22EFD0 FOREIGN KEY (ethe_best_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tourney_player_prizes ADD CONSTRAINT FK_B57380D5E1C697D6 FOREIGN KEY (goalkeeper_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tourney_player_prizes ADD CONSTRAINT FK_B57380D54A3E3B6F FOREIGN KEY (defender_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tourney_player_prizes_id_seq CASCADE');
        $this->addSql('ALTER TABLE tourney_player_prizes DROP CONSTRAINT FK_B57380D5ECAE3834');
        $this->addSql('ALTER TABLE tourney_player_prizes DROP CONSTRAINT FK_B57380D589C46CFA');
        $this->addSql('ALTER TABLE tourney_player_prizes DROP CONSTRAINT FK_B57380D5E05387EF');
        $this->addSql('ALTER TABLE tourney_player_prizes DROP CONSTRAINT FK_B57380D55A22EFD0');
        $this->addSql('ALTER TABLE tourney_player_prizes DROP CONSTRAINT FK_B57380D5E1C697D6');
        $this->addSql('ALTER TABLE tourney_player_prizes DROP CONSTRAINT FK_B57380D54A3E3B6F');
        $this->addSql('DROP TABLE tourney_player_prizes');
    }
}
