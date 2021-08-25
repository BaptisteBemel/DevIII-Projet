<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824140550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB97F449E57');
        $this->addSql('DROP INDEX IDX_B2753CB97F449E57 ON calendrier');
        $this->addSql('ALTER TABLE calendrier CHANGE id_id id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB9BF396750 FOREIGN KEY (id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B2753CB9BF396750 ON calendrier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB9BF396750');
        $this->addSql('DROP INDEX IDX_B2753CB9BF396750 ON calendrier');
        $this->addSql('ALTER TABLE calendrier CHANGE id id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB97F449E57 FOREIGN KEY (id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B2753CB97F449E57 ON calendrier (id_id)');
    }
}
