<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305170537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article ADD weight NUMERIC(4, 0) NOT NULL, ADD height INT NOT NULL, ADD width INT NOT NULL, ADD length INT NOT NULL, ADD stock INT NOT NULL, ADD price NUMERIC(4, 0) NOT NULL, ADD image1 VARCHAR(255) DEFAULT NULL, ADD image2 VARCHAR(255) DEFAULT NULL, ADD image3 VARCHAR(255) DEFAULT NULL, ADD warranty DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, CHANGE image imageMain VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment ADD mark INT NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD created_at DATETIME NOT NULL, ADD state VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD birthdate DATETIME NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP weight, DROP height, DROP width, DROP length, DROP stock, DROP price, DROP image1, DROP image2, DROP image3, DROP warranty, DROP updated_at, CHANGE imagemain image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comment DROP mark, DROP updated_at');
        $this->addSql('ALTER TABLE `order` DROP created_at, DROP state');
        $this->addSql('ALTER TABLE user DROP birthdate, DROP created_at, DROP updated_at');
    }
}
