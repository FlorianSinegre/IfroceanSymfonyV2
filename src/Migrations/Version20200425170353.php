<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200425170353 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, departement_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E2E2D1EECCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE espece (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etude (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, creation_date DATE NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_1DDEA924A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etude_plage (etude_id INT NOT NULL, plage_id INT NOT NULL, INDEX IDX_A9363E1B47ABD362 (etude_id), INDEX IDX_A9363E1BF82604D9 (plage_id), PRIMARY KEY(etude_id, plage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plage (id INT AUTO_INCREMENT NOT NULL, commune_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_107196C9131A4F72 (commune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone_de_prelevement (id INT AUTO_INCREMENT NOT NULL, plage_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, position_x1 DOUBLE PRECISION NOT NULL, position_y1 DOUBLE PRECISION NOT NULL, position_x2 DOUBLE PRECISION NOT NULL, position_y2 DOUBLE PRECISION NOT NULL, position_x3 DOUBLE PRECISION NOT NULL, position_y3 DOUBLE PRECISION NOT NULL, position_x4 DOUBLE PRECISION NOT NULL, position_y4 DOUBLE PRECISION NOT NULL, INDEX IDX_4EA2BD42F82604D9 (plage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone_de_prelevement_espece (zone_de_prelevement_id INT NOT NULL, espece_id INT NOT NULL, INDEX IDX_FC7DC1317CEC8EE1 (zone_de_prelevement_id), INDEX IDX_FC7DC1312D191E7A (espece_id), PRIMARY KEY(zone_de_prelevement_id, espece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EECCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE etude ADD CONSTRAINT FK_1DDEA924A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE etude_plage ADD CONSTRAINT FK_A9363E1B47ABD362 FOREIGN KEY (etude_id) REFERENCES etude (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etude_plage ADD CONSTRAINT FK_A9363E1BF82604D9 FOREIGN KEY (plage_id) REFERENCES plage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plage ADD CONSTRAINT FK_107196C9131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE zone_de_prelevement ADD CONSTRAINT FK_4EA2BD42F82604D9 FOREIGN KEY (plage_id) REFERENCES plage (id)');
        $this->addSql('ALTER TABLE zone_de_prelevement_espece ADD CONSTRAINT FK_FC7DC1317CEC8EE1 FOREIGN KEY (zone_de_prelevement_id) REFERENCES zone_de_prelevement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zone_de_prelevement_espece ADD CONSTRAINT FK_FC7DC1312D191E7A FOREIGN KEY (espece_id) REFERENCES espece (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plage DROP FOREIGN KEY FK_107196C9131A4F72');
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EECCF9E01E');
        $this->addSql('ALTER TABLE zone_de_prelevement_espece DROP FOREIGN KEY FK_FC7DC1312D191E7A');
        $this->addSql('ALTER TABLE etude_plage DROP FOREIGN KEY FK_A9363E1B47ABD362');
        $this->addSql('ALTER TABLE etude_plage DROP FOREIGN KEY FK_A9363E1BF82604D9');
        $this->addSql('ALTER TABLE zone_de_prelevement DROP FOREIGN KEY FK_4EA2BD42F82604D9');
        $this->addSql('ALTER TABLE etude DROP FOREIGN KEY FK_1DDEA924A76ED395');
        $this->addSql('ALTER TABLE zone_de_prelevement_espece DROP FOREIGN KEY FK_FC7DC1317CEC8EE1');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE espece');
        $this->addSql('DROP TABLE etude');
        $this->addSql('DROP TABLE etude_plage');
        $this->addSql('DROP TABLE plage');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE zone_de_prelevement');
        $this->addSql('DROP TABLE zone_de_prelevement_espece');
    }
}
