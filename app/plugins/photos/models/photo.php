<?php
class Photo extends PhotosAppModel 
{
 var $name = 'Photo';
 var $useTable = 'photos_photos';
 var $actsAs = array('Publishable'); 
 var $belongsTo = array('Album' => array('className' => 'Photos.Album', 'foreignKey' => 'photos_album_id'));
}
?>