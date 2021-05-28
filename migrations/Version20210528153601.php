<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210528153601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB9BF396750 FOREIGN KEY (id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B2753CB9BF396750 ON calendrier (id)');
        $this->addSql('ALTER TABLE upload CHANGE nom nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB9BF396750');
        $this->addSql('DROP INDEX UNIQ_B2753CB9BF396750 ON calendrier');
        $this->addSql('ALTER TABLE upload CHANGE nom nom BLOB NOT NULL');
    }
}
