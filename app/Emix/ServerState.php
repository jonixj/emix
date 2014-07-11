<?php namespace Emix;

use Jenssegers\MongoDB\Model as Eloquent;

/**
 * Class ServerState
 * @package Emix
 * @property array measures
 */
class ServerState extends Eloquent
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function node()
    {
        return $this->belongsTo('Emix\Node');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function container()
    {
        return $this->belongsTo('Emix\Container');
    }

    /**
     * This method gets called each time we get $this->measures
     * The method casts the serialized measure array into a real measure object
     *
     * @param $array
     * @return array
     */
    protected function getMeasuresAttribute($array)
    {
        if (!is_array($array)) {
            return [];
        }
        if (isset($array['name'])) {
            $array = [$array];
        }
        $measures = [];
        foreach ($array as $measure) {
            $measures[] = Measure::fromArray($measure);
        }
        return $measures;
    }

    /**
     * This method gets called each time we set $this->measures
     * The method casts the real measure objects to a arrays
     *
     * @param $measures
     */
    public function setMeasuresAttribute($measures)
    {
        $mArray = [];
        foreach ($measures as $measure) {
            $mArray[] = $measure->toArray();
        }

        $this->attributes['measures'] = $mArray;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['measures'] = [];
        foreach ($this->measures as $measure) {
            $array['measures'][] = $measure->toArray();
        }
        return $array;
    }


    /**
     * @param Measure $newMeasure
     * @return $this
     */
    public function addMeasure(Measure $newMeasure)
    {
        $key = $this->measureExists($newMeasure);

        if (is_int($key)) {
            $this->replaceMeasure($newMeasure, $key);
        } else {
            $this->appendMeasure($newMeasure);
        }

        return $this;
    }

    /**
     * @param Node $node
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setNode(Node $node)
    {
        return $this->node()->associate($node);

        return $this;
    }

    /**
     * @param Container $container
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setContainer(Container $container)
    {
        return $this->container()->associate($container);
    }

    /**
     * @param Measure $newMeasure
     * @return int|boolean
     */
    protected function measureExists(Measure $newMeasure)
    {
        if (!is_array($this->measures)) {
            return false;
        }

        foreach ($this->measures as $key => $measure) {
            if ($measure->compareTo($newMeasure) === 0) {
                return $key;
            }
        }

        return false;
    }

    /**
     * @param Measure $newMeasure
     * @param $key
     */
    protected function replaceMeasure(Measure $newMeasure, $key)
    {
        // For some reason we can only replace this->measures (not modify it)
        $current = $this->measures;
        $current[$key] = $newMeasure;
        $this->measures = $current;
    }

    /**
     * @param Measure $newMeasure
     */
    protected function appendMeasure(Measure $newMeasure)
    {
        $this->measures = array_merge($this->measures, [$newMeasure]);
    }

}