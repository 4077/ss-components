<?php namespace ss\components\cpForm\controllers\main\controls;

class Toggle extends \ss\components\cpForm\controllers\main\controlsBaseControllers\View
{
    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $v = $this->v('|');

        $labels = $this->data('labels') ?? ['нет', 'да'];

        $buttonData = [
            'path'    => '>xhr:toggle|',
            'data'    => [
                'x' => $this->xhrData
            ],
            'class'   => $this->data('class') . ' button ' . ($this->value ? 'enabled' : ''),
            'content' => $this->value ? $labels[1] : $labels[0]
        ];

        $v->assign('CONTENT', $this->c('\std\ui button:view', $buttonData));

        $this->css();

        return $v;
    }
}
