<?php
/**
 * Calendarize plugin for Craft CMS 3.x
 *
 * Calendar element types
 *
 * @link      https://union.co
 * @copyright Copyright (c) 2018 Franco Valdes
 */

namespace unionco\calendarize\models;

use unionco\calendarize\Calendarize;

use Craft;
use craft\base\Model;

/**
 * @author    Franco Valdes
 * @package   Calendarize
 * @since     1.0.0
 */
class Settings extends Model
{
    /**
     * Whether time changes should be allowed on the field.
     *
     * @var bool
     */
    public bool $allowTimeChanges = true;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['allowTimeChanges'], 'boolean'],
            [['allowTimeChanges'], 'required']
        ];
    }
}
