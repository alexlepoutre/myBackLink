<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326201621 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE back_link (id INT AUTO_INCREMENT NOT NULL, my_site VARCHAR(255) NOT NULL, his_site VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE back_link_log (id INT AUTO_INCREMENT NOT NULL, back_link_id INT DEFAULT NULL, created_at DATETIME NOT NULL, found_it TINYINT(1) NOT NULL, log_text VARCHAR(255) NOT NULL, INDEX IDX_3990B27E76CEE16F (back_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE back_link_log ADD CONSTRAINT FK_3990B27E76CEE16F FOREIGN KEY (back_link_id) REFERENCES back_link (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE back_link_log DROP FOREIGN KEY FK_3990B27E76CEE16F');
        $this->addSql('DROP TABLE back_link');
        $this->addSql('DROP TABLE back_link_log');
    }
}
