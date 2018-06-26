<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180625075357 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE custom_fields_records_maps');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE custom_fields_records_maps (owner_id VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, machine_field_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, field_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, datatype VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, es_field_name VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, configs VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX search_idx (owner_id, datatype), PRIMARY KEY(owner_id, machine_field_name)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }
}
