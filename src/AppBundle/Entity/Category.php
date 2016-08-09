<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
#use AppBundle\Article;
use Doctrine\Common\Collections\ArrayCollection; // generiranje konstruktora?

/**
 * Class Category
 * @ORM\Entity
 * @ORM\Table(name="category")
 */

class Category {

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="categories") // treba li polje sadrzavati id-eve artikala?!
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
     * Set articles
     *
     * @param array $articles
     *
     * @return Category
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * Get articles
     *
     * @return array
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
