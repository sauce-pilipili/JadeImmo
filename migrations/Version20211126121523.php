<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211126121523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168EC190172');
        $this->addSql('DROP INDEX IDX_BFDD3168EC190172 ON articles');
        $this->addSql('ALTER TABLE articles ADD image_en_avant VARCHAR(255) NOT NULL, DROP image_en_avant_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD image_en_avant_id INT DEFAULT NULL, DROP image_en_avant');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168EC190172 FOREIGN KEY (image_en_avant_id) REFERENCES photos (id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168EC190172 ON articles (image_en_avant_id)');
    }
}
