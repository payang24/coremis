<?php

/*
 * This file is part of the simple-cms project for Yii2
 *
 * (c) Schallschlucker Agency Paul Kerspe - project homepage <https://github.com/pkerspe/yii2-simple-cms>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace schallschlucker\simplecms\models;

use Yii;
use yii\base\Model;

class MediaVariationManagerUpload extends Model {
	
	public $parentMediaId;
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
			'parentMediaId' => Yii::t ( 'simplecms', 'parent media id' ),
			'file' => Yii::t ( 'simplecms', 'files' ),
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
			[['parentMediaId','file'],'required'],
			[['file'], 'file', 'maxFiles' => 10],
			[['parentMediaId'], 'integer', 'min' => 1],
		];
	}
}
?>
