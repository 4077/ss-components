<?php namespace ss\components\cpForm\controllers\main\controls\switcher;

class Xhr extends \ss\components\cpForm\controllers\main\controlsBaseControllers\Xhr
{
    public $allow = self::XHR;

    public function switch()
    {
        if ($value = _j64($this->data('value'))) {
            ss()->cats->apComponentPivotData($this->pivot, $this->path, $value);

            $this->triggerEvents();

            $this->performCallback(['value' => $value]);

            $this->reload();
        }
    }
}
