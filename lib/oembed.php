<?php

return [
    'extends' => 'url',
    'computed' => [
        // 'value' => function() {
        //     return $this->value;
        // },
        'embed' => function() {
            $yaml = Yaml::decode($this->value);
            return count($yaml) ? $yaml : $this->value;
        }
    ]
];
