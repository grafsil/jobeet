<?php
// lib/Jobeet.class.php
class Jobeet
{
  static public function slugify($text)
  {
    // replace all non letters or digits by -
    $text = preg_replace('/\W+/', '-', $text);
 
    // trim and lowercase
    $text = strtolower(trim($text, '-'));
 
    return $text;
  }
public function save(Doctrine_Connection $conn = null)
{
  if ($this->isNew() && !$this->getExpiresAt())
  {
    $now = $this->getCreatedAt() ? $this->getDateTimeObject('created_at')->format('U') : time();
    $this->setExpiresAt(date('Y-m-d H:i:s', $now + 86400 * sfConfig::get('app_active_days')));
  }
 
  return parent::save($conn);
}
}