<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206115219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assist ADD vs_team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assist ADD CONSTRAINT FK_A1EE878EE9F58403 FOREIGN KEY (vs_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A1EE878EE9F58403 ON assist (vs_team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE assist DROP CONSTRAINT FK_A1EE878EE9F58403');
        $this->addSql('DROP INDEX IDX_A1EE878EE9F58403');
        $this->addSql('ALTER TABLE assist DROP vs_team_id');
    }
}
