<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BackLinkLogRepository")
 */
class BackLinkLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $foundIt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logText;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BackLink", inversedBy="backLinkLogs")
     */
    private $BackLink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFoundIt(): ?bool
    {
        return $this->foundIt;
    }

    public function setFoundIt(bool $foundIt): self
    {
        $this->foundIt = $foundIt;

        return $this;
    }

    public function getLogText(): ?string
    {
        return $this->logText;
    }

    public function setLogText(string $logText): self
    {
        $this->logText = $logText;

        return $this;
    }

    public function getBackLink(): ?BackLink
    {
        return $this->BackLink;
    }

    public function setBackLink(?BackLink $BackLink): self
    {
        $this->BackLink = $BackLink;

        return $this;
    }
}
