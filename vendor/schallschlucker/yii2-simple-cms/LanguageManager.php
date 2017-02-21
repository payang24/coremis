<?php

/*
 * This file is part of the simple cms project for Yii2
 *
 * (c) Schallschlucker Agency Paul Kerspe - project homepage <https://github.com/pkerspe/yii2-simple-cms>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace schallschlucker\simplecms;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Component;

/**
 * This is the default language manager class for the simple cms extension
 *
 * @property array $languageIdMappings
 *
 * @author Paul Kerspe
 */
class LanguageManager extends Component {
	public $languageIdMappings = [ 
		'1' => [
			'id' => 1,
			'code' => 'de', 
			'displaytext' => [
				'de' => 'deutsch', 
				'en' => 'german',
				'pl' => 'niemiecki',
				'tr' => 'alman',
			],
		],
		'de-DE' => [
			'alias' => '1'
		],
		'2' => [
			'id' => 2,
			'code' => 'en', 
			'displaytext' => [
				'de' => 'englisch', 
				'en' => 'english',
				'pl' => 'angielski',
				'tr' => 'ingilizce',
			],
		],
		'en-US' => [
			'alias' => '2',
		],
		'3' => [
			'id' => 3,
			'code' => 'pl', 
			'displaytext' => [
				'de' => 'polnisch', 
				'en' => 'polish',
				'pl' => 'polski',
				'tr' => 'leh�e',
			],
		],
		'4' => [
			'id' => 4,
			'code' => 'tr', 
			'displaytext' => [
				'de' => 't�rkisch', 
				'en' => 'turkish',
				'pl' => 'turecki',
				'tr' => 't�rk',
			],
		],
	];
	
	public function getConfiguredLanguageIdToCodeMapping() {
		$languageIdCodeMapping = [ ];
		foreach ( $this->languageIdMappings as $key => $languageIdMapping ) {
			if (isset ( $languageIdMapping ['alias'] )) {
				$languageIdCodeMapping [$key] = $this->languageIdMappings [$languageIdMapping ['alias']] ['code'];
			} else {
				$languageIdCodeMapping [$key] = $languageIdMapping ['code'];
			}
		}
		return $languageIdCodeMapping;
	}
	
	/**
	 * The function tries to indentify the given language code or String and map it to the internally used language id (the integer value that is stored in the database)
	 * @param unknown $languageCodeOrString
	 * @return integer the language id for the string if found, null if nothing could be found.
	 */
	public function getLanguageIdForString($languageCodeOrString){
		$languageId = null;
		if($languageCodeOrString == ''){
			return null;
		} else {
			foreach ( $this->languageIdMappings as $key => $languageIdMapping ) {
				if($key == $languageCodeOrString || (isset($languageIdMapping['code']) && $languageIdMapping['code'] == $languageCodeOrString) ){
					if(isset($languageIdMapping['alias']) )
						return $this->languageIdMappings[$languageIdMapping['alias']]['id'];
					else
						return $languageIdMapping['id'];
				}
			}
		}
		return null;
	}
	
	public function getDefaultLanguageId() {
		$firstLangMapping = current ( array_keys ( $this->languageIdMappings ) );
		if (isset ( $firstLangMapping ['alias'] )) {
			throw new InvalidConfigException ( 'The default language is not configured properly in the pn_cms module config section. It seems you configured an alias as the first entry in the languageIdMappings. The first item must NOT be an alias' );
		}
		return $firstLangMapping;
	}
	
	public function getAllConfiguredLanguageCodes() {
		$languageIdCodeMappingNoDuplicates = [ ];
		foreach ( $this->languageIdMappings as $key => $languageIdMapping ) {
			if (! isset ( $languageIdMapping ['alias'] )) {
				$languageIdCodeMappingNoDuplicates [$key] = $this->languageIdMappings [$key] ['code'];
			}
		}
		return $languageIdCodeMappingNoDuplicates;
	}
	
	public function getMappingForIdResolveAlias($languageId) {
		if (isset ( $this->languageIdMappings [$languageId] ['alias'] )) {
			return $this->getMappingForIdResolveAlias ( $this->languageIdMappings [$languageId] ['alias'] );
		}
		if (isset ( $this->languageIdMappings [$languageId] )) {
			return $this->languageIdMappings [$languageId];
		}
		throw new InvalidConfigException ( 'error: the given language parameter with value \'' . $languageId . '\' is not valid. Configured the language ID in the module configuration.' );
	}
	
	public function getConfiguredIdLanguagesMappingTranslated($languageIdToGetTranslationsFor) {
		$languageIdCodeMapping = [ ];
		if (isset ( $this->languageIdMappings [$languageIdToGetTranslationsFor] )) {
			$langCodeForTranslation = $this->getMappingForIdResolveAlias ( $languageIdToGetTranslationsFor )['code'];
		} else {
			Yii::error ( 'The specified language id is not configured in your module configuration. Will use default language (first specified language in module configuration): ' . $this->getDefaultLanguageId () . '. Please add a mapping for the id ' . $languageIdToGetTranslationsFor );
			$langCodeForTranslation = $this->getMappingForIdResolveAlias ( $this->getDefaultLanguageId () )['code'];
		}
		
		foreach ( $this->languageIdMappings as $key => $languageIdMapping ) {
			if (! isset ( $languageIdMapping ['alias'] )) {
				if (isset ( $languageIdMapping ['displaytext'] [$langCodeForTranslation] )) {
					$languageIdCodeMapping [$key] = $languageIdMapping ['displaytext'] [$langCodeForTranslation];
				} else {
					$languageIdCodeMapping [$key] = reset ( $languageIdMapping ['displaytext'] );
				}
			}
		}
		return $languageIdCodeMapping;
	}
}
