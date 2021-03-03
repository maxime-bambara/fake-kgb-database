<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303105002 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agents (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birthday DATE NOT NULL, code VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agents_skills (agents_id INT NOT NULL, skills_id INT NOT NULL, INDEX IDX_5088E440709770DC (agents_id), INDEX IDX_5088E4407FF61858 (skills_id), PRIMARY KEY(agents_id, skills_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birthday DATE NOT NULL, code VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hideaway (id INT AUTO_INCREMENT NOT NULL, adress VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions (id INT AUTO_INCREMENT NOT NULL, skills_id INT NOT NULL, hideaway_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_34F1D47E7FF61858 (skills_id), INDEX IDX_34F1D47E256540BD (hideaway_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_missions (missions_source INT NOT NULL, missions_target INT NOT NULL, INDEX IDX_FDE58569995C7BA4 (missions_source), INDEX IDX_FDE5856980B92B2B (missions_target), PRIMARY KEY(missions_source, missions_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_contacts (missions_id INT NOT NULL, contacts_id INT NOT NULL, INDEX IDX_FA54446417C042CF (missions_id), INDEX IDX_FA544464719FB48E (contacts_id), PRIMARY KEY(missions_id, contacts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_targets (missions_id INT NOT NULL, targets_id INT NOT NULL, INDEX IDX_B7328F6017C042CF (missions_id), INDEX IDX_B7328F6043B5F743 (targets_id), PRIMARY KEY(missions_id, targets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE targets (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birthday DATE NOT NULL, alias VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agents_skills ADD CONSTRAINT FK_5088E440709770DC FOREIGN KEY (agents_id) REFERENCES agents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agents_skills ADD CONSTRAINT FK_5088E4407FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E7FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E256540BD FOREIGN KEY (hideaway_id) REFERENCES hideaway (id)');
        $this->addSql('ALTER TABLE missions_missions ADD CONSTRAINT FK_FDE58569995C7BA4 FOREIGN KEY (missions_source) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_missions ADD CONSTRAINT FK_FDE5856980B92B2B FOREIGN KEY (missions_target) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_contacts ADD CONSTRAINT FK_FA54446417C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_contacts ADD CONSTRAINT FK_FA544464719FB48E FOREIGN KEY (contacts_id) REFERENCES contacts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_targets ADD CONSTRAINT FK_B7328F6017C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_targets ADD CONSTRAINT FK_B7328F6043B5F743 FOREIGN KEY (targets_id) REFERENCES targets (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agents_skills DROP FOREIGN KEY FK_5088E440709770DC');
        $this->addSql('ALTER TABLE missions_contacts DROP FOREIGN KEY FK_FA544464719FB48E');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E256540BD');
        $this->addSql('ALTER TABLE missions_missions DROP FOREIGN KEY FK_FDE58569995C7BA4');
        $this->addSql('ALTER TABLE missions_missions DROP FOREIGN KEY FK_FDE5856980B92B2B');
        $this->addSql('ALTER TABLE missions_contacts DROP FOREIGN KEY FK_FA54446417C042CF');
        $this->addSql('ALTER TABLE missions_targets DROP FOREIGN KEY FK_B7328F6017C042CF');
        $this->addSql('ALTER TABLE agents_skills DROP FOREIGN KEY FK_5088E4407FF61858');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E7FF61858');
        $this->addSql('ALTER TABLE missions_targets DROP FOREIGN KEY FK_B7328F6043B5F743');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE agents');
        $this->addSql('DROP TABLE agents_skills');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE hideaway');
        $this->addSql('DROP TABLE missions');
        $this->addSql('DROP TABLE missions_missions');
        $this->addSql('DROP TABLE missions_contacts');
        $this->addSql('DROP TABLE missions_targets');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE targets');
    }
}
