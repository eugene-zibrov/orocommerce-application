<?php

namespace Training\Bundle\UserNamingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Training\Bundle\UserNamingBundle\Model\ExtendUserNamingType;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_naming_type")
 * @Config(
 *      routeName="training_user_naming_index",
 *      routeView="training_user_naming_show",
 *      defaultValues = {
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
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=10,
     *          }
     *      }
     * )
     */
    private int $id;

    /**
     * @var string $title
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=20,
     *          }
     *      }
     * )
     */
    private string $title;

    /**
     * @var string $format
     * @ORM\Column(name="format", type="string", length=255, nullable=false)
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=30,
     *          }
     *      }
     * )
     */
    private string $format;

    /**
     * @var string $example
     * @ORM\Column(name="example", type="string", length=255, nullable=false)
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=40,
     *          }
     *      }
     * )
     */
    private string $example;

    /**
     * @var string $enabled
     * @ORM\Column(name="enabled", type="integer", nullable=false)
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=50,
     *          }
     *      }
     * )
     */
    private string $enabled;

    /**
     * @return string
     */
    public function getEnabled(): string
    {
        return $this->enabled;
    }

    /**
     * @param string $enabled
     */
    public function setEnabled(string $enabled): self
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getExample(): string
    {
        return $this->example;
    }

    /**
     * @param string $example
     */
    public function setExample(string $example): self
    {
        $this->example = $example;
        return $this;
    }

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

    public function __toString(): string
    {
        return $this->title;
    }
}
