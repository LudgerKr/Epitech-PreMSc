<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305170057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E661AD5CDBF');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_content (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, command_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_8BF99E27294869C (article_id), INDEX IDX_8BF99E233E1689A (command_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_adress (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, adress1 LONGTEXT DEFAULT NULL, adress2 LONGTEXT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_39BEDC83A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_content ADD CONSTRAINT FK_8BF99E27294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE order_content ADD CONSTRAINT FK_8BF99E233E1689A FOREIGN KEY (command_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE user_adress ADD CONSTRAINT FK_39BEDC83A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP INDEX IDX_23A0E661AD5CDBF ON article');
        $this->addSql('ALTER TABLE article DROP cart_id, CHANGE category_id category_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_content DROP FOREIGN KEY FK_8BF99E233E1689A');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, INDEX IDX_BA388B79D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_content');
        $this->addSql('DROP TABLE user_adress');
        $this->addSql('ALTER TABLE article ADD cart_id INT DEFAULT NULL, CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_23A0E661AD5CDBF ON article (cart_id)');
    }
}
