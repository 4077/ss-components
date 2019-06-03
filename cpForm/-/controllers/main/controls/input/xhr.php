<?php namespace ss\components\cpForm\controllers\main\controls\input;

class Xhr extends \ss\components\cpForm\controllers\main\controlsBaseControllers\Xhr
{
    public $allow = self::XHR;

    public function update()
    {
        ss()->cats->apComponentPivotData($this->pivot, $this->path, $this->data('value'));

        $viewInstance = md5($this->pivot->id . '/' . $this->path);

        $this->widget('<:|' . $viewInstance, 'savedHighlight');

        $this->triggerEvents();
    }
}
