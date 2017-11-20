<?php

namespace Nacat\DataBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Solazs\QuReP\ApiBundle\Annotations\Entity\Field;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Nacat\DataBundle\Repository\CategoryRepository")
 */
class Category
{
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Field
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @NotBlank()
     * @Length(min="3", max="255",
     *     minMessage="Category name must be at least 3 characters long",
     *     maxMessage="Category name must be maximum 255 characters long")
     * @Field(type="TextType")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Field(type="TextareaType")
     */
    private $description;

    /**
     * @var ArrayCollection<Post>
     *
     * @ORM\ManyToMany(
     *     targetEntity="Nacat\DataBundle\Entity\Post",
     *     mappedBy="categories"
     * )
     * @Field
     */
    private $posts;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param ArrayCollection $posts
     */
    public function setPosts(ArrayCollection $posts)
    {
        $this->posts = $posts;
    }

    public function hasPost(Post $post)
    {
        return $this->posts->contains($post);
    }


}

