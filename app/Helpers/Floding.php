<?php
    function Floding($string) {
        $kata = preg_replace('/[^A-Za-z\-]/', '', $string);
        return $kata;
    }
