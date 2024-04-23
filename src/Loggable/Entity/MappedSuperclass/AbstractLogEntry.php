<?php

/*
 * This file is part of the Doctrine Behavioral Extensions package.
 * (c) Gediminas Morkevicius <gediminas.morkevicius@gmail.com> http://www.gediminasm.org
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gedmo\Loggable\Entity\MappedSuperclass;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Loggable\LogEntryInterface;
use Gedmo\Loggable\Loggable;

/**
 * @phpstan-template T of Loggable|object
 *
 * @phpstan-implements LogEntryInterface<T>
 *
 * @ORM\MappedSuperclass
 */
#[ORM\MappedSuperclass]
abstract class AbstractLogEntry implements LogEntryInterface
{
    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    protected $id;

    /**
     * @var string|null
     *
     * @phpstan-var self::ACTION_CREATE|self::ACTION_UPDATE|self::ACTION_REMOVE|null
     *
     * @ORM\Column(type="string", length=8)
     */
    #[ORM\Column(type: Types::STRING, length: 8)]
    protected $action;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="logged_at", type="datetime")
     */
    #[ORM\Column(name: 'logged_at', type: Types::DATETIME_MUTABLE)]
    protected $loggedAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="object_id", length=64, nullable=true)
     */
    #[ORM\Column(name: 'object_id', length: 64, nullable: true)]
    protected $objectId;

    /**
     * @var string|null
     *
     * @phpstan-var class-string<T>|null
     *
     * @ORM\Column(name="object_class", type="string", length=191)
     */
    #[ORM\Column(name: 'object_class', type: Types::STRING, length: 191)]
    protected $objectClass;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    #[ORM\Column(type: Types::INTEGER)]
    protected $version;

    /**
     * @var array|null
     *
     * @ORM\Column(name="dataBefore", type="array", nullable=true)
     */
    #[ORM\Column(type: Types::ARRAY , nullable: true)]
    protected $dataBefore;

    /**
     * @var array|null
     *
     * @ORM\Column(name="dataAfter",type="array", nullable=true)
     */
    #[ORM\Column(type: Types::ARRAY , nullable: true)]
    protected $dataAfter;


    /**
     * @var string|null
     *
     * @ORM\Column( length=191, nullable=true)
     */
    #[ORM\Column(length: 191, nullable: true)]
    protected $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="previousPath",length=191, nullable=true)
     */

    #[ORM\Column(length: 191, nullable: true)]
    private $previousPath;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle",length=191, nullable=true)
     */

     #[ORM\Column(length: 191, nullable: true)]
     private $libelle;

    // Implémentation des méthodes manquantes
    public function setPreviousPath(string $previousPath): void
    {
        $this->previousPath = $previousPath;
    }

    public function getPreviousPath(): ?string
    {
        return $this->previousPath;
    }

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get action
     *
     * @return string|null
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return void
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * Get object class
     *
     * @return string|null
     */
    public function getObjectClass()
    {
        return $this->objectClass;
    }

    /**
     * Set object class
     *
     * @param string $objectClass
     *
     * @return void
     */
    public function setObjectClass($objectClass)
    {
        $this->objectClass = $objectClass;
    }

    /**
     * Get object id
     *
     * @return string|null
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set object id
     *
     * @param string $objectId
     *
     * @return void
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }

    /**
     * Get username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get loggedAt
     *
     * @return \DateTime|null
     */
    public function getLoggedAt()
    {
        return $this->loggedAt;
    }

    /**
     * Set loggedAt to "now"
     *
     * @return void
     */
    public function setLoggedAt()
    {
        $this->loggedAt = new \DateTime();
    }

    /**
     * Get data
     *
     * @return array|null
     */
    public function getDataBefore()
    {
        return $this->dataBefore;
    }

    /**
     * Set data
     *
     * @param array $dataBefore
     *
     * @return void
     */
    public function setDataBefore($dataBefore)
    {
        $this->dataBefore = $dataBefore;
    }

    /**
     * Get data
     *
     * @return array|null
     */
    public function getDataAfter()
    {
        return $this->dataAfter;
    }

    /**
     * Set data
     *
     * @param array $dataAfter
     *
     * @return void
     */
    public function setDataAfter($dataAfter)
    {
        $this->dataAfter = $dataAfter;
    }


    /**
     * Set current version
     *
     * @param int $version
     *
     * @return void
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Get current version
     *
     * @return int|null
     */
    public function getVersion()
    {
        return $this->version;
    }


    
    /**
     * Get current libelle
     *
     * @return string|null
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    
    /**
     * Set current libelle
     *
     * @param string $libelle
     *
     * @return void
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}
