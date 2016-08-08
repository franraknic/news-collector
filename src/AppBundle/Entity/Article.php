<?php

namespace Entity\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Article
 * @package Entity\Entity
 * @ORM\Entity(name="article")
 */

class Article {

    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
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
    private $date_publshed;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_scraped;

    /**
     * @ORM\Column(type="string")
     */
    private $media_link;

    /**
     * @ORM\Column(type="string")
     * @ORM\ManyToMany(targetEntity="")
     */
    private $category;

    /**
     * @ORM\Column(type="string")
     */
    private $link;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;
}