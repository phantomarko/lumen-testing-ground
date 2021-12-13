<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211213155225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add product table with base fields uuid, name and price';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE product (uuid VARCHAR(255) NOT NULL, name LONGTEXT NOT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(uuid))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE product');
    }
}
