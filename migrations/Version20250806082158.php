<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250806082158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE award_for_player_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE month_player_award_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE month_player_award (id INT NOT NULL, bombardier_id INT DEFAULT NULL, assistant_id INT DEFAULT NULL, the_best_id INT DEFAULT NULL, goalkeeper_id INT DEFAULT NULL, defender_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8C7D885B89C46CFA ON month_player_award (bombardier_id)');
        $this->addSql('CREATE INDEX IDX_8C7D885BE05387EF ON month_player_award (assistant_id)');
        $this->addSql('CREATE INDEX IDX_8C7D885BFA81834B ON month_player_award (the_best_id)');
        $this->addSql('CREATE INDEX IDX_8C7D885BE1C697D6 ON month_player_award (goalkeeper_id)');
        $this->addSql('CREATE INDEX IDX_8C7D885B4A3E3B6F ON month_player_award (defender_id)');
        $this->addSql('ALTER TABLE month_player_award ADD CONSTRAINT FK_8C7D885B89C46CFA FOREIGN KEY (bombardier_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE month_player_award ADD CONSTRAINT FK_8C7D885BE05387EF FOREIGN KEY (assistant_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE month_player_award ADD CONSTRAINT FK_8C7D885BFA81834B FOREIGN KEY (the_best_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE month_player_award ADD CONSTRAINT FK_8C7D885BE1C697D6 FOREIGN KEY (goalkeeper_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE month_player_award ADD CONSTRAINT FK_8C7D885B4A3E3B6F FOREIGN KEY (defender_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE award_for_player');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE month_player_award_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE award_for_player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE award_for_player (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE month_player_award DROP CONSTRAINT FK_8C7D885B89C46CFA');
        $this->addSql('ALTER TABLE month_player_award DROP CONSTRAINT FK_8C7D885BE05387EF');
        $this->addSql('ALTER TABLE month_player_award DROP CONSTRAINT FK_8C7D885BFA81834B');
        $this->addSql('ALTER TABLE month_player_award DROP CONSTRAINT FK_8C7D885BE1C697D6');
        $this->addSql('ALTER TABLE month_player_award DROP CONSTRAINT FK_8C7D885B4A3E3B6F');
        $this->addSql('DROP TABLE month_player_award');
    }
}
