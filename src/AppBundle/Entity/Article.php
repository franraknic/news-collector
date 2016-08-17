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
    private $datePublished;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateScraped;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mediaLink;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="articles", cascade="persist")
     * @ORM\JoinTable(name="article_categories")
     */
    private $categories;

    /**
     * @ORM\Column(type="string", nullable=true unique=true)
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
     * Set datePublished
     *
     * @param \DateTime $datePublished
     *
     * @return Article
     */
    public function setDatePublished($datePublished)
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    /**
     * Get datePublished
     *
     * @return \DateTime
     */
    public function getDatePublished()
    {
        return $this->datePublished;
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
     * @param Category $category
     * @return Article
     */
    public function addCategory(Category $category)
    {
        if(!$this->getCategories()->contains($category)){
            $this->getCategories()->add($category);
        }
        return $this;
    }

    /**
     * @param Category $category
     * @return Article
     */
    public function removeCategory(Category $category){
        if ($this->getCategories()->contains($category)){
            $this->getCategories()->removeElement($category);
        }
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
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
