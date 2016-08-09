<?php

namespace Entity\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; // generiranje konstruktora?

/**
 * Class Category
 * @package Entity\Entity
 * @ORM\Entity
 * @ORM\Table(name="category")
 */

class Category {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="categories")
     */
    private $articles;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;
}