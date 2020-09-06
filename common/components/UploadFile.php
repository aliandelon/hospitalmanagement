<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class UploadFile extends Component {

        public function uploadProfilePic($file, $stdFolder, $imagename) {
                $target = \Yii::$app->basePath . '/../uploads/profilepic/' . $stdFolder;
                if (!file_exists($target)) {
                        mkdir($target, 0777, true);
                }

                if ($file->saveAs($target . '/' . $imagename)) {
                        return true;
                } else {
                        return false;
                }
        }

        public function getBannerPath() {
                switch ($position) {
                        case 1:
                                // About Us
                                $path = dirname(yii\helpers\Url::base()) . '\uploads\banner\about.jpg';
                                break;
                        default :
                                $path = dirname(yii\helpers\Url::base()) . '\uploads\no_image.jpg';
                }
                return $path;
        }

        public function getCurrencyPath($id, $extension) {

                $path = dirname(yii\helpers\Url::base()) . "\uploads\currency\\" . $id . "." . $extension;
                return $path;
        }

        public function getImagePath($type, $model) {

                switch ($type) {
                        case "dest_main_image" :
                                $fpath = "destination\\";
                                $extension = $model->image;
                                break;
                        case "testimonials":
                                $fpath = "testimonials/author";
                                $extension = $model->author_images;
                                break;
                        default :
                                $fpath = $type;
                                $extension = $model->image;
                }

                $path = dirname(yii\helpers\Url::base()) . "\uploads\\" . $fpath . "\\" . $model->id . "." . $extension;
                return $path;
        }

        public function folderName($min, $max, $id) {
                if ($id > $min && $id < $max) {
                        return $max;
                } else {
                        $xy = $this->folderName($min + 1000, $max + 1000, $id);
                        return $xy;
                }
        }

        public function fileExists($path, $name, $file, $sufix) {

                if (file_exists($path . $name)) {
                        $name = basename($path . $file->name, '.' . $file->main_image) . '_' . $sufix . '.' . $file->main_image;
                        return $this->fileExists($path, $name, $file, $sufix + 1);
                } else {
                        return $name;
                }
        }

        public function uploadDestinationImage($uploadfile, $id, $foldername = false) {
//        print_r($uploadfile);exit;
                if ($foldername) {
                        $folder = $this->folderName(0, 1000, $id) . '/';
                } else {
                        $folder = "";
                }

                if (isset($uploadfile)) {
                        if (\yii::$app->basePath . '/../uploads/destinations') {
                                chmod(\yii::$app->basePath . '/../uploads/destinations', 0777);
                                if ($foldername) {
                                        if (!is_dir(\yii::$app->basePath . '/../uploads/destinations/' . $folder))
                                                mkdir(\yii::$app->basePath . '/../uploads/destinations/' . $folder);
                                        chmod(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/', 0777);

                                        if (!is_dir(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id))
                                                mkdir(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id);
                                        chmod(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/', 0777);
                                }
                                if ($uploadfile->saveAs(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/' . $id . '.' . $uploadfile->extension)) {
                                        chmod(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/' . $id . '.' . $uploadfile->extension, 0777);

                                        $file = \yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/' . $id . '.' . $uploadfile->extension;
                                        $path = \yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id;
                                }
                        }
                }
        }

        public function uploadDestinationGallery($files, $id, $foldername = false) {

                if ($foldername) {
                        $folder = $this->folderName(0, 1000, $id) . '/';
                } else {
                        $folder = "";
                }

                if (\yii::$app->basePath . '/../uploads') {
                        chmod(\yii::$app->basePath . '/../uploads', 0777);

                        if (!is_dir(\yii::$app->basePath . '/../uploads/destinations/')) {
                                mkdir(\yii::$app->basePath . '/../uploads/destinations/');
                                chmod(\yii::$app->basePath . '/../uploads/destinations/', 0777);
                        }
                        if ($foldername) {
                                if (!is_dir(\yii::$app->basePath . '/../uploads/destinations/' . $folder)) {
                                        mkdir(\yii::$app->basePath . '/../uploads/destinations/' . $folder);
                                        chmod(\yii::$app->basePath . '/../uploads/destinations/' . $folder, 0777);
                                }
                                if (!is_dir(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/')) {
                                        mkdir(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/');
                                        chmod(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/', 0777);
                                }
                                if (!is_dir(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/gallery/')) {
                                        mkdir(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/gallery/');
                                        chmod(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/gallery/', 0777);
                                }
                        }
                        foreach ($files as $file) {
                                $file->saveAs(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/gallery/' . $file->name);
                                chmod(\yii::$app->basePath . '/../uploads/destinations/' . $folder . '/' . $id . '/gallery/' . $file->name, 0777);
                        }
                        return true;
                }
        }

        public function getDestinationImage($type, $model, $foldername = false, $image) {

                if ($foldername) {
                        $folder = $this->folderName(0, 1000, $model->id) . '/';
                } else {
                        $folder = "";
                }
                if ($type == "main_image") {
                        $path = dirname(yii\helpers\Url::base()) . '/uploads/destinations/' . $folder . '/' . $model->id . '/' . $model->id . '.' . $model->main_image;
                } elseif ($type == "gallery") {
                        $path = dirname(yii\helpers\Url::base()) . '/uploads/destinations/' . $folder . '/' . $model->id . '/gallery/' . $image;
                } else {
                        $path = dirname(yii\helpers\Url::base()) . '\uploads\no_image.jpg';
                }
                return $path;
        }

}
