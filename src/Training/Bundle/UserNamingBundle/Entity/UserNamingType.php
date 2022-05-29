<?php

namespace Training\Bundle\UserNamingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Training\Bundle\UserNamingBundle\Model\ExtendUserNamingType;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_naming_type")
 * @Config(
 *      routeName="training_user_naming_index",
 *      routeView="training_user_naming_show",
 *      defaultValues={
 *         "entity" = {
 *              "icon"="fa-child"
 *         },
 *         "grid" = {
 *              "default" = "tarining-user-naming-types-grid"
 *         },
 *         "security"={
 *             "type"="ACL",
 *             "group_name"="",
 *             "category"="account_management"
 *         }
 *     }
 * )
 */
class UserNamingType extends ExtendUserNamingType
{
    /**
     * @var int $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @var string $title
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private string $title;

    /**
     * @var string $format
     * @ORM\Column(name="format", type="string", length=255, nullable=false)
     */
    private string $format;

    /**
     * @var string $example
     * @ORM\Column(name="example", type="string", length=255, nullable=false, options={default:""})
     */
    private string $example;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }
}
