<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211126115307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FEC190172');
        $this->addSql('DROP INDEX IDX_CB988C6FEC190172 ON annonces');
        $this->addSql('ALTER TABLE annonces ADD image_en_avant VARCHAR(255) NOT NULL, DROP image_en_avant_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces ADD image_en_avant_id INT DEFAULT NULL, DROP image_en_avant');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FEC190172 FOREIGN KEY (image_en_avant_id) REFERENCES photos (id)');
        $this->addSql('CREATE INDEX IDX_CB988C6FEC190172 ON annonces (image_en_avant_id)');
    }
}
