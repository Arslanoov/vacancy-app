<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201128153934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE vacancy_requests (id UUID NOT NULL, vacancy_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, full_name VARCHAR(255) NOT NULL, birthday_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, gender VARCHAR(8) NOT NULL, phone VARCHAR(15) NOT NULL, cv_description VARCHAR(255) DEFAULT NULL, cv_file VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_915C068433B78C4 ON vacancy_requests (vacancy_id)');
        $this->addSql('COMMENT ON COLUMN vacancy_requests.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN vacancy_requests.birthday_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE vacancy_requests ADD CONSTRAINT FK_915C068433B78C4 FOREIGN KEY (vacancy_id) REFERENCES vacancies (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE vacancy_requests');
        $this->addSql('ALTER TABLE vacancies ALTER id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE vacancies ALTER id DROP DEFAULT');
    }
}
