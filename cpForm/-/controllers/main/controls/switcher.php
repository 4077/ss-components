<?php namespace ss\components\cpForm\controllers\main\controls;

class Switcher extends \ss\components\cpForm\controllers\main\controlsBaseControllers\View
{
    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $v = $this->v('|');

        $buttons = $this->data('buttons') ?? [];
        $class = $this->data('class');
        $classes = $this->data('classes');

        $selectedValue = $this->value;

        $switcherButtons = [];

        foreach ($buttons as $value => $button) {
            $switcherButtons[] = [
                'label' => $button['label'] ?? '',
                'value' => j64_($value),
                'class' => $button['class'] ?? '',
                'title' => $button['title'] ?? ''
            ];
        }

        $v->assign('CONTENT', $this->c('\std\ui\switcher~:view', [
            'path'    => $this->_p('>xhr:switch|'),
            'data'    => [
                'x' => $this->xhrData
            ],
            'value'   => j64_($selectedValue),
            'class'   => $class . ' switcher',
            'classes' => $classes,
            'buttons' => $switcherButtons
        ]));

        $this->css();

        return $v;
    }
}
