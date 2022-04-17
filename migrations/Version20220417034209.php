<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220417034209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, link_to_user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_2246507B7E7C2E95 (link_to_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B7E7C2E95 FOREIGN KEY (link_to_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cars ADD basket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D141BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('CREATE INDEX IDX_95C71D141BE1FB52 ON cars (basket_id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D141BE1FB52');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP INDEX IDX_95C71D141BE1FB52 ON cars');
        $this->addSql('ALTER TABLE cars DROP basket_id');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
