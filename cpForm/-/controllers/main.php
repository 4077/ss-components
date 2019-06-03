<?php namespace ss\components\cpForm\controllers;

class Main extends \Controller
{
    public $pivot;

    public $pivotXPack;

    public $pivotData;

    public $basePath;

    public $triggerEvents = true;

    public function __create()
    {
        if ($this->pivot = $this->unpackModel('pivot')) {
            $this->_instance() or $this->instance_($this->pivot->id);

            $this->pivotXPack = xpack_model($this->pivot);
            $this->pivotData = _j($this->pivot->data);

            $this->dmap('|', 'fields, base_path, trigger_events');

            $this->basePath = $this->data('base_path');

            if (null !== $triggerEvents = $this->data('trigger_events')) {
                $this->triggerEvents = $triggerEvents;
            }
        } else {
            $this->lock();
        }
    }

    public function pivotData($path = false)
    {
        return ap($this->pivotData, $path);
    }

    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $v = $this->v('|');

        $fields = $this->data('fields');

        foreach ($fields as $field) {
            if ($this->checkRequirements($field)) {
                $v->assign('field', [
                    'PATH'        => $field['path'],
                    'LABEL'       => $field['label'] ?? '',
                    'LEVEL_CLASS' => 'l' . ($field['level'] ?? 1),
                    'CLASS'       => $field['class'] ?? ''
                ]);

                $controls = $field['controls'] ?? [$field['control']];

                foreach ($controls as $control) {
                    if ($this->checkControlRequirements($control)) {
                        $v->assign('field/control', [
                            'CONTENT' => $this->controlView($field['path'], $control)
                        ]);
                    }
                }
            }
        }

        $this->css();

        return $v;
    }

    private function checkRequirements($field)
    {
        if ($requirements = ap($field, 'require')) {
            $pass = true;

            foreach ($requirements as $requirement) {
                if (is_string($requirement)) {
                    $pass = $pass && $this->c($requirement, ap($this->pivotData, $this->basePath));
                } else {
                    $operandA = $this->pivotData(path($this->basePath, $requirement['path']));
                    $operandB = $requirement['value'];
                    $operator = $requirement['operator'];

                    if ($operator == '==') {
                        $pass = $pass && $operandA == $operandB;
                    }
                }
            }

            return $pass;
        }

        return true;
    }

    private function checkControlRequirements($control)
    {
        if ($requirements = ap($control, '1/require')) {
            $pass = true;

            foreach ($requirements as $requirement) {
                if (is_string($requirement)) {
                    $pass = $pass && $this->c($requirement, ap($this->pivotData, $this->basePath));
                } else {
                    $operandA = $this->pivotData(path($this->basePath, $requirement['path']));
                    $operandB = $requirement['value'];
                    $operator = $requirement['operator'];

                    if ($operator == '==') {
                        $pass = $pass && $operandA == $operandB;
                    }
                }
            }

            return $pass;
        }

        return true;
    }

    private function controlView($pivotDataPath, $controlData)
    {
        $name = $controlData[0];
        $data = $controlData[1];

        $data['trigger_events'] = $this->triggerEvents;

        $data['pivot_data_path'] = $controlData[1]['pivot_data_path'] ?? $pivotDataPath;

        if ($this->basePath) {
            $data['pivot_data_path'] = path($this->basePath, $data['pivot_data_path']);
        }

        return $this->c('>controls/' . $name . ':view|', $data);
    }
}
