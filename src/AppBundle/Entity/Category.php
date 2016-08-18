<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Category
 * @ORM\Entity
 * @ORM\Table(name="category")
 */

class Category {

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="categories")
     */
    private $articles;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $visible;

    public function __construct($name)
    {
        $this->articles = new ArrayCollection();
        $this->name=$name;
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
     * Set id
     *
     * @param integer
     */
    public function setId($id)
    {
        $this->id=$id;
    }

    /**
     * Set articles
     *
     * @param Article $article
     * @return Category
     */
    public function addArticle(Article $article)
    {
        if(!$this->getArticles()->contains($article)){
            $this->getArticles()->add($article);
        }

        return $this;
    }

    /**
     * @param Article $article
     * @return Category
     */

    public function removeArticle(Article $article){
        if($this->getArticles()->contains($article)){
            $this->getArticles()->removeElement($article);
        }
        return $this;
    }

    /**
     * Get articles
     *
     * @return ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Category
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
