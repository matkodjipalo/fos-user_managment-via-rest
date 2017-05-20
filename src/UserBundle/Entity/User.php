<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AttributeOverride;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\Column;

/**
 * User.
 *
 * @ORM\Table("fos_user")
 * @ORM\Entity
 * @AttributeOverrides({
 *      @AttributeOverride(name="usernameCanonical",
 *          column=@Column(
 *              type     = "string",
 *              length   = 155,
 *          )
 *      ),
 *      @AttributeOverride(name="emailCanonical",
 *          column=@Column(
 *              type     = "string",
 *              length   = 155,
 *          )
 *      )
 * })
 */
class User extends BaseUser
{
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="UserAddOnEmail", mappedBy="user", cascade={"persist"})
     */
    private $addOnEmails;

    public function __construct()
    {
        $this->addOnEmails = new ArrayCollection();
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function addEmail($email)
    {
        $addOnEmail = new UserAddOnEmail();
        $addOnEmail->setEmail($email);
        $addOnEmail->setUser($this);

        $this->addOnEmails[] = $addOnEmail;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAddOnEmails()
    {
        return $this->addOnEmails;
    }
}
