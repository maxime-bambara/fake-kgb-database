<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303111920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_agents (missions_id INT NOT NULL, agents_id INT NOT NULL, INDEX IDX_5340AFB917C042CF (missions_id), INDEX IDX_5340AFB9709770DC (agents_id), PRIMARY KEY(missions_id, agents_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_agents ADD CONSTRAINT FK_5340AFB917C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_agents ADD CONSTRAINT FK_5340AFB9709770DC FOREIGN KEY (agents_id) REFERENCES agents (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE missions_missions');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_missions (missions_source INT NOT NULL, missions_target INT NOT NULL, INDEX IDX_FDE58569995C7BA4 (missions_source), INDEX IDX_FDE5856980B92B2B (missions_target), PRIMARY KEY(missions_source, missions_target)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE missions_missions ADD CONSTRAINT FK_FDE5856980B92B2B FOREIGN KEY (missions_target) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_missions ADD CONSTRAINT FK_FDE58569995C7BA4 FOREIGN KEY (missions_source) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE missions_agents');
    }
}
