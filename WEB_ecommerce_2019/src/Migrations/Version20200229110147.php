<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200229110147 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE discount (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, article_id_id INT DEFAULT NULL, value INT NOT NULL, begin_at DATETIME NOT NULL, end_at DATETIME NOT NULL, reduction_type NUMERIC(10, 0) NOT NULL, INDEX IDX_E1E0B40E9D86650F (user_id_id), INDEX IDX_E1E0B40E8F3EC46 (article_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE discount ADD CONSTRAINT FK_E1E0B40E9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE discount ADD CONSTRAINT FK_E1E0B40E8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE discount');
    }
}
