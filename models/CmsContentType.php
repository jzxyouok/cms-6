<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010-2014 SkeekS (Sx)
 * @date 09.11.2014
 * @since 1.0.0
 */

namespace skeeks\cms\models;

use skeeks\cms\base\Widget;
use skeeks\cms\components\Cms;
use skeeks\cms\helpers\UrlHelper;
use skeeks\cms\models\behaviors\HasMultiLangAndSiteFields;
use skeeks\cms\models\behaviors\HasStatus;
use skeeks\cms\models\behaviors\TimestampPublishedBehavior;
use Yii;

/**
 * This is the model class for table "cms_content_type".
 *
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $priority
 * @property string $name
 * @property string $code
 *
 * @property CmsContent[] $cmsContents
 */
class CmsContentType extends Core
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_content_type}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'priority' => Yii::t('app', 'Priority'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'priority'], 'integer'],
            [['name', 'code'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 32],
            [['code'], 'unique'],
            ['code', 'default', 'value' => function($model, $attribute)
            {
                return "sx_auto_" . md5(rand(1, 10) . time());
            }],
            ['priority', 'default', 'value' => function($model, $attribute)
            {
                return 500;
            }],
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsContents()
    {
        return $this->hasMany(CmsContent::className(), ['content_type' => 'code'])->orderBy("priority ASC")->andWhere(['active' => Cms::BOOL_Y]);
    }

}