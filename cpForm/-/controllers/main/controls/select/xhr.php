<?php namespace ss\components\cpForm\controllers\main\controls\select;

class Xhr extends \ss\components\cpForm\controllers\main\controlsBaseControllers\Xhr
{
    public $allow = self::XHR;

    public function select()
    {
        $value = $this->data('value');

        ss()->cats->apComponentPivotData($this->pivot, $this->path, $value);

        $this->triggerEvents();

        $this->performCallback(['value' => $value]);
    }
}
