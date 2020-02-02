<?php


namespace App\Entity;

use App\Partial\IdAwareInterface;
use App\Partial\IdAwareTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class specjalization
 * @package App\Entity
 * @ORM\Entity()
 */

class Specjalization implements IdAwareInterface
{
    use IdAwareTrait;                                      //src/Partial/IdAwareTrait.php


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function __toString():string
    {
        return $this->name;
    }
}