<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615123547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, fuel VARCHAR(255) NOT NULL, price INT NOT NULL, UNIQUE INDEX UNIQ_773DE69D3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estate (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, area INT NOT NULL, price INT NOT NULL, UNIQUE INDEX UNIQ_8C4A1AAC3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, salary INT NOT NULL, contract VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FBD8E0F83256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D3256915B FOREIGN KEY (relation_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE estate ADD CONSTRAINT FK_8C4A1AAC3256915B FOREIGN KEY (relation_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F83256915B FOREIGN KEY (relation_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE ad DROP category, DROP salary, DROP contract, DROP fuel_type, DROP car_price, DROP area, DROP accom_price');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE estate');
        $this->addSql('DROP TABLE job');
        $this->addSql('ALTER TABLE ad ADD category VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD salary INT NOT NULL, ADD contract VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD fuel_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD car_price INT NOT NULL, ADD area INT NOT NULL, ADD accom_price INT NOT NULL');
    }
}
