<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260317135330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE artiste CHANGE description description LONGTEXT DEFAULT NULL, CHANGE dateAjout dateAjout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE artiste RENAME INDEX idemploye TO IDX_9C07354FE8BDB84B');
        $this->addSql('DROP INDEX cle ON configuration');
        $this->addSql('ALTER TABLE configuration CHANGE valeur valeur LONGTEXT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('DROP INDEX idxConsultationDate ON consultation');
        $this->addSql('ALTER TABLE consultation CHANGE dateConsultation dateConsultation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE consultation RENAME INDEX idxconsultationoeuvre TO IDX_964685A656EF8664');
        $this->addSql('DROP INDEX idxContenuOrdre ON contenuenrichi');
        $this->addSql('ALTER TABLE contenuenrichi CHANGE description description LONGTEXT DEFAULT NULL, CHANGE ordreAffichage ordreAffichage INT DEFAULT 1 NOT NULL, CHANGE dateAjout dateAjout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE contenuenrichi RENAME INDEX idxcontenuoeuvre TO IDX_3D5403AB56EF8664');
        $this->addSql('ALTER TABLE contenuenrichi RENAME INDEX idemploye TO IDX_3D5403ABE8BDB84B');
        $this->addSql('ALTER TABLE emplacement RENAME INDEX idxemplacementespace TO IDX_C0CF65F665BAA1F7');
        $this->addSql('ALTER TABLE emplacement RENAME INDEX idxemplacementexpo TO IDX_C0CF65F63EC5E3F9');
        $this->addSql('DROP INDEX email ON employe');
        $this->addSql('DROP INDEX idxEmployeActif ON employe');
        $this->addSql('DROP INDEX idxEmployeSupprime ON employe');
        $this->addSql('ALTER TABLE employe CHANGE role role ENUM(\'admin\', \'gestionnaire\'), CHANGE actif actif TINYINT DEFAULT 1 NOT NULL, CHANGE supprime supprime TINYINT DEFAULT 0 NOT NULL, CHANGE dateCreation dateCreation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE employe RENAME INDEX idfonction TO IDX_F804D3B95AA3FFE6');
        $this->addSql('ALTER TABLE employe RENAME INDEX login TO UNIQ_IDENTIFIER_LOGIN');
        $this->addSql('DROP INDEX nomEspace ON espace');
        $this->addSql('ALTER TABLE espace CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('DROP INDEX idExposition ON etape');
        $this->addSql('ALTER TABLE etape ADD estComplete TINYINT DEFAULT NULL');
        $this->addSql('DROP INDEX idxExpositionDates ON exposition');
        $this->addSql('DROP INDEX idxExpositionActif ON exposition');
        $this->addSql('ALTER TABLE exposition CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE theme theme VARCHAR(255) DEFAULT NULL, CHANGE horaires horaires LONGTEXT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE modulePublicActif modulePublicActif TINYINT DEFAULT 0 NOT NULL, CHANGE dateCreation dateCreation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE exposition RENAME INDEX idemploye TO IDX_BC31FD13E8BDB84B');
        $this->addSql('DROP INDEX intitule ON fonction');
        $this->addSql('ALTER TABLE fonction CHANGE intitule intitule VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX code ON langue');
        $this->addSql('DROP INDEX numeroIdentification ON oeuvre');
        $this->addSql('DROP INDEX idxOeuvreTechnique ON oeuvre');
        $this->addSql('ALTER TABLE oeuvre CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE technique technique VARCHAR(255) DEFAULT NULL, CHANGE urlQrCode urlQrCode VARCHAR(255) DEFAULT NULL, CHANGE dateAjout dateAjout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE oeuvre RENAME INDEX idxoeuvreexposition TO IDX_35FE2EFE3EC5E3F9');
        $this->addSql('ALTER TABLE oeuvre RENAME INDEX idemplacement TO IDX_35FE2EFE80929A8E');
        $this->addSql('ALTER TABLE oeuvre RENAME INDEX idxoeuvreartiste TO IDX_35FE2EFE8CBE5EBD');
        $this->addSql('ALTER TABLE oeuvre RENAME INDEX idemploye TO IDX_35FE2EFEE8BDB84B');
        $this->addSql('DROP INDEX idxTradExpoExpoLangue ON traductionexpo');
        $this->addSql('ALTER TABLE traductionexpo CHANGE traductionTexte traductionTexte LONGTEXT DEFAULT NULL, CHANGE dateAjout dateAjout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE traductionexpo RENAME INDEX idx_9318632f3ec5e3f9 TO IDX_332ACC113EC5E3F9');
        $this->addSql('ALTER TABLE traductionexpo RENAME INDEX idlangue TO IDX_332ACC11F046DD14');
        $this->addSql('ALTER TABLE traductionexpo RENAME INDEX idemploye TO IDX_332ACC11E8BDB84B');
        $this->addSql('DROP INDEX idxTradArtisteArtisteLangue ON traductionartiste');
        $this->addSql('ALTER TABLE traductionartiste CHANGE traductionTexte traductionTexte LONGTEXT DEFAULT NULL, CHANGE dateAjout dateAjout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE traductionartiste RENAME INDEX idlangue TO IDX_34EF792BF046DD14');
        $this->addSql('ALTER TABLE traductionartiste RENAME INDEX idemploye TO IDX_34EF792BE8BDB84B');
        $this->addSql('DROP INDEX idxTradContenuOrdre ON traductioncontenuenrichi');
        $this->addSql('DROP INDEX idxTradContenuContenuLangue ON traductioncontenuenrichi');
        $this->addSql('ALTER TABLE traductioncontenuenrichi CHANGE traductionTexte traductionTexte LONGTEXT DEFAULT NULL, CHANGE ordreAffichage ordreAffichage INT DEFAULT 1 NOT NULL, CHANGE dateAjout dateAjout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE traductioncontenuenrichi RENAME INDEX idlangue TO IDX_AA4C1CBEF046DD14');
        $this->addSql('ALTER TABLE traductioncontenuenrichi RENAME INDEX idemploye TO IDX_AA4C1CBEE8BDB84B');
        $this->addSql('DROP INDEX idxTradOeuvreOeuvreLangue ON traductionoeuvre');
        $this->addSql('ALTER TABLE traductionoeuvre CHANGE traductionTexte traductionTexte LONGTEXT DEFAULT NULL, CHANGE dateAjout dateAjout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE traductionoeuvre RENAME INDEX idlangue TO IDX_BA6D1F53F046DD14');
        $this->addSql('ALTER TABLE traductionoeuvre RENAME INDEX idemploye TO IDX_BA6D1F53E8BDB84B');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE artiste CHANGE description description TEXT DEFAULT NULL, CHANGE dateAjout dateAjout DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE artiste RENAME INDEX idx_9c07354fe8bdb84b TO idEmploye');
        $this->addSql('ALTER TABLE configuration CHANGE valeur valeur TEXT DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX cle ON configuration (cle)');
        $this->addSql('ALTER TABLE consultation CHANGE dateConsultation dateConsultation DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE INDEX idxConsultationDate ON consultation (dateConsultation)');
        $this->addSql('ALTER TABLE consultation RENAME INDEX idx_964685a656ef8664 TO idxConsultationOeuvre');
        $this->addSql('ALTER TABLE contenuenrichi CHANGE description description TEXT DEFAULT NULL, CHANGE ordreAffichage ordreAffichage INT DEFAULT 1, CHANGE dateAjout dateAjout DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE INDEX idxContenuOrdre ON contenuenrichi (idOeuvre, ordreAffichage)');
        $this->addSql('ALTER TABLE contenuenrichi RENAME INDEX idx_3d5403abe8bdb84b TO idEmploye');
        $this->addSql('ALTER TABLE contenuenrichi RENAME INDEX idx_3d5403ab56ef8664 TO idxContenuOeuvre');
        $this->addSql('ALTER TABLE emplacement RENAME INDEX idx_c0cf65f665baa1f7 TO idxEmplacementEspace');
        $this->addSql('ALTER TABLE emplacement RENAME INDEX idx_c0cf65f63ec5e3f9 TO idxEmplacementExpo');
        $this->addSql('ALTER TABLE employe CHANGE role role VARCHAR(250) NOT NULL, CHANGE actif actif TINYINT DEFAULT 1, CHANGE supprime supprime TINYINT DEFAULT 0, CHANGE dateCreation dateCreation DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE UNIQUE INDEX email ON employe (email)');
        $this->addSql('CREATE INDEX idxEmployeActif ON employe (actif)');
        $this->addSql('CREATE INDEX idxEmployeSupprime ON employe (supprime)');
        $this->addSql('ALTER TABLE employe RENAME INDEX uniq_identifier_login TO login');
        $this->addSql('ALTER TABLE employe RENAME INDEX idx_f804d3b95aa3ffe6 TO idFonction');
        $this->addSql('ALTER TABLE espace CHANGE description description TEXT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX nomEspace ON espace (nomEspace)');
        $this->addSql('ALTER TABLE etape DROP estComplete');
        $this->addSql('CREATE UNIQUE INDEX idExposition ON etape (idExposition, ordre)');
        $this->addSql('ALTER TABLE exposition CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE theme theme VARCHAR(250) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE horaires horaires TEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description TEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE modulePublicActif modulePublicActif TINYINT DEFAULT 0, CHANGE dateCreation dateCreation DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE INDEX idxExpositionDates ON exposition (dateDebut, dateFin)');
        $this->addSql('CREATE INDEX idxExpositionActif ON exposition (modulePublicActif)');
        $this->addSql('ALTER TABLE exposition RENAME INDEX idx_bc31fd13e8bdb84b TO idEmploye');
        $this->addSql('ALTER TABLE fonction CHANGE intitule intitule VARCHAR(250) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX intitule ON fonction (intitule)');
        $this->addSql('CREATE UNIQUE INDEX code ON langue (code)');
        $this->addSql('ALTER TABLE oeuvre CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description TEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE technique technique VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(500) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE urlQrCode urlQrCode VARCHAR(500) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dateAjout dateAjout DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE UNIQUE INDEX numeroIdentification ON oeuvre (numeroIdentification)');
        $this->addSql('CREATE INDEX idxOeuvreTechnique ON oeuvre (technique)');
        $this->addSql('ALTER TABLE oeuvre RENAME INDEX idx_35fe2efe80929a8e TO idEmplacement');
        $this->addSql('ALTER TABLE oeuvre RENAME INDEX idx_35fe2efee8bdb84b TO idEmploye');
        $this->addSql('ALTER TABLE oeuvre RENAME INDEX idx_35fe2efe3ec5e3f9 TO idxOeuvreExposition');
        $this->addSql('ALTER TABLE oeuvre RENAME INDEX idx_35fe2efe8cbe5ebd TO idxOeuvreArtiste');
        $this->addSql('ALTER TABLE traductionartiste CHANGE traductionTexte traductionTexte TEXT DEFAULT NULL, CHANGE dateAjout dateAjout DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE INDEX idxTradArtisteArtisteLangue ON traductionartiste (idArtiste, idLangue)');
        $this->addSql('ALTER TABLE traductionartiste RENAME INDEX idx_34ef792bf046dd14 TO idLangue');
        $this->addSql('ALTER TABLE traductionartiste RENAME INDEX idx_34ef792be8bdb84b TO idEmploye');
        $this->addSql('ALTER TABLE traductioncontenuenrichi CHANGE traductionTexte traductionTexte TEXT DEFAULT NULL, CHANGE ordreAffichage ordreAffichage INT DEFAULT 1, CHANGE dateAjout dateAjout DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE INDEX idxTradContenuOrdre ON traductioncontenuenrichi (idContenuEnrichi, idLangue, ordreAffichage)');
        $this->addSql('CREATE INDEX idxTradContenuContenuLangue ON traductioncontenuenrichi (idContenuEnrichi, idLangue)');
        $this->addSql('ALTER TABLE traductioncontenuenrichi RENAME INDEX idx_aa4c1cbee8bdb84b TO idEmploye');
        $this->addSql('ALTER TABLE traductioncontenuenrichi RENAME INDEX idx_aa4c1cbef046dd14 TO idLangue');
        $this->addSql('ALTER TABLE traductionExpo CHANGE traductionTexte traductionTexte TEXT DEFAULT NULL, CHANGE dateAjout dateAjout DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE INDEX idxTradExpoExpoLangue ON traductionExpo (idExposition, idLangue)');
        $this->addSql('ALTER TABLE traductionExpo RENAME INDEX idx_332acc11f046dd14 TO idLangue');
        $this->addSql('ALTER TABLE traductionExpo RENAME INDEX idx_332acc11e8bdb84b TO idEmploye');
        $this->addSql('ALTER TABLE traductionExpo RENAME INDEX idx_332acc113ec5e3f9 TO IDX_9318632F3EC5E3F9');
        $this->addSql('ALTER TABLE traductionoeuvre CHANGE traductionTexte traductionTexte TEXT DEFAULT NULL, CHANGE dateAjout dateAjout DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE INDEX idxTradOeuvreOeuvreLangue ON traductionoeuvre (idOeuvre, idLangue)');
        $this->addSql('ALTER TABLE traductionoeuvre RENAME INDEX idx_ba6d1f53f046dd14 TO idLangue');
        $this->addSql('ALTER TABLE traductionoeuvre RENAME INDEX idx_ba6d1f53e8bdb84b TO idEmploye');
    }
}
