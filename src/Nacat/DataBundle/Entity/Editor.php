<?php

namespace Nacat\DataBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User;
use Solazs\QuReP\ApiBundle\Annotations\Entity\Field;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Editor
 *
 * @ORM\Table(name="editor")
 * @ORM\Entity(repositoryClass="Nacat\DataBundle\Repository\EditorRepository")
 */
class Editor extends User
{
    public function __construct()
    {
        parent::__construct();
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
    protected $id;


    /**
     * @var string
     * @Field(type="TextType")
     */
    protected $username;

    /**
     * @var string
     * @Field(type="EmailType")
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Length(min="3", max="255",
     *     minMessage="Name must be at least 3 characters long",
     *     maxMessage="Name must be maximum 255 characters long",
     *     groups={"Registration", "Profile"})
     * @Field(type="TextType")
     */
    private $name;

    /**
     * @var ArrayCollection<Post>
     *
     * @ORM\OneToMany(
     *     targetEntity="Nacat\DataBundle\Entity\Post",
     *     mappedBy="editor"
     * )
     * @Field
     */
    private $posts;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Editor
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

