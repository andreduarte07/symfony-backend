<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250706000100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cria a tabela user_types';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user_types (
            id SERIAL PRIMARY KEY,
            type VARCHAR(50) NOT NULL,
            name VARCHAR(100) NOT NULL
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user_types');
    }
}
