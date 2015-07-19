<?php
class PodcastFilesController extends AppController{
    public function saveAudioSource($file){
        if ($file['error'] === UPLOAD_ERR_OK) {
            $id = String::uuid();
            $podcastDir = $this->admin_var('podcast_files');
            if($podcastDir != null){
                $path = $podcastDir . $id . strrchr($file["name"], '.');
                if (move_uploaded_file($file['tmp_name'], $path)) {
                    $this->PodcastFile->create();
                    return $this->PodcastFile->save(array('path' => '/files/podcasts/' . $id . strrchr($file["name"], '.')));
                }
            } else {
                $this->Session->setFlash(__('You need to set the Podcast folder before uploading podcasts'));
                return false;
            }
        } else {
            return $file;
        }
    }

    public function saveGraphicSource($file){
        if ($file['error'] === UPLOAD_ERR_OK) {
            if($file["type"] = 'image/png' or $file["type"] = 'image/jpeg'){
                $type = explode('/',$file["type"])[1];
                $id = String::uuid();
                $imageDir = $this->admin_var('image_files');
                if($imageDir != null){
                    $path = $imageDir . $id . '.png';
                    if (move_uploaded_file($file['tmp_name'], $path)) {
                        return '/files/images/' . $id . '.' . $type;
                    }
                } else {
                    $this->Session->setFlash(__('You need to set the Image folder before uploading images'));
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}