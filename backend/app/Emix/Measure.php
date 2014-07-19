<?php namespace Emix;

use \DateTime;

/**
 * Class Measure
 * @package Emix
 */
class Measure
{

    /**
     * @var string
     */
    protected $name;
    /**
     * @var mixed
     */
    public $value;
    /**
     * @var \DateTime
     */
    public $created_at;

    /**
     * @param $name
     * @param $value
     * @param DateTime $created_at
     */
    function __construct($name, $value, DateTime $created_at = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->created_at = is_null($created_at) ? new DateTime() : $created_at;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return (string) $this->value;
    }

    /**
     * Creates a new instance from an array
     * @param $array
     * @return Measure
     * @throws \InvalidArgumentException
     */
    public static function fromArray($array)
    {
        try {
            return new Measure($array['name'], $array['value'], new \DateTime($array['created_at']['date']));
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("The supplied array is not valid");
        }

    }

    /**
     * @return array
     */
    function toArray()
    {
        return [
            'name' => $this->getName(),
            'value' => $this->getValue(),
            'created_at' => $this->getCreatedAt()
        ];
    }

    /**
     * @param Measure $otherMeasure
     * @return int
     */
    public function compareTo(Measure $otherMeasure)
    {
        return strcmp($this->name, $otherMeasure->name);
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

}