<?php

namespace Nacat\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Solazs\QuReP\ApiBundle\Annotations\Entity\Field;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Nacat\DataBundle\Repository\PostRepository")
 */
class Post
{
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
     * @ORM\Column(name="title", type="string", length=255)
     * @NotBlank()
     * @Length(min="3", max="255",
     *     minMessage="Title must be at least 3 characters long",
     *     maxMessage="Title must be maximum 255 characters long")
     * @Field(type="TextType")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subTitle", type="string", length=255, nullable=true)
     * @Length(min="3", max="255",
     *     minMessage="Subtitle must be at least 3 characters long",
     *     maxMessage="Subtitle must be maximum 255 characters long")
     * @Field(type="TextType")
     */
    private $subTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Field(type="TextareaType")
     */
    private $content;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isFrontPage", type="boolean", nullable=false)
     * @Field(type="CheckboxType")
     */
    private $isFrontPage = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="activationDate", type="datetime")
     * @Field(type="DateTimeType", options={
     *     "widget"="single_text",
     *     "input"="datetime",
     *     "format"="yyyy-MM-dd'T'HH:mm:ssZZZZZ"
     * })
     */
    private $activationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="activeUntil", type="datetime", nullable=true)
     * @Field(type="DateTimeType", options={
     *     "widget"="single_text",
     *     "input"="datetime",
     *     "format"="yyyy-MM-dd'T'HH:mm:ssZZZZZ"
     * })
     */
    private $disableDate;


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
     * Set title
     *
     * @param string $title
     *
     * @return Post
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
     * Set subTitle
     *
     * @param string $subTitle
     *
     * @return Post
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * Get subTitle
     *
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
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
     * @return bool
     */
    public function isFrontPage()
    {
        return $this->isFrontPage;
    }

    /**
     * @param bool $isFrontPage
     */
    public function setFrontPage($isFrontPage = true)
    {
        $this->isFrontPage = $isFrontPage;
    }

    /**
     * Set activationDate
     *
     * @param \DateTime $activationDate
     *
     * @return Post
     */
    public function setActivationDate($activationDate)
    {
        $this->activationDate = $activationDate;

        return $this;
    }

    /**
     * Get activationDate
     *
     * @return \DateTime
     */
    public function getActivationDate()
    {
        return $this->activationDate;
    }

    /**
     * Set disableDate
     *
     * @param \DateTime $disableDate
     *
     * @return Post
     */
    public function setDisableDate($disableDate)
    {
        $this->disableDate = $disableDate;

        return $this;
    }

    /**
     * Get disableDate
     *
     * @return \DateTime
     */
    public function getDisableDate()
    {
        return $this->disableDate;
    }
}

