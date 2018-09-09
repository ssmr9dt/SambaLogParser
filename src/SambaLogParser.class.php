<?php

namespace ssmr9dt;

class SambaLogParser
{
  private $raw = [];
  private $lines = [];
  
  public function addFile($src)
  {
    if (!file_exists($src)) { return; }
    $raw = file($src, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $this->setRaw($raw);
    $this->process();
  }
  
  public function getLines()
  {
    return $this->lines;
  }
  
  public function getTimestamps()
  {
    $res = [];
    for ($i=0,$i_c=count($this->lines); $i<$i_c; $i++)
    {
      $res[] = strtotime($this->lines[$i]);
    }
    return $res;
  }
  
  private function setRaw($raw)
  {
    $this->raw = $raw;
  }
  
  private function process()
  {
    for ($i=0,$i_c=count($this->raw); $i<$i_c; $i++)
    {
      $line = $this->raw[$i];
      $p = $this->parse($line);
      if (!empty($p))
      {
        $this->lines[] = $p;
      }
    }
  }
  
  private function parse($line)
  {
    $pattern = "/[0-9]{4}(\/[0-9]{2}){2} [0-9]{2}(:[0-9]{2}){2}/";
    if (!preg_match($pattern, $line, $m))
    {
      return "";
    }
    return $m[0];
  }
}
