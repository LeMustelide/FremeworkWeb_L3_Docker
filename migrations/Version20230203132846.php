<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203132846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__cours AS SELECT id, semestre_id, nom, description, creation_date, update_date FROM cours');
        $this->addSql('DROP TABLE cours');
        $this->addSql('CREATE TABLE cours (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, semestre_id INTEGER NOT NULL, enseignant_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, creation_date DATETIME DEFAULT NULL, update_date DATETIME DEFAULT NULL, CONSTRAINT FK_FDCA8C9C5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FDCA8C9CE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cours (id, semestre_id, nom, description, creation_date, update_date) SELECT id, semestre_id, nom, description, creation_date, update_date FROM __temp__cours');
        $this->addSql('DROP TABLE __temp__cours');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C5577AFDB ON cours (semestre_id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CE455FCC0 ON cours (enseignant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__cours AS SELECT id, semestre_id, nom, description, creation_date, update_date FROM cours');
        $this->addSql('DROP TABLE cours');
        $this->addSql('CREATE TABLE cours (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, semestre_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, creation_date DATETIME DEFAULT NULL, update_date DATETIME DEFAULT NULL, CONSTRAINT FK_FDCA8C9C5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cours (id, semestre_id, nom, description, creation_date, update_date) SELECT id, semestre_id, nom, description, creation_date, update_date FROM __temp__cours');
        $this->addSql('DROP TABLE __temp__cours');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C5577AFDB ON cours (semestre_id)');
    }
}
