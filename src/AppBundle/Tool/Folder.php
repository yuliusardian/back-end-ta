<?php
/**
 * Created by PhpStorm.
 * User: yuliusardian
 * Date: 12/4/18
 * Time: 10:12 PM
 */

namespace AppBundle\Tool;

use Pimcore\Model\Asset;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Folder as FolderObjectAbstract;
use Pimcore\Model\Asset\Folder as FolderAssetAbstract;

class Folder
{
    /**
     * check folder in object
     * @param string $path
     * @return FolderObjectAbstract
     */
    public static function checkAndCreate($path, $parent = null)
    {
        $key = $path;
        if ($parent) {
            $parent = DataObject::getById($parent->getId());
        }
        if ($parent instanceof DataObject) {
            $path = $parent->getFullPath() . '/' . $path;
            $parent = $parent->getId();
        }
        $folder = DataObject::getByPath('/' . $path);
        if ($folder) {
            return $folder;
        } else {
            $folder = FolderObjectAbstract::create(array(
                'o_parentId' => ($parent !== null) ? $parent : 1,
                'o_creationDate' => time(),
                'o_userOwner' => 0,
                'o_userModification' => 0,
                'o_key' => $key,
                'o_published' => true,
            ));

            return $folder;
        }
    }

    public static function checkAndCreateAssets($path, $parent = null)
    {
        $key = $path;
        if ($parent instanceof Asset) {
            $path = $parent->getFullPath() . '/' . $path;
            $parent = $parent->getId();
        }

        $folder = Asset::getByPath('/' . $path);
        $parentId = ($parent !== null) ? $parent : 1;
        if ($folder) {
            return $folder;
        } else {
            $folder = FolderAssetAbstract::create($parentId, array(
                'userOwner' => 0,
                'userModification' => 0,
                'type' => 'folder',
                'filename' => $key
            ));

            return $folder;
        }
    }
}
