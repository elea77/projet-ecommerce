<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
    private $name;

    /**
     * @ORM\Column(type="string", length=550)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img2;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="id_game", orphanRemoval=true)
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="id_game", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity=Platform::class, inversedBy="games")
     */
    private $compatibility;

    /**
     * @ORM\OneToMany(targetEntity=Purchase::class, mappedBy="game", orphanRemoval=true)
     */
    private $purchases;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->compatibility = new ArrayCollection();
        $this->purchases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImg1()
    {
        return $this->img1;
    }

    public function setImg1($img1)
    {
        $this->img1 = $img1;

        return $this;
    }

    public function getImg2()
    {
        return $this->img2;
    }

    public function setImg2($img2)
    {
        $this->img2 = $img2;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setIdGame($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getIdGame() === $this) {
                $note->setIdGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdGame($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdGame() === $this) {
                $comment->setIdGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Platform[]
     */
    public function getCompatibility(): Collection
    {
        return $this->compatibility;
    }

    public function addCompatibility(Platform $compatibility): self
    {
        if (!$this->compatibility->contains($compatibility)) {
            $this->compatibility[] = $compatibility;
        }

        return $this;
    }

    public function removeCompatibility(Platform $compatibility): self
    {
        if ($this->compatibility->contains($compatibility)) {
            $this->compatibility->removeElement($compatibility);
        }

        return $this;
    }

    public function removeFile1()
    {
        if(file_exists('/../../public/game-img/' . $this-> img1) ){
            unlink('/../../public/game-img/' . $this-> img1);
        }
    }

    public function removeFile2()
    {
        if(file_exists('/../../public/game-img/' . $this-> img2) ){
            unlink('/../../public/game-img/' . $this-> img2);
        }
    }

    /**
     * @return Collection|Purchase[]
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
            $purchase->setGame($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): self
    {
        if ($this->purchases->contains($purchase)) {
            $this->purchases->removeElement($purchase);
            // set the owning side to null (unless already changed)
            if ($purchase->getGame() === $this) {
                $purchase->setGame(null);
            }
        }

        return $this;
    }
}
