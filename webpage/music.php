<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Music Viewer</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="viewer.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div id="header">
        
            <h1>190M Music Playlist Viewer</h1>
            <h2>Search Through Your Playlists and Music</h2>
        </div>
        <div id="listarea">
            <ul id="musiclist">
            <?php 
            if(isset($_REQUEST["playlist"]))
                {
                $listing = $_REQUEST["playlist"];
                $list = file("./songs/{$listing}");
                foreach($list as $mp3){
                    
                    $fileofsize = filesize("./songs/".trim($mp3));
                ?>
                <li class ="mp3item">
                    <a href="<?php print $mp3;?>"><?php print basename($mp3);?></a>
                    <?php
                    if($fileofsize>=0 && $fileofsize<=1023) 
                        print "(".$fileofsize." b)";
                    else if($fileofsize>=1024 && $fileofsize<=1048575)
                    {
                        $kilobyte = round($fileofsize/1024,2);
                        print "(".$kilobyte." Kb)";
                    }
                    else if($fileofsize>=1048576){
                        $mb = round($fileofsize/1048576,2);
                        print "(".$mb." Mb)";
                    }
                    ?>
                </li>
                <?php }
                }
            else{
                foreach(glob("./songs/*.mp3") as $file){
                    $fileofsize = filesize($file);
                ?>
                <li class="mp3item">
                    <a href="<?php print $file;?>"><?php print basename($file);?></a>
                    <?php
                    if($fileofsize>=0 && $fileofsize<=1023) 
                        print "(".$fileofsize." b)";
                    else if($fileofsize>=1024&&$fileofsize<=1048575){
                        $kb = round($fileofsize/1024,2);
                        print "(".$kb." Kb)";
                    }
                    else if($fileofsize>=1048576){
                        $mb = round($fileofsize/1048576,2);
                        print "(".$mb." Mb)";
                    }
                    ?>
                </li>
                <?php }
                foreach(glob("./songs/*.txt") as $playlist){    
                ?>
                <li class="playlistitem"><a href="<?php print $playlist;?>"><?php print basename($playlist);?></a></li>
                <?php }
            }
            ?>
            </ul>
        </div>
        <?php
        ?>
        
    </body>
</html>