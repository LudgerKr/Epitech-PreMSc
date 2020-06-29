<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306160144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cart_order');
        $this->addSql('ALTER TABLE cart_article ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart_article ADD CONSTRAINT FK_F9E0C6617294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F9E0C6617294869C ON cart_article (article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cart_order (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cart_article DROP FOREIGN KEY FK_F9E0C6617294869C');
        $this->addSql('DROP INDEX UNIQ_F9E0C6617294869C ON cart_article');
        $this->addSql('ALTER TABLE cart_article DROP article_id');
    }
}
