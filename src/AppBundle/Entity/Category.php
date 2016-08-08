<?php

namespace Entity\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package Entity\Entity
 * @ORM\Entity(name="category")
 */

class Category {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="id")
     * @ORM\JoinColumn(name="id", referencedColumnName="category")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $article_num;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;
}