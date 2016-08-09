<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Article
 * @ORM\Entity
 * @ORM\Table(name="article")
 */

class Article {

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $content;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $source;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datePublshed;

    /**
     * @ORM\Column(type="datetime", nullable=true) //True for fixtures, in reality false
     */
    private $dateScraped;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mediaLink;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="articles")
     * @ORM\JoinTable(name="article_categories")
     */
    private $categories;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $visible;


    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Article
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set datePublshed
     *
     * @param \DateTime $datePublshed
     *
     * @return Article
     */
    public function setDatePublshed($datePublshed)
    {
        $this->datePublshed = $datePublshed;

        return $this;
    }

    /**
     * Get datePublshed
     *
     * @return \DateTime
     */
    public function getDatePublshed()
    {
        return $this->datePublshed;
    }

    /**
     * Set dateScraped
     *
     * @param \DateTime $dateScraped
     *
     * @return Article
     */
    public function setDateScraped($dateScraped)
    {
        $this->dateScraped = $dateScraped;

        return $this;
    }

    /**
     * Get dateScraped
     *
     * @return \DateTime
     */
    public function getDateScraped()
    {
        return $this->dateScraped;
    }

    /**
     * Set mediaLink
     *
     * @param string $mediaLink
     *
     * @return Article
     */
    public function setMediaLink($mediaLink)
    {
        $this->mediaLink = $mediaLink;

        return $this;
    }

    /**
     * Get mediaLink
     *
     * @return string
     */
    public function getMediaLink()
    {
        return $this->mediaLink;
    }

    /**
     * Set categories
     *
     * @param array $categories
     *
     * @return Article
     */
    public function setCategories($categories)
    {

        foreach ($categories as $category){
            $categories[] = $category;
        }
        return $this;
    }

    /**
     * Get categories
     *
     * @return array
     */
    public function getCategories()
    {
        $categories = new ArrayCollection();
        foreach ($this->categories as $category){
            $categories[] = $category;
        }
        return $categories;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Article
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Article
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }
}
