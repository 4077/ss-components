<?php namespace ss\components\cpForm\controllers\main\controlsBaseControllers;

abstract class Xhr extends \Controller
{
    public $allow = self::XHR;

    protected $pivot;

    protected $path;

    protected $callback;

    protected $triggerEvents;

    public function __create()
    {
        if ($data = _j64($this->data('x'))) {
            $this->pivot = unxpack_model($data['pivot']);
            $this->path = $data['path'];
            $this->callback = $data['callback'];
            $this->triggerEvents = $data['trigger_events'];
        }
    }

    protected function triggerEvents()
    {
        if ($this->triggerEvents) {
            pusher()->trigger('ss/container/' . $this->pivot->cat_id . '/update_pivot');
        }
    }

    protected function performCallback($ra = [])
    {
        if (null !== $this->callback) {
            ra($ra, [
                'pivot' => $this->pivot,
                'path'  => $this->path
            ]);

            $this->_call($this->callback)->ra($ra)->perform();
        }
    }

    protected function reload()
    {
        $this->c('~:reload|', [
            'pivot' => $this->pivot
        ]);
    }
}
