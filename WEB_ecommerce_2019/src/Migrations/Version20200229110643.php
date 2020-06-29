<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200229110643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE method_payment_type (id INT AUTO_INCREMENT NOT NULL, method_payment_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A3C5F395BDBC7A54 (method_payment_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE method_payment (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, information LONGTEXT DEFAULT NULL, INDEX IDX_693A17429D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE method_payment_type ADD CONSTRAINT FK_A3C5F395BDBC7A54 FOREIGN KEY (method_payment_id_id) REFERENCES method_payment (id)');
        $this->addSql('ALTER TABLE method_payment ADD CONSTRAINT FK_693A17429D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE method_payment_type DROP FOREIGN KEY FK_A3C5F395BDBC7A54');
        $this->addSql('DROP TABLE method_payment_type');
        $this->addSql('DROP TABLE method_payment');
    }
}
