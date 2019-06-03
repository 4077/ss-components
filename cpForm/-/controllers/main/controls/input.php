<?php namespace ss\components\cpForm\controllers\main\controls;

class Input extends \ss\components\cpForm\controllers\main\controlsBaseControllers\View
{
    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $pivotDataPath = $this->data('pivot_data_path');

        $viewInstance = md5($this->form->pivot->id . '/' . $pivotDataPath);

        $v = $this->v('|' . $viewInstance);

        $attrs = $this->data('attrs') ?? [];

        ra($attrs, [
            'value' => $this->value
        ]);

        $v->assign('CONTENT', $this->c('\std\ui tag:view:input', [
            'attrs' => $attrs
        ]));

        $this->css();

        $this->widget(':|' . $viewInstance, [
            '.payload' => [
                'x' => $this->xhrData
            ],
            '.r'       => [
                'update' => $this->_p('>xhr:update|')
            ]
        ]);

        return $v;
    }
}
