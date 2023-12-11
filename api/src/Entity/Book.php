<?php
// api/src/Entity/Book.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** A book. */
#[ApiResource]
#[ORM\Entity]
class Book
{
    /** The ID of this book. */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $id = null;

    /** The ISBN of this book (or null if doesn't have one). */
    #[ORM\Column(type: 'string', nullable: true)]
    public ?string $isbn = null;

    /** The title of this book. */
    #[ORM\Column(type: 'string')]
    public string $title = '';

    /** The description of this book. */
    #[ORM\Column(type: 'string')]
    public string $description = '';

    /** The author of this book. */
    #[ORM\Column(type: 'string')]
    public string $author = '';

    /** The publication date of this book. */
    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    public ?\DateTimeImmutable $publicationDate = null;

    /** @var Review[] Available reviews for this book. */
    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Review::class)]
    public iterable $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
