<?php

namespace app\controllers;

use app\models\Book;
use yii\rest\ActiveController;
use yii\base\DynamicModel;

class BookController extends ActiveController
{
   public $enableCsrfValidation = false;

   public $modelClass = Book::class;

   public function behaviors()
   {
      $behaviors = parent::behaviors();

      $behaviors['authenticator'] = [
         'class' => \matheust45\jwt\JwtHttpBearerAuth::class,
      ];

      return $behaviors;
   }

   public function actions()
   {
      $actions = parent::actions();
      
      $actions['index']['dataFilter'] = [
         'class' => \yii\data\ActiveDataFilter::class,
         'attributeMap' => [
            'totalPages' => 'total_pages',
        ],
         'searchModel' => (new DynamicModel(['id', 'title', 'description','author','totalPages']))
            ->addRule(['id'], 'integer')
            ->addRule(['title'], 'string', ['max' => 200])
            ->addRule(['description'], 'string', ['max' => 200])
            ->addRule(['author'], 'string', ['max' => 200])
            ->addRule(['totalPages'], 'integer'),
      ];
      
      return $actions;
   }
}