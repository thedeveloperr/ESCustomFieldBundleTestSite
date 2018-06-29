<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180628105930 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE custom_fields_records_maps (owner_id VARCHAR(255) NOT NULL, machine_field_name VARCHAR(255) NOT NULL, field_name VARCHAR(255) NOT NULL, datatype VARCHAR(50) NOT NULL, es_field_name VARCHAR(50) NOT NULL, configs VARCHAR(255) DEFAULT NULL, INDEX search_idx (owner_id, datatype), INDEX esfname_index (owner_id, es_field_name), PRIMARY KEY(owner_id, machine_field_name)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esmapping_field (field_name VARCHAR(50) NOT NULL, datatype VARCHAR(50) NOT NULL, INDEX esmapping_field_index (field_name, datatype), PRIMARY KEY(field_name)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE esfields_mapping');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE esfields_mapping (field_name VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, datatype VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(field_name)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE custom_fields_records_maps');
        $this->addSql('DROP TABLE esmapping_field');
    }
}
