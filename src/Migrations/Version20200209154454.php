<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200209154454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE quiz_trivia (id INT AUTO_INCREMENT NOT NULL, quiz_id_id INT NOT NULL, position INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_D7FF80C98337E7D7 (quiz_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A412FA929D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_trivia_meta (id INT AUTO_INCREMENT NOT NULL, quiz_trivia_id_id INT NOT NULL, type INT NOT NULL, content VARCHAR(255) DEFAULT NULL, position INT NOT NULL, is_answer TINYINT(1) NOT NULL, INDEX IDX_F36A3F8A24BEA861 (quiz_trivia_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quiz_trivia ADD CONSTRAINT FK_D7FF80C98337E7D7 FOREIGN KEY (quiz_id_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA929D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_trivia_meta ADD CONSTRAINT FK_F36A3F8A24BEA861 FOREIGN KEY (quiz_trivia_id_id) REFERENCES quiz_trivia (id)');
        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quiz_trivia_meta DROP FOREIGN KEY FK_F36A3F8A24BEA861');
        $this->addSql('ALTER TABLE quiz_trivia DROP FOREIGN KEY FK_D7FF80C98337E7D7');
        $this->addSql('DROP TABLE quiz_trivia');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE quiz_trivia_meta');
        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
