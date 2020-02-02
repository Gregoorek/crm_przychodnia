<?php


namespace App\Partial;

use Doctrine\ORM\Mapping as ORM;

trait IdAwareTrait
{
    /**
     * @var int
     * @ORM\Column(type="integer" ,nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}