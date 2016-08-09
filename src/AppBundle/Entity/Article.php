<?php

namespace Entity\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; // generiranje konstruktora?

/**
 * Class Article
 * @package Entity\Entity
 * @ORM\Entity
 * @ORM\Table(name="article")
 */

class Article {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     */
    private $source;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePublshed;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateScraped;

    /**
     * @ORM\Column(type="string")
     */
    private $mediaLink;

    /**
     * @ORM\Column(type="array")
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="articles")
     * @ORM\JoinTable(name="article_categories")
     */
    private $categories;

    /**
     * @ORM\Column(type="string")
     */
    private $link;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;
}