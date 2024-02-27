<?php

namespace App\Infrastructure\Entity;

use App\Infrastructure\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $session_id = null;

    #[ORM\Column]
    private ?bool $finish = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, options: ['default' => 'CURRENT_DATE'])]
    private ?\DateTimeInterface $testDate = null;

    #[ORM\OneToMany(targetEntity: TestAnswers::class, mappedBy: 'test', cascade: ["persist"], orphanRemoval: true)]
    private Collection $testAnswers;

    public function __construct()
    {
        $this->testAnswers = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->setTestDate(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSessionId(): ?string
    {
        return $this->session_id;
    }

    public function setSessionId(string $session_id): static
    {
        $this->session_id = $session_id;

        return $this;
    }

    public function isFinish(): ?bool
    {
        return $this->finish;
    }

    public function setFinish(bool $finish): static
    {
        $this->finish = $finish;

        return $this;
    }

    public function getTestDate(): ?\DateTimeInterface
    {
        return $this->testDate;
    }

    public function setTestDate(\DateTimeInterface $testDate): static
    {
        $this->testDate = $testDate;

        return $this;
    }

    /**
     * @return Collection<int, TestAnswers>
     */
    public function getTestAnswers(): Collection
    {
        return $this->testAnswers;
    }

    public function addTestAnswer(TestAnswers $testAnswer): static
    {
        if (!$this->testAnswers->contains($testAnswer)) {
            $this->testAnswers->add($testAnswer);
            $testAnswer->setTest($this);
        }

        return $this;
    }

    public function removeTestAnswer(TestAnswers $testAnswer): static
    {
        if ($this->testAnswers->removeElement($testAnswer)) {
            // set the owning side to null (unless already changed)
            if ($testAnswer->getTest() === $this) {
                $testAnswer->setTest(null);
            }
        }

        return $this;
    }
}
