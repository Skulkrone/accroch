<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180816170433 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cat_announcements ADD fk_announcements_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cat_announcements ADD CONSTRAINT FK_83304D9A33D19CDD FOREIGN KEY (fk_announcements_id_id) REFERENCES announcements (id)');
        $this->addSql('CREATE INDEX IDX_83304D9A33D19CDD ON cat_announcements (fk_announcements_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cat_announcements DROP FOREIGN KEY FK_83304D9A33D19CDD');
        $this->addSql('DROP INDEX IDX_83304D9A33D19CDD ON cat_announcements');
        $this->addSql('ALTER TABLE cat_announcements DROP fk_announcements_id_id');
    }
}
