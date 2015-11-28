<?php

//
// Dir class holds the information about one directory in the list
//
class Dir
{
    var $name;
    var $location;
    var $modTime;

    //
    // Constructor
    //
    function Dir($name, $location)
    {
        $this->name = $name;
        $this->location = $location;

        $this->modTime = filemtime($this->location->getDir(true, false, false, 0).$this->getName());
    }

    function getName()
    {
        return $this->name;
    }

    function getNameHtml()
    {
        return htmlspecialchars($this->name);
    }

    function getNameEncoded()
    {
        return rawurlencode($this->name);
    }

    function getModTime()
    {
        return $this->modTime;
    }

    //
    // Debugging output
    //
    function debug()
    {
        print("Dir name (htmlspecialchars): ".$this->getName()."\n");
        print("Dir location: ".$this->location->getDir(true, false, false, 0)."\n");
        print("Dir modTime: ".$this->modTime."\n");
    }
}
