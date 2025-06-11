<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250611081619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE test_api_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE test_api (id INT NOT NULL, ls VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, bottle_q VARCHAR(255) DEFAULT NULL, sum INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE tourney_player_prizes DROP CONSTRAINT fk_b57380d55a22efd0');
        $this->addSql('DROP INDEX idx_b57380d55a22efd0');
        $this->addSql('ALTER TABLE tourney_player_prizes RENAME COLUMN ethe_best_id TO the_best_id');
        $this->addSql('ALTER TABLE tourney_player_prizes ADD CONSTRAINT FK_B57380D5FA81834B FOREIGN KEY (the_best_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B57380D5FA81834B ON tourney_player_prizes (the_best_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE test_api_id_seq CASCADE');
        $this->addSql('DROP TABLE test_api');
        $this->addSql('ALTER TABLE tourney_player_prizes DROP CONSTRAINT FK_B57380D5FA81834B');
        $this->addSql('DROP INDEX IDX_B57380D5FA81834B');
        $this->addSql('ALTER TABLE tourney_player_prizes RENAME COLUMN the_best_id TO ethe_best_id');
        $this->addSql('ALTER TABLE tourney_player_prizes ADD CONSTRAINT fk_b57380d55a22efd0 FOREIGN KEY (ethe_best_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_b57380d55a22efd0 ON tourney_player_prizes (ethe_best_id)');
    }
}
