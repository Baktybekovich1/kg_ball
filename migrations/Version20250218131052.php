<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250218131052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE liga_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE liga (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE team ADD liga_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FCF098064 FOREIGN KEY (liga_id) REFERENCES liga (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C4E0A61FCF098064 ON team (liga_id)');
        $this->addSql('ALTER TABLE tourney ADD liga_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tourney ADD CONSTRAINT FK_FFF72131CF098064 FOREIGN KEY (liga_id) REFERENCES liga (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FFF72131CF098064 ON tourney (liga_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE team DROP CONSTRAINT FK_C4E0A61FCF098064');
        $this->addSql('ALTER TABLE tourney DROP CONSTRAINT FK_FFF72131CF098064');
        $this->addSql('DROP SEQUENCE liga_id_seq CASCADE');
        $this->addSql('DROP TABLE liga');
        $this->addSql('DROP INDEX IDX_FFF72131CF098064');
        $this->addSql('ALTER TABLE tourney DROP liga_id');
        $this->addSql('DROP INDEX IDX_C4E0A61FCF098064');
        $this->addSql('ALTER TABLE team DROP liga_id');
    }
}
