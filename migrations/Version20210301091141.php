<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301091141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_agents (missions_id INT NOT NULL, agents_id INT NOT NULL, INDEX IDX_5340AFB917C042CF (missions_id), INDEX IDX_5340AFB9709770DC (agents_id), PRIMARY KEY(missions_id, agents_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_contacts (missions_id INT NOT NULL, contacts_id INT NOT NULL, INDEX IDX_FA54446417C042CF (missions_id), INDEX IDX_FA544464719FB48E (contacts_id), PRIMARY KEY(missions_id, contacts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_agents ADD CONSTRAINT FK_5340AFB917C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_agents ADD CONSTRAINT FK_5340AFB9709770DC FOREIGN KEY (agents_id) REFERENCES agents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_contacts ADD CONSTRAINT FK_FA54446417C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_contacts ADD CONSTRAINT FK_FA544464719FB48E FOREIGN KEY (contacts_id) REFERENCES contacts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions ADD skills_id INT NOT NULL, ADD hideaway_id INT NOT NULL, ADD targets_id INT NOT NULL');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E7FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E256540BD FOREIGN KEY (hideaway_id) REFERENCES hideaway (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E43B5F743 FOREIGN KEY (targets_id) REFERENCES targets (id)');
        $this->addSql('CREATE INDEX IDX_34F1D47E7FF61858 ON missions (skills_id)');
        $this->addSql('CREATE INDEX IDX_34F1D47E256540BD ON missions (hideaway_id)');
        $this->addSql('CREATE INDEX IDX_34F1D47E43B5F743 ON missions (targets_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE missions_agents');
        $this->addSql('DROP TABLE missions_contacts');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E7FF61858');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E256540BD');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E43B5F743');
        $this->addSql('DROP INDEX IDX_34F1D47E7FF61858 ON missions');
        $this->addSql('DROP INDEX IDX_34F1D47E256540BD ON missions');
        $this->addSql('DROP INDEX IDX_34F1D47E43B5F743 ON missions');
        $this->addSql('ALTER TABLE missions DROP skills_id, DROP hideaway_id, DROP targets_id');
    }
}
