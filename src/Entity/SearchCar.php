<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SearchCar
{
  #[Assert\LessThan(propertyPath: "maxYear", message: "The maximum year is not set correctly")]
  private $minYear;
  private $maxYear;

  public function getMinYear()
  {
    return $this->minYear;
  }

  public function getMaxYear()
  {
    return $this->maxYear;
  }

  public function setMinYear(int $minYear)
  {
    $this->minYear = $minYear;
  }

  public function setMaxYear(int $maxYear)
  {
    $this->maxYear = $maxYear;
  }
}
