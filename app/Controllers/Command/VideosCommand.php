<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\VideosModel;
use CodeIgniter\CLI\CLI;
use PhpParser\Builder\Class_;
use SimpleXMLElement;

class VideosCommand extends BaseController
{
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
        //Asi se imprime el objeto con todo lo que tiene dentro
        //CLI::write($response);
        $items = $data->entry;
        CLI::write($items);
        $x=0;
        foreach($items as $item){
            CLI::write($item->id);
            $x=$x+1;
            $video = new VideosModel();
            $title = $item->title;
            $description = $item->media;
            CLI::write($description);
            foreach($description as $a){
                CLI::write($a);
            }
            $pubDate = $item->published;
            //$newTime=new News();
            //php /Applications/MAMP/htdocs/Codeigniter/PracticaTurismo/public/index.php /commands/commandVideos
            //$time=$newTime->getDateInputFormat($pubDate);
            // CLI::write($time);
            $guid = $item->yt->videoId;
            // $link = $item->link;
            // $news = $new->findGuid($guid);
            // if($news){
            //     $id = $news->id;
            //     $data= array(
            //         "id" => $id,
            //         "title" => $title,
            //         "description" => $description,
            //         "pubDate" => $time,
            //         "guid" => $guid,
            //         "url" => $link,
            //     );
            //     $new->save($data);
            //     CLI::write("Datos guardados con exito");
            // }else{
            //     $data= array(
            //         "title" => $title,
            //         "description" => $description,
            //         "pubDate" => $time,
            //         "guid" => $guid,
            //         "url" => $link,
            //     );
            //     $new->insert($data);
            //     CLI::write("Datos creados con exito");
            // }
        }
    }
}
