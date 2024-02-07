<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110074734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE private_customer CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE private_customer ADD CONSTRAINT FK_26AF51A4BF396750 FOREIGN KEY (id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professional CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE professional ADD CONSTRAINT FK_B3B573AABF396750 FOREIGN KEY (id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle CHANGE vehicle_order_id vehicle_order_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE private_customer DROP FOREIGN KEY FK_26AF51A4BF396750');
        $this->addSql('ALTER TABLE private_customer CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE vehicle CHANGE vehicle_order_id vehicle_order_id INT NOT NULL');
        $this->addSql('ALTER TABLE professional DROP FOREIGN KEY FK_B3B573AABF396750');
        $this->addSql('ALTER TABLE professional CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
