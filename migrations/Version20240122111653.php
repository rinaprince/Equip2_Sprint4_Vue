<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122111653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee ADD login_id INT NOT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A15CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A15CB2E05D ON employee (login_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A15CB2E05D');
        $this->addSql('DROP INDEX UNIQ_5D9F75A15CB2E05D ON employee');
        $this->addSql('ALTER TABLE employee DROP login_id');
    }
}
