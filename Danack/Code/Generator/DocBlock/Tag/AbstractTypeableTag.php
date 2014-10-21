<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Danack\Code\Generator\DocBlock\Tag;

use Danack\Code\Generator\AbstractGenerator;

/**
 * This abstract class can be used as parent for all tags
 * that use a type part in their content.
 * @see http://www.phpdoc.org/docs/latest/for-users/phpdoc/types.html
 */
abstract class AbstractTypeableTag extends AbstractGenerator
{
    /**
     * @var string
     */
    protected $description = null;

    /**
     * @var array
     */
    protected $types = array();

    /**
     * @param array $types
     * @param string $description
     */
    public function __construct($types = array(), $description = null)
    {
        if (!empty($types)) {
            $this->setTypes($types);
        }

        if (!empty($description)) {
            $this->setDescription($description);
        }
    }

    /**
     * @param string $description
     * @return ReturnTag
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Array of types or string with types delimited by pipe (|)
     * e.g. array('int', 'null') or "int|null"
     *
     * @param array|string $types
     * @return ReturnTag
     */
    public function setTypes($types)
    {
        if (is_string($types)) {
            $types = explode('|', $types);
        }
        $this->types = $types;
        return $this;
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param string $delimiter
     * @return string
     */
    public function getTypesAsString($delimiter = '|')
    {
        $addSlash = function ($type) {
            if (strcasecmp($type, 'array') === 0 ||
                strcasecmp($type, 'callable') === 0) {
                return $type;
            } else if ($type && !in_array($type, static::$simple)) {
                return '\\'.ltrim($type, '\\');
            }

            return $type;
        };
        
        $types = array_map($addSlash, $this->types);
       
        
        
        return implode($delimiter, $types);
    }
}
