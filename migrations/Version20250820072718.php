<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250820072718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE month_team_award_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE months_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE month_team_award (id INT NOT NULL, month_id INT DEFAULT NULL, best_team_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9CC2F28BA0CBDE4 ON month_team_award (month_id)');
        $this->addSql('CREATE INDEX IDX_9CC2F28B1608447A ON month_team_award (best_team_id)');
        $this->addSql('CREATE TABLE months (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, start_date VARCHAR(255) NOT NULL, end_date VARCHAR(255) NOT NULL, year INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE month_team_award ADD CONSTRAINT FK_9CC2F28BA0CBDE4 FOREIGN KEY (month_id) REFERENCES months (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE month_team_award ADD CONSTRAINT FK_9CC2F28B1608447A FOREIGN KEY (best_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE month_player_award ADD month_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE month_player_award DROP name');
        $this->addSql('ALTER TABLE month_player_award DROP start_date');
        $this->addSql('ALTER TABLE month_player_award DROP end_date');
        $this->addSql('ALTER TABLE month_player_award ADD CONSTRAINT FK_8C7D885BA0CBDE4 FOREIGN KEY (month_id) REFERENCES months (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8C7D885BA0CBDE4 ON month_player_award (month_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE month_player_award DROP CONSTRAINT FK_8C7D885BA0CBDE4');
        $this->addSql('DROP SEQUENCE month_team_award_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE months_id_seq CASCADE');
        $this->addSql('ALTER TABLE month_team_award DROP CONSTRAINT FK_9CC2F28BA0CBDE4');
        $this->addSql('ALTER TABLE month_team_award DROP CONSTRAINT FK_9CC2F28B1608447A');
        $this->addSql('DROP TABLE month_team_award');
        $this->addSql('DROP TABLE months');
        $this->addSql('DROP INDEX IDX_8C7D885BA0CBDE4');
        $this->addSql('ALTER TABLE month_player_award ADD name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE month_player_award ADD start_date VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE month_player_award ADD end_date VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE month_player_award DROP month_id');
    }
}
