<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211206141309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_infos (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, title VARCHAR(40) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, status VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_update DATETIME NOT NULL, UNIQUE INDEX UNIQ_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, order_ref_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_52EA1F094584665A (product_id), INDEX IDX_52EA1F09E238517C (order_ref_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, file VARCHAR(255) DEFAULT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisation (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, categorie JSON NOT NULL, publication_date DATETIME NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_EAA5610E9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09E238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES produit_categorie (id)');
        $this->addSql('ALTER TABLE realisation ADD CONSTRAINT FK_EAA5610E9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E669D86650F');
        $this->addSql('DROP INDEX IDX_23A0E669D86650F ON article');
        $this->addSql('ALTER TABLE article ADD image VARCHAR(255) NOT NULL, ADD slug VARCHAR(255) NOT NULL, ADD highlighted TINYINT(1) NOT NULL, DROP image_list, CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A8F3EC46');
        $this->addSql('DROP INDEX IDX_5F9E962A8F3EC46 ON comments');
        $this->addSql('ALTER TABLE comments CHANGE user_id user_id INT NOT NULL, CHANGE article_id_id article_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A7294869C ON comments (article_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AA76ED395 ON comments (user_id)');
        $this->addSql('ALTER TABLE job_offer ADD job_style SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE job_offer_answer DROP FOREIGN KEY FK_CEBA8AB9F05F8F7');
        $this->addSql('DROP INDEX IDX_CEBA8AB9F05F8F7 ON job_offer_answer');
        $this->addSql('ALTER TABLE job_offer_answer ADD jobOfferState INT DEFAULT 0 NOT NULL, ADD archivingState INT DEFAULT 0 NOT NULL, DROP job_offer_state, DROP archiving_state, CHANGE publication_date updated_at DATETIME NOT NULL, CHANGE job_offer_id_id job_offer_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD telephone INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09E238517C');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F094584665A');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('DROP TABLE contact_infos');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_categorie');
        $this->addSql('DROP TABLE realisation');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395 ON article');
        $this->addSql('ALTER TABLE article ADD image_list VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP image, DROP slug, DROP highlighted, CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E669D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_23A0E669D86650F ON article (user_id_id)');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A7294869C');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('DROP INDEX IDX_5F9E962A7294869C ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962AA76ED395 ON comments');
        $this->addSql('ALTER TABLE comments CHANGE user_id user_id SMALLINT NOT NULL, CHANGE article_id article_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A8F3EC46 ON comments (article_id_id)');
        $this->addSql('ALTER TABLE job_offer DROP job_style');
        $this->addSql('ALTER TABLE job_offer_answer ADD job_offer_state SMALLINT NOT NULL, ADD archiving_state SMALLINT NOT NULL, DROP jobOfferState, DROP archivingState, CHANGE job_offer_id job_offer_id_id INT NOT NULL, CHANGE updated_at publication_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE job_offer_answer ADD CONSTRAINT FK_CEBA8AB9F05F8F7 FOREIGN KEY (job_offer_id_id) REFERENCES job_offer (id)');
        $this->addSql('CREATE INDEX IDX_CEBA8AB9F05F8F7 ON job_offer_answer (job_offer_id_id)');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP telephone');
    }
}
