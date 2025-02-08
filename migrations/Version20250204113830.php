<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204113830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX idx_a1ee878e667d1afe');
        $this->addSql('ALTER TABLE assist ALTER goal_id SET NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A1EE878E667D1AFE ON assist (goal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_A1EE878E667D1AFE');
        $this->addSql('ALTER TABLE assist ALTER goal_id DROP NOT NULL');
        $this->addSql('CREATE INDEX idx_a1ee878e667d1afe ON assist (goal_id)');
    }
}
