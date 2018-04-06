<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace johnsnook\sbadmin;

/**
 * Description of PageAction
 *
 * @author John
 */
class Pages {

    public static function extractContent($name, &$view) {
        $dir = __DIR__ . '/sb-admin/';
        $file = $dir . $name . '.html';
        if (!file_exists($file)) {
            throw new \yii\web\NotFoundHttpException($name . '.html was not found in the sb-admin directory.');
        }
        $searchClass = 'container-fluid';
        if (array_search($name, ['login', 'register', 'forgot-password']) !== FALSE) {
            $searchClass = 'container';
        }
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTMLFile($file, LIBXML_NOWARNING);
        $divs = $dom->getElementsByTagName('div');
        foreach ($divs as $div) {
            if ($div->hasAttribute('class')) {
                if ($div->getAttribute('class') === $searchClass) {
                    return $dom->saveHTML($div);
                }
            }
        }
    }

}
