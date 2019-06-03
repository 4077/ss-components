<?php namespace ss\components\cpForm\controllers\main\controls\toggle;

class Xhr extends \ss\components\cpForm\controllers\main\controlsBaseControllers\Xhr
{
    public $allow = self::XHR;

    public function toggle()
    {
        $newValue = ss()->cats->invertComponentPivotData($this->pivot, $this->path);

        $this->triggerEvents();

        $this->performCallback(['value' => $newValue]);

        $this->reload();
    }
}
