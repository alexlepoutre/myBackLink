<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BackLinkRepository")
 */
class BackLink
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mySite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hisSite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BackLinkLog", mappedBy="BackLink")
     */
    private $backLinkLogs;

    public function __construct()
    {
        $this->backLinkLogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMySite(): ?string
    {
        return $this->mySite;
    }

    public function setMySite(string $mySite): self
    {
        $this->mySite = $mySite;

        return $this;
    }

    public function getHisSite(): ?string
    {
        return $this->hisSite;
    }

    public function setHisSite(string $hisSite): self
    {
        $this->hisSite = $hisSite;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    /**
     * @return Collection|BackLinkLog[]
     */
    public function getBackLinkLogs(): Collection
    {
        return $this->backLinkLogs;
    }

    public function addBackLinkLog(BackLinkLog $backLinkLog): self
    {
        if (!$this->backLinkLogs->contains($backLinkLog)) {
            $this->backLinkLogs[] = $backLinkLog;
            $backLinkLog->setBackLink($this);
        }

        return $this;
    }

    public function removeBackLinkLog(BackLinkLog $backLinkLog): self
    {
        if ($this->backLinkLogs->contains($backLinkLog)) {
            $this->backLinkLogs->removeElement($backLinkLog);
            // set the owning side to null (unless already changed)
            if ($backLinkLog->getBackLink() === $this) {
                $backLinkLog->setBackLink(null);
            }
        }

        return $this;
    }
}
