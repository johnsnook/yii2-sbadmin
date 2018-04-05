<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace johnsnook\sbadmin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Controller for sample SBAdmin pages
 *
 * @author John
 */
class SbAdminController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['pages'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays example pages for SBAdmin.
     *
     * @return string
     */
    public function actionPages($name) {
        if (array_search($name, ['login', 'register', 'forgot-password']) !== FALSE) {
            $this->layout = 'modal';
        }
        return $this->renderContent($this->extractContent($name, $this->view));
    }

    private function extractContent($name, &$view) {
        $dir = __DIR__ . '/../sb-admin/';
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
