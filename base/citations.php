<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     Citations
 * @copyright  2018
 * @author     peetdu
 * @licence    GNU/GPL
 * @package    SPIP\Citations\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function citations_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['citations'] = 'citations';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function citations_declarer_tables_objets_sql($tables) {

	$tables['spip_citations'] = array(
		'type' => 'citation',
		'principale' => 'oui',
		'field'=> array(
			'id_citation'        => 'bigint(21) NOT NULL',
			'id_rubrique'        => 'bigint(21) NOT NULL DEFAULT 0',
			'id_secteur'         => 'bigint(21) NOT NULL DEFAULT 0',
			'auteur'             => 'text NOT NULL DEFAULT ""',
			'citation'           => 'text NOT NULL DEFAULT ""',
			'statut'             => 'varchar(20)  DEFAULT "0" NOT NULL',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_citation',
			'KEY id_rubrique'    => 'id_rubrique',
			'KEY id_secteur'     => 'id_secteur',
			'KEY statut'         => 'statut',
		),
		'titre' => 'auteur AS titre, "" AS lang',
		 #'date' => '',
		'champs_editables'  => array('auteur', 'citation', 'id_rubrique', 'id_secteur'),
		'champs_versionnes' => array('auteur', 'citation', 'id_rubrique', 'id_secteur'),
		'rechercher_champs' => array("auteur" => 8),
		'tables_jointures'  => array(),
		'statut_textes_instituer' => array(
			'prepa'    => 'texte_statut_en_cours_redaction',
			'publie'   => 'texte_statut_publie',
			'poubelle' => 'texte_statut_poubelle',
		),
		'statut'=> array(
			array(
				'champ'     => 'statut',
				'publie'    => 'publie',
				'previsu'   => 'publie,prepa',
				'post_date' => 'date',
				'exception' => array('statut','tout')
			)
		),
		'texte_changer_statut' => 'citation:texte_changer_statut_citation',


	);

	return $tables;
}
