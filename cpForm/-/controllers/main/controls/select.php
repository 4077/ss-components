<?php namespace ss\components\cpForm\controllers\main\controls;

class Select extends \ss\components\cpForm\controllers\main\controlsBaseControllers\View
{
    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $v = $this->v('|');

        $items = $this->data('items') ?: $this->_call($this->data('items_call'))->perform();

        $selectData = [
            'path'     => '>xhr:select|',
            'data'     => [
                'x' => $this->xhrData
            ],
            'class'    => $this->data('class') . ($this->value ? ' enabled' : ''),
            'items'    => $items,
            'selected' => $this->value
        ];

        $v->assign('CONTENT', $this->c('\std\ui select:view', $selectData));

        $this->css();

        return $v;
    }
}
