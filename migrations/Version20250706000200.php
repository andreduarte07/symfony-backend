<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250706000200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cria a tabela users com foreign key para user_types';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users (
            id SERIAL PRIMARY KEY,
            email VARCHAR(180) NOT NULL,
            password VARCHAR(255) NOT NULL,
            user_type_id INT NOT NULL,
            CONSTRAINT fk_user_type FOREIGN KEY (user_type_id) REFERENCES user_types (id) ON DELETE RESTRICT
        )');

        $this->addSql('CREATE UNIQUE INDEX uniq_users_email ON users (email)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
