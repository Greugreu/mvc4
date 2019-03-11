<?php
namespace App\Weblitzer;
/**
 *  class View
 *  Helper pour les view
 */
class View
{
    /**
     * @param $link
     * @param $id null
     * @return $data
     */
    public function path($link,$id = null)
    {
        if($id === null) {
            $data = 'index.php?page='.$link;
        } else {
            $data = 'index.php?page='.$link.'&id='.$id;
        }
        return $data;
    }

}
