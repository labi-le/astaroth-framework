<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="example")
 */
class Example
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Example
     */
    public function setId(string $id): Example
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Example
     */
    public function setTitle(string $title): Example
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @Id
     * @Column(type="integer", unique=true, nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private string $id;

    /**
     * @Column(type="string", nullable=true)
     */
    private ?string $title;
}