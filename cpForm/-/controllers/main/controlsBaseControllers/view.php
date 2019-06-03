<?php namespace ss\components\cpForm\controllers\main\controlsBaseControllers;

abstract class View extends \Controller
{
    /**
     * @var \ss\components\cpForm\controllers\Main
     */
    protected $form;

    protected $xhrData;

    protected $value;

    public function __create()
    {
        $this->form = $this->_caller();

        $pivotDataPath = $this->data('pivot_data_path');

        $this->xhrData = j64_([
                                  'pivot'          => $this->form->pivotXPack,
                                  'path'           => $pivotDataPath,
                                  'callback'       => $this->data('callback'),
                                  'trigger_events' => $this->data('trigger_events')
                              ]);

        $this->value = $this->pivotData($pivotDataPath);
    }

    public function pivotData($path = false)
    {
        return $this->form->pivotData($path);
    }
}
