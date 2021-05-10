<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210131131013 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, secret VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_access_tokens (user_id INT NOT NULL, client_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, push_token VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_CA42527CA76ED395 (user_id), INDEX IDX_CA42527C19EB6921 (client_id), PRIMARY KEY(user_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE password_reset (id VARCHAR(100) NOT NULL, user_id INT DEFAULT NULL, sms_code VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_B1017252A76ED395 (user_id), INDEX user_id_token_index (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, text_id INT DEFAULT NULL, status_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_885DBAFAA76ED395 (user_id), INDEX IDX_885DBAFA698D3548 (text_id), INDEX IDX_885DBAFA6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_image (post_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_522688B04B89032C (post_id), INDEX IDX_522688B03DA5256D (image_id), PRIMARY KEY(post_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statuses (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE texts (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, remember_token VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE versions (user_id INT NOT NULL, client_id INT NOT NULL, version VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_19DC40D2A76ED395 (user_id), INDEX IDX_19DC40D219EB6921 (client_id), PRIMARY KEY(user_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oauth_access_tokens ADD CONSTRAINT FK_CA42527CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE oauth_access_tokens ADD CONSTRAINT FK_CA42527C19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE password_reset ADD CONSTRAINT FK_B1017252A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA698D3548 FOREIGN KEY (text_id) REFERENCES texts (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA6BF700BD FOREIGN KEY (status_id) REFERENCES statuses (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE post_image ADD CONSTRAINT FK_522688B04B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE post_image ADD CONSTRAINT FK_522688B03DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE versions ADD CONSTRAINT FK_19DC40D2A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE versions ADD CONSTRAINT FK_19DC40D219EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oauth_access_tokens DROP FOREIGN KEY FK_CA42527C19EB6921');
        $this->addSql('ALTER TABLE versions DROP FOREIGN KEY FK_19DC40D219EB6921');
        $this->addSql('ALTER TABLE post_image DROP FOREIGN KEY FK_522688B03DA5256D');
        $this->addSql('ALTER TABLE post_image DROP FOREIGN KEY FK_522688B04B89032C');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA6BF700BD');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA698D3548');
        $this->addSql('ALTER TABLE oauth_access_tokens DROP FOREIGN KEY FK_CA42527CA76ED395');
        $this->addSql('ALTER TABLE password_reset DROP FOREIGN KEY FK_B1017252A76ED395');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE versions DROP FOREIGN KEY FK_19DC40D2A76ED395');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE oauth_access_tokens');
        $this->addSql('DROP TABLE password_reset');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE post_image');
        $this->addSql('DROP TABLE statuses');
        $this->addSql('DROP TABLE texts');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE versions');
    }
}
