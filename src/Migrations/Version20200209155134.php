<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200209155134 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE quiz_trivia DROP FOREIGN KEY FK_D7FF80C98337E7D7');
        $this->addSql('DROP INDEX IDX_D7FF80C98337E7D7 ON quiz_trivia');
        $this->addSql('ALTER TABLE quiz_trivia CHANGE quiz_id_id quiz_id INT NOT NULL');
        $this->addSql('ALTER TABLE quiz_trivia ADD CONSTRAINT FK_D7FF80C9853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('CREATE INDEX IDX_D7FF80C9853CD175 ON quiz_trivia (quiz_id)');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA929D86650F');
        $this->addSql('DROP INDEX IDX_A412FA929D86650F ON quiz');
        $this->addSql('ALTER TABLE quiz CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A412FA92A76ED395 ON quiz (user_id)');
        $this->addSql('ALTER TABLE quiz_trivia_meta DROP FOREIGN KEY FK_F36A3F8A24BEA861');
        $this->addSql('DROP INDEX IDX_F36A3F8A24BEA861 ON quiz_trivia_meta');
        $this->addSql('ALTER TABLE quiz_trivia_meta CHANGE content content VARCHAR(255) DEFAULT NULL, CHANGE quiz_trivia_id_id quiz_trivia_id INT NOT NULL');
        $this->addSql('ALTER TABLE quiz_trivia_meta ADD CONSTRAINT FK_F36A3F8AEEBE1FEE FOREIGN KEY (quiz_trivia_id) REFERENCES quiz_trivia (id)');
        $this->addSql('CREATE INDEX IDX_F36A3F8AEEBE1FEE ON quiz_trivia_meta (quiz_trivia_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92A76ED395');
        $this->addSql('DROP INDEX IDX_A412FA92A76ED395 ON quiz');
        $this->addSql('ALTER TABLE quiz CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA929D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A412FA929D86650F ON quiz (user_id_id)');
        $this->addSql('ALTER TABLE quiz_trivia DROP FOREIGN KEY FK_D7FF80C9853CD175');
        $this->addSql('DROP INDEX IDX_D7FF80C9853CD175 ON quiz_trivia');
        $this->addSql('ALTER TABLE quiz_trivia CHANGE quiz_id quiz_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE quiz_trivia ADD CONSTRAINT FK_D7FF80C98337E7D7 FOREIGN KEY (quiz_id_id) REFERENCES quiz (id)');
        $this->addSql('CREATE INDEX IDX_D7FF80C98337E7D7 ON quiz_trivia (quiz_id_id)');
        $this->addSql('ALTER TABLE quiz_trivia_meta DROP FOREIGN KEY FK_F36A3F8AEEBE1FEE');
        $this->addSql('DROP INDEX IDX_F36A3F8AEEBE1FEE ON quiz_trivia_meta');
        $this->addSql('ALTER TABLE quiz_trivia_meta CHANGE content content VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE quiz_trivia_id quiz_trivia_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE quiz_trivia_meta ADD CONSTRAINT FK_F36A3F8A24BEA861 FOREIGN KEY (quiz_trivia_id_id) REFERENCES quiz_trivia (id)');
        $this->addSql('CREATE INDEX IDX_F36A3F8A24BEA861 ON quiz_trivia_meta (quiz_trivia_id_id)');
        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
