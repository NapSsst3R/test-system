<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240225065431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_8c9112ce1e27f6bf');
        $this->addSql('CREATE INDEX IDX_8C9112CE1E27F6BF ON test_answers (question_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_8C9112CE1E27F6BF');
        $this->addSql('CREATE UNIQUE INDEX uniq_8c9112ce1e27f6bf ON test_answers (question_id)');
    }
}
