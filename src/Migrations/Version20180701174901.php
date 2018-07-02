<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180701174901 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE announcements (id INT AUTO_INCREMENT NOT NULL, fk_user_id_id INT NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, size INT NOT NULL, weight INT NOT NULL, quality LONGTEXT NOT NULL, specifications LONGTEXT NOT NULL, image_announcements VARCHAR(255) NOT NULL, INDEX IDX_F422A9D6DE8AF9C (fk_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banner (id INT AUTO_INCREMENT NOT NULL, fk_announcements_id_id INT NOT NULL, fk_cat_add_id_id INT NOT NULL, fk_marketers_id_id INT NOT NULL, description LONGTEXT NOT NULL, image_banner VARCHAR(255) NOT NULL, INDEX IDX_6F9DB8E733D19CDD (fk_announcements_id_id), INDEX IDX_6F9DB8E749EAD93B (fk_cat_add_id_id), INDEX IDX_6F9DB8E79D645BEB (fk_marketers_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cat_add (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cat_announcements (id INT AUTO_INCREMENT NOT NULL, fk_announcements_id_id INT NOT NULL, label VARCHAR(30) NOT NULL, INDEX IDX_83304D9A33D19CDD (fk_announcements_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cat_shop (id INT AUTO_INCREMENT NOT NULL, fk_shop_id_id INT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image_cat_shop VARCHAR(255) DEFAULT NULL, INDEX IDX_B159BB13483C0E96 (fk_shop_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoices (id INT AUTO_INCREMENT NOT NULL, fk_products_id_id INT DEFAULT NULL, fk_user_id_id INT DEFAULT NULL, fk_annoucements_id_id INT DEFAULT NULL, date DATETIME NOT NULL, cost DOUBLE PRECISION NOT NULL, INDEX IDX_6A2F2F95EA13896E (fk_products_id_id), INDEX IDX_6A2F2F956DE8AF9C (fk_user_id_id), INDEX IDX_6A2F2F9559116BF (fk_annoucements_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marketers (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, fk_cat_shop_id_id INT NOT NULL, label VARCHAR(30) NOT NULL, price DOUBLE PRECISION NOT NULL, image_products VARCHAR(255) DEFAULT NULL, INDEX IDX_B3BA5A5A10BE061D (fk_cat_shop_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, fk_user_id_id INT NOT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_AC6A4CA26DE8AF9C (fk_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, username VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(15) NOT NULL, image_user VARCHAR(255) DEFAULT NULL, role VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE announcements ADD CONSTRAINT FK_F422A9D6DE8AF9C FOREIGN KEY (fk_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE banner ADD CONSTRAINT FK_6F9DB8E733D19CDD FOREIGN KEY (fk_announcements_id_id) REFERENCES announcements (id)');
        $this->addSql('ALTER TABLE banner ADD CONSTRAINT FK_6F9DB8E749EAD93B FOREIGN KEY (fk_cat_add_id_id) REFERENCES cat_add (id)');
        $this->addSql('ALTER TABLE banner ADD CONSTRAINT FK_6F9DB8E79D645BEB FOREIGN KEY (fk_marketers_id_id) REFERENCES marketers (id)');
        $this->addSql('ALTER TABLE cat_announcements ADD CONSTRAINT FK_83304D9A33D19CDD FOREIGN KEY (fk_announcements_id_id) REFERENCES announcements (id)');
        $this->addSql('ALTER TABLE cat_shop ADD CONSTRAINT FK_B159BB13483C0E96 FOREIGN KEY (fk_shop_id_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F95EA13896E FOREIGN KEY (fk_products_id_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F956DE8AF9C FOREIGN KEY (fk_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F9559116BF FOREIGN KEY (fk_annoucements_id_id) REFERENCES announcements (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A10BE061D FOREIGN KEY (fk_cat_shop_id_id) REFERENCES cat_shop (id)');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA26DE8AF9C FOREIGN KEY (fk_user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE banner DROP FOREIGN KEY FK_6F9DB8E733D19CDD');
        $this->addSql('ALTER TABLE cat_announcements DROP FOREIGN KEY FK_83304D9A33D19CDD');
        $this->addSql('ALTER TABLE invoices DROP FOREIGN KEY FK_6A2F2F9559116BF');
        $this->addSql('ALTER TABLE banner DROP FOREIGN KEY FK_6F9DB8E749EAD93B');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A10BE061D');
        $this->addSql('ALTER TABLE banner DROP FOREIGN KEY FK_6F9DB8E79D645BEB');
        $this->addSql('ALTER TABLE invoices DROP FOREIGN KEY FK_6A2F2F95EA13896E');
        $this->addSql('ALTER TABLE cat_shop DROP FOREIGN KEY FK_B159BB13483C0E96');
        $this->addSql('ALTER TABLE announcements DROP FOREIGN KEY FK_F422A9D6DE8AF9C');
        $this->addSql('ALTER TABLE invoices DROP FOREIGN KEY FK_6A2F2F956DE8AF9C');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA26DE8AF9C');
        $this->addSql('DROP TABLE announcements');
        $this->addSql('DROP TABLE banner');
        $this->addSql('DROP TABLE cat_add');
        $this->addSql('DROP TABLE cat_announcements');
        $this->addSql('DROP TABLE cat_shop');
        $this->addSql('DROP TABLE invoices');
        $this->addSql('DROP TABLE marketers');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE user');
    }
}
