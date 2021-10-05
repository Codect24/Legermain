<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005065835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, title VARCHAR(50) NOT NULL, content VARCHAR(1000) NOT NULL, image_list VARCHAR(255) DEFAULT NULL, publication_date DATETIME NOT NULL, INDEX IDX_23A0E669D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, article_id_id INT NOT NULL, user_id SMALLINT NOT NULL, description VARCHAR(255) NOT NULL, moderation_state SMALLINT NOT NULL, publication_date DATETIME NOT NULL, INDEX IDX_5F9E962A8F3EC46 (article_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_request (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, description VARCHAR(100) NOT NULL, image_list VARCHAR(255) DEFAULT NULL, request_state VARCHAR(50) NOT NULL, INDEX IDX_274A2B219D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE galerie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, description VARCHAR(1000) NOT NULL, image_list VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, galerie_id_id INT NOT NULL, title VARCHAR(50) NOT NULL, legend VARCHAR(50) NOT NULL, INDEX IDX_C53D045F2EC291C1 (galerie_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, description VARCHAR(1000) NOT NULL, details VARCHAR(100) NOT NULL, job_type SMALLINT NOT NULL, publication_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer_answer (id INT AUTO_INCREMENT NOT NULL, job_offer_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, mail VARCHAR(100) NOT NULL, phone_number VARCHAR(15) NOT NULL, description VARCHAR(1000) NOT NULL, cv VARCHAR(255) NOT NULL, motivation_letter VARCHAR(255) NOT NULL, publication_date DATETIME NOT NULL, job_offer_state SMALLINT NOT NULL, archiving_state SMALLINT NOT NULL, INDEX IDX_CEBA8AB9F05F8F7 (job_offer_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E669D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE customer_request ADD CONSTRAINT FK_274A2B219D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F2EC291C1 FOREIGN KEY (galerie_id_id) REFERENCES galerie (id)');
        $this->addSql('ALTER TABLE job_offer_answer ADD CONSTRAINT FK_CEBA8AB9F05F8F7 FOREIGN KEY (job_offer_id_id) REFERENCES job_offer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A8F3EC46');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F2EC291C1');
        $this->addSql('ALTER TABLE job_offer_answer DROP FOREIGN KEY FK_CEBA8AB9F05F8F7');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E669D86650F');
        $this->addSql('ALTER TABLE customer_request DROP FOREIGN KEY FK_274A2B219D86650F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE customer_request');
        $this->addSql('DROP TABLE galerie');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_offer_answer');
        $this->addSql('DROP TABLE user');
    }
}
