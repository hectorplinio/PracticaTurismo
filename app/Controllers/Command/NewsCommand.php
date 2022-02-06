<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Entities\News;
use App\Models\NewsModel;
use CodeIgniter\CLI\CLI;

use SimpleXMLElement;

class NewsCommand extends BaseController
{
    public function newsCommand()
    {
        $arrContextOptions=array(
            "ssl" => array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $response = file_get_contents("https://www.cuencanews.es/rss/ultimasNoticias/", false, stream_context_create($arrContextOptions));
        $data = new SimpleXMLElement($response);
        //Asi se imprime el objeto con todo lo que tiene dentro
        $items = $data->channel->item;
        $x=0;
        foreach($items as $item){
            $media= $item->children('http://search.yahoo.com/mrss/');
            $img = $media->content->attributes()->url;
            $x=$x+1;
            $new = new NewsModel();
            $title = $item->title;
            $description = $item->description;
            $pubDate = $item->pubDate;
            $newTime=new News();
            $time=$newTime->getDateInputFormat($pubDate);
            $guid = $item->guid;
            $link = $item->link;
            $news = $new->findGuid($guid);
            if($news){
                $id = $news->id;
                $data= array(
                    "id" => $id,
                    "title" => $title,
                    "description" => $description,
                    "pubDate" => $time,
                    "guid" => $guid,
                    "url" => $link,
                    "img_url" => $img
                );
                $new->save($data);
                CLI::write("Data of news save sucessfull");
            }else{
                $data= array(
                    "title" => $title,
                    "description" => $description,
                    "pubDate" => $time,
                    "guid" => $guid,
                    "url" => $link,
                    "img_url" => $img
                );
                $new->insert($data);
                CLI::write("Data of news created sucessfull");
            }
        }
    }
}
