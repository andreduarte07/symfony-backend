<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250706094132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Popula a tabela user_types com os tipos client e professional';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO user_types (type, name) VALUES ('client', 'Cliente')");
        $this->addSql("INSERT INTO user_types (type, name) VALUES ('professional', 'Profissional')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM user_types WHERE type IN ('client', 'professional')");
    }
}
