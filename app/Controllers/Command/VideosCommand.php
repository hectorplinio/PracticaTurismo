<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\VideosModel;
use CodeIgniter\CLI\CLI;
use PhpParser\Builder\Class_;
use SimpleXMLElement;

class VideosCommand extends BaseController
{
    //php /Applications/MAMP/htdocs/Codeigniter/PracticaTurismo/public/index.php /commands/commandVideos

    public function videosCommand()
    {
        $arrContextOptions=array(
            "ssl" => array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $response = file_get_contents("https://www.youtube.com/feeds/videos.xml?channel_id=UChGnJ7SlRIfemRBZSniIvtg", false, stream_context_create($arrContextOptions));
        $data = new SimpleXMLElement($response);
        $items = $data->entry;
        foreach($items as $item){
            $media= $item->children('http://search.yahoo.com/mrss/');
            $video = new VideosModel();
            $title = $media->group->title;
            $description = $media->group->description;
            $img = $media->group->thumbnail->attributes()->url;
            $pubDate = $item->published;
            $time=$video->getDateInputFormat($pubDate);
            $url = $item->link->attributes()->href;
            $guid = $item->id;
            $guid= str_replace("yt:video:", "",$guid);
            $videoExist = $video->findVideosGuid($guid);
            if ($videoExist){
                $id = $videoExist->id;
                $data= array(
                            "id" => $id,
                            "title" => $title,
                            "description" => $description,
                            "pubDate" => $time,
                            "url" => $url,
                            "guid" => $guid,
                            "img_url" => $img,
                        );
                $video->save($data);
                CLI::write("Data of videos save sucessfull");
            }else{
                $data= array(
                    "title" => $title,
                    "description" => $description,
                    "pubDate" => $time,
                    "url" => $url,
                    "guid" => $guid,
                    "img_url" => $img,
                );
                $video->save($data);
                CLI::write("Data of videos created sucessfull");
            }
        }
    }
}
